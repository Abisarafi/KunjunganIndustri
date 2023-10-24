<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->date('visit_date');
            $table->string('company_name');
            $table->string('contact_person_name');
            $table->string('contact_person_email');
            $table->text('purpose');
            $table->enum('status', ['processed', 'accepted', 'rejected'])->default('processed');
            // New columns for class/group and participant count
            $table->enum('class', ['TKJ', 'SIJA', 'TJA', 'MM', 'RPL', 'Broadcasting']);
            $table->integer('participant_count')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            // $table->unsignedBigInteger('booking_id')->nullable();
            // $table->foreign('booking_id')->references('id')->on('bookings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
