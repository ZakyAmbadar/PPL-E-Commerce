<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->text('store_description')->nullable();
            $table->string('pic_name');
            $table->string('pic_phone');
            $table->string('email')->unique();
            $table->string('street_address');
            $table->string('rt_rw');
            $table->string('village');
            $table->string('city');
            $table->string('province');
            $table->string('id_card_number');
            $table->string('id_card_file');
            $table->string('pic_photo');
            $table->string('password');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sellers');
    }
};