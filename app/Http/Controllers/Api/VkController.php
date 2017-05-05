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
    //permission: offline,friends,photos,video,wall
    // get "code" https://oauth.vk.com/authorize?client_id=6004450&display=page&redirect_uri=http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com&scope=offline,friends,photos,video,wall&response_type=code&v=5.63
    // get token https://oauth.vk.com/access_token?client_id=6004450&client_secret=i4sKln0H6QI4k6vtHYHh&redirect_uri=http://ec2-54-229-150-116.eu-west-1.compute.amazonaws.com&code=d03e67a56506968ddf

    public function customResponse($data)
    {
        if(isset($data['position'])) {
            $response_data['position'] = $data['position'];
            unset($data['position']);
        }
        $response_data['data']   = $data;
        $response_data['errors'] = [];

        return response()->json($response_data, 200, [], JSON_UNESCAPED_UNICODE)->header('Content-Type', 'application/json; charset=utf-8');
    }



    public function getUsers($flag, Request $request)
    {
        $offset = isset($request->offset) ? (int)$request->offset : 0;
        $limit = isset($request->limit) ? (int)$request->limit : 100000;

        if(!isset($request->vkId)||$request->vkId=='') {
            $users = DB::table('vk_users')
                ->offset($offset)
                ->limit($limit)
                ->orderBy('total_like_count','desc')
                ->get();

            return $this->customResponse($users);
        }

        switch ($flag){
            case 'all':

                $users = DB::table('vk_users')
                    ->offset($offset)
                    ->limit($limit)
                    ->orderBy('total_like_count','desc')
                    ->get();

                $i        = 1;
                $position = 0;

                $users_all = DB::table('vk_users')
                    ->offset(0)
                    ->limit(100000)
                    ->orderBy('total_like_count','desc')
                    ->get();

                foreach ($users_all as $usr) {

                    if($usr->vk_id == $request->vkId) {
                        $position = $i;
                    }
                    $i++;

                }
                $users['position'] = $position;

                return $this->customResponse($users);
            case 'city':

                $users = DB::table('vk_users')
                    ->where('city_id', $request->cityId)
                    ->offset($offset)
                    ->limit($limit)
                    ->orderBy('total_like_count','desc')
                    ->get();

                $i        = 1;
                $position = 0;

                $users_all = DB::table('vk_users')
                    ->where('city_id', $request->cityId)
                    ->offset(0)
                    ->limit(100000)
                    ->orderBy('total_like_count','desc')
                    ->get();

                foreach ($users_all as $usr) {

                    if($usr->vk_id == $request->vkId) {
                        $position = $i;
                    }
                    $i++;

                }

                if(count($users) == 1 && $users[0]->vk_id == $request->vkId) {
                    $data = [];
                    return $this->customResponse($data);
                }

                $users['position'] = $position;

                return $this->customResponse($users);
            case 'friends':
                $friends = explode(',',$request->friendsIds);
                $friends[] = $request->vkId;

                $users = DB::table('vk_users')
                    ->whereIn('vk_id', $friends)
                    ->offset($offset)
                    ->limit($limit)
                    ->orderBy('total_like_count','desc')
                    ->get();

                $users_all = DB::table('vk_users')
                    ->whereIn('vk_id', $friends)
                    ->offset(0)
                    ->limit(100000)
                    ->orderBy('total_like_count','desc')
                    ->get();

                $i        = 1;
                $position = 0;

                foreach ($users_all as $usr) {

                    if($usr->vk_id == $request->vkId) {
                        $position = $i;
                    }
                    $i++;

                }

                if((count($users) == 1) && ($users[0]->vk_id == $request->vkId)) {
                    $data = [];
                    return $this->customResponse($data);
                }

                $users['position'] = $position;
                return $this->customResponse($users);
        }
    }

    public function updateOrCreateUser(Request $request)
    {

        if(!isset($request->vkId)) {
            $data['data'] =[];
            $data['error'] = ['msg'=>'vkId not found'];
            return response()->json($data);
        }

        $vk_id            = (int)$request->vkId;
        $city_id          = isset($request->cityId) ? (int)$request->cityId : 0;
        $avatar_url       = isset($request->avatarUrl) ? $request->avatarUrl : ' ';
        $name             = isset($request->name) ? $request->name : ' ';
        $photo_like_count = isset($request->photoLikes) ? (int)$request->photoLikes : 0;
        $video_like_count = isset($request->videoLikes) ? (int)$request->videoLikes : 0;
        $wall_like_count  = isset($request->wallLikes) ? (int)$request->wallLikes : 0;
        $total_like_count = $photo_like_count+$video_like_count+$wall_like_count;

        $success = VkUsers::updateOrCreate(
            ['vk_id' => $vk_id],
            [
                "vk_id"       => $vk_id,
                "city_id"           => $city_id,
                "avatar_url"        => $avatar_url,
                "name"              => $name,
                "photo_like_count"  => $photo_like_count,
                "video_like_count"  => $video_like_count,
                "wall_like_count"   => $wall_like_count,
                "total_like_count"  => $total_like_count
            ]
        );

        $data['data'] = 200;
        $data['errors'] = [];
        return response()->json($data);
    }
}
