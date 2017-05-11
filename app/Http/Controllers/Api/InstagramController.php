<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\InstagramModel;
use App\Http\Controllers\Api\VkController;
use DB;
use Cache;

class InstagramController extends Controller
{
    public function getAllUsers(VkController $vk, Request $request, InstagramModel $instagram_model)
    {
        $offset = isset($request->offset) ? (int)$request->offset : 0;
        $limit = isset($request->limit) ? (int)$request->limit : 100000;

        if(!isset($request->instagramId)||$request->instagramId=='') {
            $users = $instagram_model->getAllUsers($offset, $limit);

            return $vk->customResponse($users);
        }

        $users = $instagram_model->getAllUsers($offset, $limit);

        $i        = 1;
        $position = 0;

        $users_all = $instagram_model->getAllUsers(0,100000);

        foreach ($users_all as $usr) {

            if($usr->instagram_id == $request->instagramId) {
                $position = $i;
            }
            $i++;

        }

        $users['position'] = $position;

        return $vk->customResponse($users);
    }

    public function updateOrCreateUser(Request $request)
    {
        if(!isset($request->instagramId)) {
            $data['data'] =[];
            $data['error'] = ['msg'=>'instagramId not found'];
            return response()->json($data);
        }

        $instagram_id     = (int)$request->instagramId;
        $avatar_url       = isset($request->avatarUrl) ? $request->avatarUrl : ' ';
        $name             = isset($request->name) ? $request->name : ' ';
        $photo_like_count = isset($request->photoLikes) ? (int)$request->photoLikes : 0;
        $video_like_count = isset($request->videoLikes) ? (int)$request->videoLikes : 0;
        $total_like_count = $photo_like_count+$video_like_count;

        $success = InstagramModel::updateOrCreate(
            ['instagram_id' => $instagram_id],
            [
                "instagram_id"       => $instagram_id,
                "avatar_url"        => $avatar_url,
                "name"              => $name,
                "photo_like_count"  => $photo_like_count,
                "video_like_count"  => $video_like_count,
                "total_like_count"  => $total_like_count
            ]
        );

        $data['data'] = 200;
        $data['errors'] = [];
        return response()->json($data);
    }

    public function getUsersByIds(VkController $vk, Request $request, InstagramModel $instagram_model)
    {
        $offset = isset($request->offset) ? (int)$request->offset : 0;
        $limit = isset($request->limit) ? (int)$request->limit : 100000;

        $ids = explode(',',$request->Ids);
        $ids[] = $request->instagramId;

        $users = $instagram_model->getUsersByIds($offset, $limit, $ids);

        $users_all = $instagram_model->getUsersByIds(0, 100000, $ids);

        $i        = 1;
        $position = 0;

        foreach ($users_all as $usr) {

            if($usr->instagram_id == $request->instagramId) {
                $position = $i;
            }
            $i++;

        }

        if((count($users) == 1) && ($users[0]->vk_id == $request->vkId)) {
            $data = [];
            return $vk->customResponse($data);
        }

        $users['position'] = $position;
        return $vk->customResponse($users);
    }

}
