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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // Colonne pour le prénom
            $table->string('last_name'); // Colonne pour le nom de famille
            $table->string('email'); // Colonne pour l'email, doit être unique
            $table->text('objet'); // Colonne pour l'objet du message
            $table->longText('messages'); // Colonne pour le message
            $table->timestamps(); // Colonnes created_at et updated_at
            $table->softDeletes(); // Colonne deleted_at pour soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
