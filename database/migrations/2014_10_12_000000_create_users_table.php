<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned()->index('country_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone', 32)->nullable();
            $table->string('avatar')->default('user_silhouette.png');
            $table->char('active', 1)->default('1');
            $table->char('verified', 1)->default('1');
            $table->string('email_verification_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('email_expired_at')->nullable();
            $table->timestamp('last_logged_in')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
