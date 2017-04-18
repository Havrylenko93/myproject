<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookUsers extends Model
{
    protected $table = 'fb_users';
    protected $fillable = ['fb_auth_token', 'city_id', 'avatar_url', 'name', 'last_calculating', 'photo_like_count', 'video_like_count', 'wall_like_count', 'total_like_count', 'facebook_id'];
}
