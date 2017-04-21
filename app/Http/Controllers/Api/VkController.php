<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class VkController extends Controller
{

    public function getProfile()
    {
        $token = "4bf94a0c2fbf983a2d649442533fe9a579fdb0decc0736d4684aa177ac357372b02482914773de1ee8de7";
        $url = "https://api.vk.com/method/users.get?&extended=1&filter=likes&v=5.63";
        $client = new Client();
        $response = $client->get($url, ['query' => ['access_token' => $token, 'fields' => 'city,photo_200_orig',]])->getBody();
        $response1[] = json_decode($response, true);

        dd($response1);
        $arr ['wall'] = $this->wall($token, $client);
        $arr['photos'] = $this->photos($token, $client);
        $arr['videos'] = $this->videos($token, $client, 73517365);
        return $this->customResponse($arr);
    }
    public function customResponse($data)
    {
        $response_data['data'] = $data;
        $response_data['errors'] = [];
        return response()->json($response_data);
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
        $meUrl = "https://api.vk.com/method/wall.get?&extended=1&filter=likes&v=5.63";

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
        $total_count['total_wall_likes'] = 0;
        $total_count['all_wall_count'] = $response1[0]['response'][0];
        foreach($response1 as $batch) {

            foreach($batch['response'] as $post) {

                if($post['likes']['user_likes'] == 0) {
                    $total_count['total_wall_likes'] += $post['likes']['count'];
                }else{
                    $total_count['total_wall_likes'] += $post['likes']['count']-1;
                }
            }

        }

        return $total_count;
    }

    public function photos($token, $client)
    {
        $meUrl1 = "https://api.vk.com/method/photos.getAll?v=5.63";

        $response = $this->getResponse($client, 0, $meUrl1, $token, 200, 1);

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
        $total_count['total_photo_likes'] = 0;
        $total_count['all_photos_count'] = $response1[0]['response'][0];
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
        $meUrl1 = "https://api.vk.com/method/video.get?v=5.63";

        $response = $this->getResponse($client, 0, $meUrl1, $token, 200, 1);

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
        $finish_response['all_video_count'] = $response1[0]['response'][0];
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
}
