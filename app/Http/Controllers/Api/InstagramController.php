<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\VkUsers;
use DB;
use Cache;

class InstagramController extends Controller
{
    // https://www.instagram.com/oauth/authorize/?client_id=31818ae5ce664553a5879a086eb36b73&redirect_uri=http://likulator.loc/api/v1/instagram/redirect&response_type=code
    // https://api.instagram.com/oauth/authorize/?client_id=31818ae5ce664553a5879a086eb36b73&redirect_uri=http://likulator.loc/api/v1/instagram/redirect&scope=likes+comments+basic+public_content&response_type=token
    // https://api.instagram.com/v1/users/self/media/recent/?access_token=4980024217.31818ae.96293c42964b406992de60c29594e650

    public function getLikes()
    {

    }

    public function redirect(Request $request)
    {
        dd($request);
    }
}
