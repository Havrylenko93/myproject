<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\VkUsers;
use DB;
use Cache;

class NewVkController extends Controller
{
    public function getAll(Request $request)
    {
        $users = DB::table('vk_users')
            ->offset($request->offset)
            ->limit($request->limit)
            ->get();
        return $this->customResponse($users);
    }

    public function getUsersByIds(Request $request)
    {
        $ids = explode(',',$request->ids);
        $users = DB::table('vk_users')
            ->whereIn('vk_id', $ids)
            ->offset($request->offset)
            ->limit($request->limit)
            ->get();
        return $this->customResponse($users);
    }

    public function getUsersByCity(Request $request)
    {
        $vk_id  = (int)$request->vk_user_id;
        $cityId = (int)$request->cityId;

        $users = DB::table('vk_users')
            ->where('city_id', $cityId)
            ->whereNotIn('vk_id', [$vk_id])
            ->offset($request->offset)
            ->limit($request->limit)
            ->get();
        return $this->customResponse($users);
    }

    public function createOrUpdate(Request $request)
    {
        $vk_id = (int)$request->vk_id;
        $city_id = (int)$request->city_id;
        $avatar_url = $request->avatar_url;
        $name = $request->name;
        $photo_like_count = (int)$request->photo_like_count;
        $video_like_count = (int)$request->video_like_count;
        $wall_like_count = (int)$request->video_like_count;
        $total_like_count = (int)$request->total_like_count;
        VkUsers::updateOrCreate(
            ['vk_id' => $vk_id],
            [
                "vk_id"       => $vk_id,
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

    public function customResponse($data)
    {
        $response_data['data']   = $data;
        $response_data['errors'] = [];

        return response()->json($response_data, 200, [], JSON_UNESCAPED_UNICODE)->header('Content-Type', 'application/json; charset=utf-8');
    }
}
