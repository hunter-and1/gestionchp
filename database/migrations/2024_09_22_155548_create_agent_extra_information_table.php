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
        Schema::create('agent_extra_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained()->onDelete('cascade');
            
            // Extra Information
            $table->string('adresse_fr')->nullable();
            $table->string('adresse_ar')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->enum('situation_familiale', array_keys(config('agent.situation_familiale')))->nullable();
            $table->unsignedInteger('nombre_enfants')->default(0);
            
            // Modification tracking
            $table->json('modifications')->nullable(); // Store modification history in JSON

            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_extra_information');
    }
};
