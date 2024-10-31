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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->enum('category', array_keys(config('agent.category')));
            $table->enum('sub_category', array_keys(config('agent.sub_category')))->nullable();
            $table->enum('affectation', array_keys(config('agent.affectation')))->nullable();
            $table->enum('statut', array_keys(config('agent.statut')))->nullable();
            $table->enum('position', array_keys(config('agent.position')))->nullable();
            $table->enum('motif_entree', array_keys(config('agent.motif_entree')))->nullable();
            $table->enum('type_mouvement', array_keys(config('agent.type_mouvement')))->nullable();
            $table->string('reference')->unique();
            $table->date('date_reference');
            $table->text('observation')->nullable();

            $table->string('nom_fr');
            $table->string('prenom_fr');
            $table->string('prenom_ar');
            $table->string('nom_ar'); 
            $table->string('cin')->unique();
            $table->string('ppr')->nullable()->unique();
            $table->date('date_naissance'); 
            $table->string('lieu_naissance_fr'); 
            $table->string('lieu_naissance_ar'); 
            $table->date('date_recrutement'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
