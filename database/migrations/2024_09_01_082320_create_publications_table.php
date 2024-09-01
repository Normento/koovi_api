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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Colonne pour le titre
            $table->text('description'); // Colonne pour la description
            $table->text('resume'); // Colonne pour le résumé
            $table->text('content'); // Colonne pour le contenu
            $table->string('image')->nullable(); // Colonne pour l'image, peut être null
            $table->string('file')->nullable(); // Colonne pour le fichier, peut être null
            $table->integer('file_size')->nullable(); // Colonne pour la taille du fichier, peut être null
            $table->timestamps(); // Colonnes created_at et updated_at
            $table->softDeletes(); // Colonne deleted_at pour soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
