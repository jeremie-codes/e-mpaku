<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('membres', function (Blueprint $table) {
            $table->id();

            // Step 1
            $table->string('cipa')->unique();
            $table->enum('type_assujetti', ['physique', 'morale'])->nullable();
            $table->string('commune');

            // Step 2
            $table->string('nom_complet');
            $table->enum('sexe', ['M', 'F'])->nullable();
            $table->string('nom_responsable');
            $table->date('date_naissance');
            $table->string('nationalite');
            $table->string('activite_principale');
            $table->string('lieu_exercice');
            $table->string('marche');
            $table->string('telephone');
            $table->string('email')->nullable();

            // Step 3
            $table->string('nif');
            $table->string('rccm')->nullable();
            $table->enum('affiliation_syndicale', ['SNVC', 'Autre', 'Aucune'])->nullable();
            $table->enum('possede_stand', ['Oui', 'Non'])->nullable();
            $table->enum('type_bien', ['Propre', 'Loué', 'Public'])->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assujettis');
    }
};
