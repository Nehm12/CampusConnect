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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('room_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('purpose')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])
                  ->default('pending');
            $table->foreignId('admin_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};