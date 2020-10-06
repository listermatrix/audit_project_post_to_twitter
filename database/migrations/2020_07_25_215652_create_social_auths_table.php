<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_auths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('twitter_screen_name')->nullable();
            $table->string('twitter_oauth_token')->nullable();
            $table->string('twitter_oauth_token_secrete')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_auths');
    }
}
