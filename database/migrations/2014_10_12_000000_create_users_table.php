<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('birthday')->nullable();
            $table->string('bsn')->nullable();
            $table->string('status')->nullable();
            $table->string('admin')->nullable();
            $table->string('sex')->nullable();
            $table->string('streetname')->nullable();
            $table->string('housenumber')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('mobile')->nullable();
            $table->string('note')->nullable();
            $table->string('educationlevel')->nullable();
            $table->string('learnlevel')->nullable();
            $table->string('debitnumber')->nullable();
            $table->string('amount')->nullable();
            $table->string('course_start')->nullable();
            $table->string('course_end')->nullable();
            $table->string('invoicenumber')->nullable();
            $table->string('ona')->nullable();
            $table->string('signture_date')->nullable();
            $table->string('signture')->nullable();
            $table->string('signture_invoice')->nullable();
            $table->string('lesweken')->nullable();
            $table->string('lesuren')->nullable();
            $table->string('signture_verklaring')->nullable();
            $table->string('verklaring_date')->nullable();
            $table->string('groups')->nullable();
            $table->string('toduo')->nullable();
            $table->string('paidduo')->nullable();
            $table->string('cost')->nullable();
            $table->string('website')->nullable();
            $table->string('shopnumber')->nullable();
            $table->string('traject')->nullable();
            $table->string('vianame')->nullable();
            $table->string('contractnum')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
