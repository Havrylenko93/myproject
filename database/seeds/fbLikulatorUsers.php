<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class fbLikulatorUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $data = json_decode(file_get_contents(storage_path().'/likulator-fb-export.json'), true);
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            return;
        }

        // Process source file content to store it into database
        $seeds = [];

        foreach ($data['users'] as $user) {

            $seeds[] = [
                'facebook_id' => $user['id'],
                'city_id' => $user['cityId']!="undefined" ? (int)$user['cityId'] : 0,
                'avatar_url' => $user['photoSrc'] != '' ? $user['photoSrc'] : '',
                'name' => $user['name'] ,
                //'last_calculating' => isset($user['lastCalculating']) ? $user['lastCalculating'] : ' ',
                'photo_like_count' => $user['photoLikeCount'],
                'video_like_count' => $user['videoLikeCount'],
                'wall_like_count' => $user['wallLikeCount'],
                'total_like_count' => isset($user['totalLikeCount']) ? $user['totalLikeCount'] : 0,
            ];

        }

        $x = array_chunk($seeds, 8000);
        DB::table('fb_users')->insert($x[0]);
        DB::table('fb_users')->insert($x[1]);
        DB::table('fb_users')->insert($x[2]);
        DB::table('fb_users')->insert($x[3]);
    }
}
