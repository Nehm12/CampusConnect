<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique(); // UUID ou code formaté
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // qui réserve
            $table->foreignId('room_id')->nullable()->constrained('rooms')->nullOnDelete();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('purpose')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete(); // admin qui approuve/rejette
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
