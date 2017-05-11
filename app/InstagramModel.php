<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class InstagramModel extends Model
{
    protected $table = 'instagram_users';
    protected $fillable = ['instagram_id', 'avatar_url', 'name', 'photo_like_count', 'video_like_count', 'total_like_count'];

    public function getAllUsers($offset, $limit)
    {
        $users = DB::table('instagram_users')
            ->offset($offset)
            ->limit($limit)
            ->orderBy('total_like_count','desc')
            ->get();
        return $users;
    }
}
