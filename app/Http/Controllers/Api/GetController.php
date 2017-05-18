<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\FacebookUsers;
use Laravel\Socialite\Facades\Socialite;
use DB;


class GetController extends Controller
{
    public function customResponse($users)
    {
        if (isset($users['position'])) {
            $response_data['position'] = $users['position'];
            unset($users['position']);
        }
        $response_data['data'] = $users;
        $response_data['errors'] = [];
        return response()->json($response_data);
    }

    public function getUserObj($request)
    {
        $user = Socialite::driver('FacebookConnect')->userByToken($request->token);
        $response_data = array();
        $all_photo_count = 0;
        $all_video_count = 0;

        if (isset($user['error'])) {
            $response_data['errors'] = true;
            $response_data['err_msg'] = 'malformed token';
            return $response_data;
        }

        foreach ($user['albums']['data'] as $album_data) {
            $all_photo_count += $album_data['photo_count'];
            $all_video_count += $album_data['video_count'];
        }

        $user['posts_count'] = count($user['posts']['data']);
        $user['photo_count'] = $all_photo_count;
        $user['video_count'] = $all_video_count;
        return $user;
    }

    private function getUserPosition($facebook_user_id, $city_id = false, $friends = false)
    {
        $user_likes_count = DB::table('fb_users')
            ->select('total_like_count')
            ->where('facebook_id', $facebook_user_id)
            ->first()
            ->total_like_count;
        $result = DB::table('fb_users')
            ->select(DB::raw('COUNT(*) as position'))
            ->where('total_like_count', '>', $user_likes_count);
        if ($city_id) {
            $result = $result->where('city_id', $city_id);
        }
        if ($friends) {
            $result = $result->whereIn('facebook_id', $friends);
        }
        return $result->first()->position;
    }

    public function getProfile(Request $request)
    {
        $user = $this->getUserObj($request);

        $user['likes'] = $this->calculateLikes($user);

        unset($user['albums']);
        unset($user['posts']);
        unset($user['video']);
        unset($user['friends']);

        $this->updateOrRegister($user);

        return $this->customResponse($user);
    }

    public function updateOrRegister($user)
    {
        FacebookUsers::updateOrCreate(
            ['facebook_id' => $user['id']],
            [
                "facebook_id" => $user['id'],
                "city_id" => isset($user['location']['id']) ? (int)$user['location']['id'] : 0,
                "avatar_url" => isset($user['avatar_url']) ? $user['avatar_url'] : '',
                "name" => $user['name'],
                "photo_like_count" => $user['likes']['photo_likes'],
                "video_like_count" => $user['likes']['video_likes'],
                "wall_like_count" => $user['likes']['wall_likes'],
                "total_like_count" => $user['likes']['total_likes']
            ]
        );

    }

    public function calculateLikes($user)
    {
        $photo_count_likes = 0;
        $video_count_likes = 0;
        $wall_count_likes = 0;

        foreach ($user['albums']['data'] as $albums_data) {
            if (isset($albums_data['photos'])) {
                foreach ($albums_data['photos']['data'] as $photo) {
                    if (isset($photo['likes'])) {
                        $photo_count_likes += count($photo['likes']['data']);
                    }
                }
            }
        }
        if (isset($user['video']['data']) && $user['video']['data'] != 0) {
            foreach ($user['video']['data'] as $video) {
                if (isset($video['likes'])) {
                    $video_count_likes += count($video['likes']['data']);
                }
            }
        }

        if (isset($user['posts']['data']) && $user['posts']['data'] != 0) {
            foreach ($user['posts']['data'] as $post) {
                if (isset($post['likes'])) {
                    $wall_count_likes += count($post['likes']['data']);
                }
            }
        }

        $res = array();
        $res['photo_likes'] = $photo_count_likes;
        $res['video_likes'] = $video_count_likes;
        $res['wall_likes'] = $wall_count_likes;
        $res['total_likes'] = $photo_count_likes + $video_count_likes + $wall_count_likes;

        return $res;
    }

    public function deleteUser(Request $request)
    {
        $user = $this->getUserObj($request);

        $users = DB::table('fb_users')->where('facebook_id', $user['id'])->delete();
        if ($users) {
            $users = ['msg' => 'user was deleted'];
        }

        return $this->customResponse($users);
    }

    public function getUsers($flag, Request $request)
    {
        $limit = (int)$request->input('limit', 100);
        $offset = (int)$request->input('offset', 0);
        $token = $request->input('token', false) ?: false;
        $users_query = DB::table('fb_users as sort')
            ->select('tbl.*')
            ->join('fb_users as tbl', 'tbl.id', '=', 'sort.id')
            ->offset($offset)
            ->limit($limit)
            ->orderBy('sort.total_like_count', 'desc');
        if (!$token) {
            return [
                'data' => $users_query->get(),
                'errors' => [],
            ];
        }
        $user = $this->getUserObj($request);
        if (isset($user['errors'])) {
            $data['data'] = [];
            $data['errors'] = $user['err_msg'];
            return $data;
        }
        switch ($flag) {
            case 'all':
                return [
                    'position' => $this->getUserPosition($user['id']),
                    'data' => $users_query->get(),
                    'errors' => [],
                ];
                break;
            case 'city':
                if (!isset($user['location']['id'])) {
                    $response_data['data'] = [];
                    $response_data['errors'] = ["Not found user location"];
                    return $response_data;
                }
                return [
                    'position' => $this->getUserPosition($user['id'], $user['location']['id']),
                    'data' => $users_query
                        ->where('sort.city_id', (int)$user['location']['id'])
                        ->get(),
                    'errors' => [],
                ];
                break;
            case 'friends':
                if (!isset($user['friends']['data'])) {
                    return [
                        'data' => [],
                        'errors' => ['Not found user friends']
                    ];
                }
                $friends = array_column($user['friends']['data'], 'id');
                $friends[] = $user['id'];
                $users = $users_query
                    ->whereIn('sort.facebook_id', $friends)
                    ->get();
                return [
                    'position' => $this->getUserPosition($user['id'], false, $friends),
                    'data' => ((count($users) == 1 && $users[0]->facebook_id == $user['id'])
                        ? []
                        : $users),
                    'errors' => [],
                ];
                break;
        }
    }

    public function updateOrCreateUser(Request $request)
    {
        if (!isset($request->fbId)) {
            $data['data'] = [];
            $data['error'] = ['msg' => 'fbId not found'];
            return response()->json($data);
        }

        $fb_id = (int)$request->fbId;
        $city_id = isset($request->cityId) ? (int)$request->cityId : 0;
        $avatar_url = isset($request->avatarUrl) ? $request->avatarUrl : ' ';
        $name = isset($request->name) ? $request->name : ' ';
        $photo_like_count = isset($request->photoLikes) ? (int)$request->photoLikes : 0;
        $video_like_count = isset($request->videoLikes) ? (int)$request->videoLikes : 0;
        $wall_like_count = isset($request->wallLikes) ? (int)$request->wallLikes : 0;
        $total_like_count = $photo_like_count + $video_like_count + $wall_like_count;

        $success = FacebookUsers::updateOrCreate(
            ['facebook_id' => $fb_id],
            [
                "facebook_id" => $fb_id,
                "city_id" => $city_id,
                "avatar_url" => $avatar_url,
                "name" => $name,
                "photo_like_count" => $photo_like_count,
                "video_like_count" => $video_like_count,
                "wall_like_count" => $wall_like_count,
                "total_like_count" => $total_like_count
            ]
        );

        $data['data'] = 200;
        $data['errors'] = [];
        return response()->json($data);
    }
}
