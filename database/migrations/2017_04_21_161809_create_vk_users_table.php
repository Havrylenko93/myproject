<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVkUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vk_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('vk_id');
            $table->integer('city_id');
            $table->string('avatar_url', 255);
            $table->string('name', 255);
            $table->integer('photo_like_count');
            $table->integer('video_like_count');
            $table->integer('wall_like_count');
            $table->integer('total_like_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vk_users');
    }
}
