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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Colonne pour le titre
            $table->text('resume'); // Colonne pour le résumé
            $table->longText('content'); // Colonne pour le contenu
            $table->string('slug');
            $table->string('image')->nullable(); // Colonne pour l'image, peut être null
            $table->timestamps(); // Colonnes created_at et updated_at
            $table->softDeletes(); // Colonne deleted_at pour soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
