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
        Schema::create('reservation_material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('material_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamps();

            // évitez les doublons, ex: 2 lignes ayant le même matériel_id pour la même reservation_id;
            $table->unique(['reservation_id', 'material_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_material');
    }
};