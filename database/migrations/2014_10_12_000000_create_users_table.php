<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('account')->unique();
            $table->string('name')->nullable();
            $table->string('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('get_address')->nullable();
            $table->string('get_phone')->nullable();
            $table->string('line_id')->nullable();
            $table->string('email')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('gender')->default(1);
            $table->integer('role');
            //$table->rememberToken();
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
