<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\VkUsers;
use DB;
use Cache;

class VkController extends Controller
{
    //permission: friends,photos,video,wall
    // get "code" https://oauth.vk.com/authorize?client_id=6004450&display=page&redirect_uri=http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com&scope=friends,photos,video,wall&response_type=code&v=5.63
    // get token https://oauth.vk.com/access_token?client_id=6004450&client_secret=i4sKln0H6QI4k6vtHYHh&redirect_uri=http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com&code=d03e67a56506968ddf

    public function getTokenByCode($code = '1a6b25b6bc272e2228')
    {
        if (Cache::has($code)) {
            return Cache::get($code);
        }
        $client   = new Client();
        $url      = "https://oauth.vk.com/access_token?client_id=6004450&client_secret=i4sKln0H6QI4k6vtHYHh&redirect_uri=http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com&code=".$code;
        $response = $client->get($url)->getBody();
        $response1[] = json_decode($response, true);
        $token = $response1[0]['access_token'];
        Cache::put($code, $token, 120);
        return $token;
    }

    public function getProfile(Request $request)
    {
        $token = $this->getTokenByCode();
        if (Cache::has($token)) {
            return Cache::get($token);
        }

        $url         = "https://api.vk.com/method/users.get?&extended=1&filter=likes&v=5.63";
        $client      = new Client();
        $response    = $client->get($url, ['query' => ['access_token' => $token, 'fields' => 'city,photo_200_orig',]])->getBody();

        $response1[] = json_decode($response, true);
        if(isset($response1[0]['error'])) {
            $response_data['data']   = [];
            $response_data['errors'][] = $response1[0]['error']['error_msg'];
            return $response_data;
        }
        $user = array();

        $user['vk_id']            = $response1[0]['response'][0]['uid'];
        $user['name']             = $response1[0]['response'][0]['first_name']." ".$response1[0]['response'][0]['last_name'];
        $user['city']             = $response1[0]['response'][0]['city'];
        $user['avatar_url']       = $response1[0]['response'][0]['photo_200_orig'];
        $user['wall']             = $this->wall($token, $client);
        $user['photos']           = $this->photos($token, $client);
        $user['videos']           = $this->videos($token, $client, $user['vk_id']);
        $user['total_user_likes'] = $user['photos']['total_photo_likes']+$user['videos']['total_video_likes']+$user['wall']['total_wall_likes'];

        $this->updateOrRegister($user);
        $custom_response = $this->customResponse($user);
        //Cache::put($token, $custom_response, 120);

        return $custom_response;
    }

    public function customResponse($data)
    {
        $response_data['data']   = $data;
        $response_data['errors'] = [];

        return response()->json($response_data, 200, [], JSON_UNESCAPED_UNICODE)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getResponse($client, $offset = 0, $url, $token, $count = 100, $extended)
    {
        $response = $client->get(
            $url,
            [
                'query' => [
                    'access_token' => $token,
                    'count' =>$count,
                    'offset' => $offset,
                    'extended' => $extended,
                ]
            ]
        )->getBody();

        return $response;
    }

    public function wall($token, $client)
    {
        $meUrl    = "https://api.vk.com/method/wall.get?&extended=1&filter=likes&v=5.63";

        $response = $this->getResponse($client, 0, $meUrl, $token, 100, 0);

        $response1[] = json_decode($response, true);

        if(($response1[0]['response'][0]/100)>1) {
            $iter = $response1[0]['response'][0]/100;
            $iter = (int)$iter;

            for($i=1; $i<=$iter; $i++) {
                $offset = $i."00";
                $offset = (int)$offset;
                $response1[] = $this->getResponse($client, $offset, $meUrl, $token, 100, 0);
            }

        }

        $total_count = array();
        $total_count['all_wall_count'] = $response1[0]['response'][0];
        $total_count['total_wall_likes'] = 0;

        foreach($response1 as $batch) {

            foreach($batch['response'] as $post) {
                $total_count['total_wall_likes'] += $post['likes']['count'];
                /*if($post['likes']['user_likes'] == 0) {
                    $total_count['total_wall_likes'] += $post['likes']['count'];
                }else{
                    $total_count['total_wall_likes'] += $post['likes']['count']-1;
                }*/
            }

        }

        return $total_count;
    }

    public function photos($token, $client)
    {
        $meUrl1      = "https://api.vk.com/method/photos.getAll?v=5.63";

        $response    = $this->getResponse($client, 0, $meUrl1, $token, 200, 1);

        $response1[] = json_decode($response, true);

        if(($response1[0]['response'][0]/200)>1) {
            $iter = $response1[0]['response'][0]/200;
            $iter = (int)$iter;
            $photo_offset=200;

            for($i=1; $i<=$iter; $i++) {
                $prom = $this->getResponse($client, $photo_offset, $meUrl1, $token, 200, 1);
                $response1[] = json_decode($prom, true);
                $photo_offset += 200;
            }

        }
        $total_count = array();
        $total_count['all_photos_count']  = $response1[0]['response'][0];
        $total_count['total_photo_likes'] = 0;

        foreach($response1 as $batch) {

            foreach($batch['response'] as $photo) {

                if(isset($photo['likes'])) {

                    if($photo['likes']['user_likes'] == 0) {
                        $total_count['total_photo_likes'] += $photo['likes']['count'];
                    }else{
                        $total_count['total_photo_likes'] += $photo['likes']['count']-1;
                    }

                }

            }

        }

        return $total_count;
    }

    public function videos($token, $client,$user_id)
    {

        $meUrl1      = "https://api.vk.com/method/video.get?v=5.63";

        $response    = $this->getResponse($client, 0, $meUrl1, $token, 200, 1);

        $response1[] = json_decode($response, true);

        if(($response1[0]['response'][0]/200)>1) {
            $iter = $response1[0]['response'][0]/200;
            $iter = (int)$iter;
            $video_offset=200;

            for($i=1; $i<=$iter; $i++) {
                $prom = $this->getResponse($client, $video_offset, $meUrl1, $token, 200, 1);
                $response1[] = json_decode($prom, true);
                $video_offset += 200;
            }

        }

        $finish_response = array();
        $finish_response['all_video_count']   = $response1[0]['response'][0];
        $finish_response['total_video_likes'] = 0;

        foreach($response1 as $batch) {

            foreach($batch['response'] as $video) {

                if(isset($video['likes'])&&$video['owner_id']==$user_id) {
                    if($video['likes']['user_likes'] == 0) {
                        $finish_response['total_video_likes'] += $video['likes']['count'];
                    }else{
                        $finish_response['total_video_likes'] += $video['likes']['count']-1;
                    }
                }

            }

        }

        return $finish_response;
    }

    public function updateOrRegister($user)
    {
        VkUsers::updateOrCreate(
            ['vk_id' => $user['vk_id']],
            [
                "vk_id"       => $user['vk_id'],
                "city_id"           => (int)$user['city'],
                "avatar_url"        => $user['avatar_url'],
                "name"              => $user['name'],
                "photo_like_count"  => $user['photos']['total_photo_likes'],
                "video_like_count"  => $user['videos']['total_video_likes'],
                "wall_like_count"   => $user['wall']['total_wall_likes'],
                "total_like_count"  => $user['total_user_likes']
            ]
        );

    }

    public function deleteUser(Request $request)
    {
        $token = $this->getTokenByCode();
        $url         = "https://api.vk.com/method/users.get?&extended=1&v=5.63";
        $client      = new Client();
        $response    = $client->get($url, ['query' => ['access_token' => $token]])->getBody();
        $response1[] = json_decode($response, true);

        if(isset($response1[0]['error'])) {
            $response_data['data']   = [];
            $response_data['errors'][] = $response1[0]['error']['error_msg'];
            return $response_data;
        }

        $users = DB::table('vk_users')->where('vk_id', $response1[0]['response'][0]['uid'])->delete();
        if($users){
            $users = ['msg'=>'user was deleted'];
        }
        return $this->customResponse($users);
    }

    public function getUsers($flag, Request $request)
    {
        $token = $this->getTokenByCode();
        switch ($flag){
            case 'all':
                $users = DB::table('vk_users')
                    ->offset($request->offset)
                    ->limit($request->limit)
                    ->get();
                return $this->customResponse($users);
            case 'city':
                $url           = "https://api.vk.com/method/users.get?&extended=1&filter=likes&v=5.63";
                $client        = new Client();
                $response      = $client->get($url, ['query' => ['access_token' => $token, 'fields' => 'city,photo_200_orig',]])->getBody();
                $user[]        = json_decode($response, true);

                if(isset($user[0]['error'])) {
                    $response_data['data']   = [];
                    $response_data['errors'][] = $user[0]['error']['error_msg'];
                    return $response_data;
                }

                $user['city']  = $user[0]['response'][0]['city'];
                $user['vk_id'] = $user[0]['response'][0]['uid'];

                $users = DB::table('vk_users')
                    ->where('city_id', $user['city'])
                    ->whereNotIn('vk_id', [$user['vk_id']])
                    ->offset($request->offset)
                    ->limit($request->limit)
                    ->get();
                return $this->customResponse($users);
            case 'friends':
                $url           = "https://api.vk.com/method/friends.get?&v=5.63";
                $client        = new Client();
                $response      = $client->get($url, ['query' => ['access_token' => $token]])->getBody();
                $response1[]        = json_decode($response, true);

                if(isset($response1[0]['error'])) {
                    $response_data['data']   = [];
                    $response_data['errors'][] = $response1[0]['error']['error_msg'];
                    return $response_data;
                }

                $users = DB::table('vk_users')
                    ->whereIn('vk_id', $response1[0]['response'])
                    ->offset($request->offset)
                    ->limit($request->limit)
                    ->get();
                return $this->customResponse($users);
        }
    }

}
