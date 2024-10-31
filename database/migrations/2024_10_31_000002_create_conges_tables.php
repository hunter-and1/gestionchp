<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('types_conge', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20);
            $table->string('libelle', 100);
            $table->text('description')->nullable();
            $table->integer('max_jours');
            $table->string('categorie', 50);
            $table->timestamps();
        });

        Schema::create('solde_conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained()->onDelete('cascade');
            $table->year('annee');
            $table->integer('solde_initial')->default(22);
            $table->integer('solde_restant');
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->unique(['agent_id', 'annee']);
        });

        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained()->onDelete('cascade');
            $table->foreignId('type_conge_id')->constrained('types_conge');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('date_reprise')->nullable();
            $table->decimal('jours_consommes', 5, 1);
            $table->enum('etat', ['EXPIRE', 'ANNULE', 'COMPLET', 'INTERRUPTION']);
            $table->text('observation')->nullable();
            $table->string('annee_conge', 9); // Format: 2023/2024
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('types_conge');
        Schema::dropIfExists('solde_conges');
        Schema::dropIfExists('conges');
    }
};
