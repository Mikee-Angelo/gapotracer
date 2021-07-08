<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->id('id');
            $table->string('name', 255);
            $table->string('staff_name', 255);
            $table->text('address');
            $table->string('contact_no', 20);
            $table->enum('type', ['Stall','Shop','Fastfood','Mall','Grocery','Supermarket','Hospital']);
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
        Schema::drop('establishments');
    }
}
