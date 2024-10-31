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
        Schema::create('agent_situation_administratives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained()->onDelete('cascade');

            $table->string('corps')->nullable();
            $table->string('cadre')->nullable();
            $table->string('grade')->nullable();
            $table->string('specialite')->nullable();
            $table->string('echelon')->nullable();
            $table->string('note')->nullable();
            $table->date('date')->nullable();
            $table->string('obs')->nullable();
            $table->json('modifications')->nullable(); // Tracking modifications
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_situation_administratives');
    }
};
