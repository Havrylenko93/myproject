<?php

namespace App\Providers\Social;

use Laravel\Socialite\Two\FacebookProvider;
use League\Flysystem\Exception;

class FacebookConnect extends FacebookProvider
{
    //protected $fields = ['name', 'email', 'gender', 'verified', 'albums{photos{likes}}', 'location', 'posts{likes}', 'videos{uploaded}'];
    protected $fields = ['name', 'albums{photos{likes}}', 'location', 'posts{likes}', 'videos{uploaded}', 'friendlists'];

    public function userByToken($token)
    {
        $meUrl = $this->graphUrl.'/'.$this->version.'/me/?access_token='.$token.'&fields='.implode(',', $this->fields);

        try{
            if (! empty($this->clientSecret)) {
                $appSecretProof = hash_hmac('sha256', $token, $this->clientSecret);

                $meUrl .= '&appsecret_proof='.$appSecretProof;
            }

            $response = $this->getHttpClient()->get($meUrl, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            $my_response = json_decode($response->getBody(), true);
            //>
            $meUrl1 = $this->graphUrl.'/'.$this->version.'/me/videos/uploaded?fields=likes&access_token='.$token;

            if (! empty($this->clientSecret)) {
                $appSecretProof = hash_hmac('sha256', $token, $this->clientSecret);

                $meUrl1 .= '&appsecret_proof='.$appSecretProof;
            }

            $response1 = $this->getHttpClient()->get($meUrl1, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
            $my_response1 = json_decode($response1->getBody(), true);

            //<//
            $my_response['video'] = $my_response1;
            $my_response['avatar_url'] = $this->graphUrl.'/'.$this->version.'/'.$my_response['id'].'/picture';
        }catch(\Exception $e){
            $user['error'] = $e->getMessage();
            return $user;
        }

        return $my_response;
    }
}