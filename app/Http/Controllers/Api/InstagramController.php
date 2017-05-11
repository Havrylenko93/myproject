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
    // https://api.instagram.com/oauth/authorize/?client_id=31818ae5ce664553a5879a086eb36b73&redirect_uri=http://likulator.loc/api/v1/instagram/redirect&scope=likes+comments+basic+public_content+follower_list+relationships&response_type=token
    // https://api.instagram.com/v1/users/self/media/recent/?access_token=4980024217.31818ae.96293c42964b406992de60c29594e650

    public function getLikes()
    {
        $client = new Client();
        try{
            $url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=4980024217.31818ae.96293c42964b406992de60c29594e650&count=1000";
            $response = $client->get($url)->getBody();
            $response1[] = json_decode($response, true);
        }catch(\Exception $e){
            return $e->getMessage();
        }

        foreach ($response1[0]['data'] as $media) {

            if($media['type']=="video") {
                echo "vidosik: likes = ".$media['likes']['count']." - comments count = ".$media['comments']['count']."<br/>";
            }

            if($media['type']=="image") {
                echo "image: likes = ".$media['likes']['count']." - comments count = ".$media['comments']['count']."<br/>";
            }
        }

        try{
            $url1 = "https://api.instagram.com/v1/users/self/followed-by.json?access_token=4980024217.31818ae.96293c42964b406992de60c29594e650";
            $follow = $client->get($url1)->getBody();
            $follow1[] = json_decode($follow, true);
        }catch(\Exception $e){
            return $e->getMessage();
        }

        dd($follow1);

    }

    public function redirect(Request $request)
    {
        dd($request);
    }
}
