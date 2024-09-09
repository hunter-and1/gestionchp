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
        Schema::create('chp_agent_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained('agents')->onDelete('cascade');
            $table->enum('recruitment_type', ['1er_recrutement', 'detachement', 'mutation', 'mise_a_disposition'])->nullable();
            $table->enum('affectation', ['provisoire', 'definitive']);
            $table->enum('status', ['stagiaire', 'titulaire']);
            $table->enum('position', ['en_activite'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chp_agent_details');
    }
};
