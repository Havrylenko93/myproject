<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class VkController extends GetController
{
    public function test()
    {

        $meUrl = "https://api.vk.com/method/photos.getAll?no_service_albums=1&&extended=1&filter=likes&count=200&v=5.63";
        $client = new Client();
        $response = $client->get(
            'https://api.vk.com/method/photos.getAll?no_service_albums=1&&extended=1&filter=likes&count=200&v=5.63',
            [
                'query' => [
                    'access_token' => 'aef3965684508f26c378b8fcbed8fa3cd1681e25ae86a60b45a1df19e9599da8bf23a0abb60a74bc73e6b',
                ]
            ]
        )->getBody();


        return $response;
    }
}
