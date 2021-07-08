<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('id');
            $table->string('name', 255);
            $table->string('body_no', 255);
            $table->string('plate_no', 255);
            $table->string('contact_no', 255);
            $table->text('address');
            $table->enum('type', ['Jeep','Bus','Tricycle','Taxi','Van','Truck']);
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
        Schema::drop('vehicles');
    }
}
