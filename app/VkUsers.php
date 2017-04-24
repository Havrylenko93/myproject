<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VkUsers extends Model
{
    protected $table = 'vk_users';
    protected $fillable = ['vk_id', 'city_id', 'avatar_url', 'name', 'photo_like_count', 'video_like_count', 'wall_like_count', 'total_like_count'];
}
