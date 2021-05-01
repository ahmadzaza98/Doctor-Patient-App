<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id');
            $table->string('avatar')->nullable();
            $table->integer('address_id');
            $table->integer('area_id');
            $table->text('address_details');
            $table->string('phone_number');
            $table->dateTime('open_at');
            $table->dateTime('closed_at');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinics');
    }
}
