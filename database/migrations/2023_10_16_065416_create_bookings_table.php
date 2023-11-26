<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('jurusan', ['TKJ', 'SIJA', 'TJA', 'MM', 'RPL', 'Broadcasting']);
            $table->enum('participant_count', ['1', '2']);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['processed', 'accepted', 'rejected'])->default('processed');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('color')->nullable();
            $table->string('document')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}