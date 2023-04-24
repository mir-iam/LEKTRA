<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('child_parent_id');
            $table->integer('doctor_id');
            $table->foreignId('appointment_type_id');
            $table->dateTime('date_of_appointment');
            $table->boolean('completed')->default(false);
            $table->boolean('cancelled')->default(false);
            $table->boolean('no_show')->default(false);
            // $table->date('day');
            // $table->string('hour')->unique();
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
        Schema::dropIfExists('appointments');
    }
};
