<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->string("store_id");
            $table->string("name");
            $table->string("jan_code");
            $table->string("price");
            $table->string("weight");
            $table->string("amount");
            $table->string("price_total");
            $table->string("weight_total");
            $table->string("out_date");
            $table->string("box_no");
            $table->string("transport_no");
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
        Schema::dropIfExists('transports');
    }
}
