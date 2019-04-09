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
            $table->string('firstname');
            $table->string('lastname');
            $table->string('birthday');
            $table->string('bsn');
            $table->string('status');
            $table->string('admin');
            $table->string('sex');
            $table->string('streetname');
            $table->string('housenumber');
            $table->string('postcode');
            $table->string('city');
            $table->string('mobile');
            $table->string('note');
            $table->string('educationlevel');
            $table->string('learnlevel');
            $table->string('debitnumber');
            $table->string('amount');
            $table->string('course_start');
            $table->string('course_end');
            $table->string('invoicenumber');
            $table->string('ona');
            $table->string('signture_date');
            $table->string('signture');
            $table->string('signture_invoice');
            $table->string('lesweken');
            $table->string('lesuren');
            $table->string('signture_verklaring');
            $table->string('verklaring_date');
            $table->string('groups');
            $table->string('toduo');
            $table->string('paidduo');
            $table->string('cost');
            $table->string('website');
            $table->string('shopnumber');
            $table->string('traject');
            $table->string('vianame');
            $table->string('contractnum');
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
