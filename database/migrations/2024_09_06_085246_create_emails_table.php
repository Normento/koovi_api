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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('content');
            $table->timestamp('scheduled_at')->nullable(); // Date de programmation de l'envoi
            $table->enum('status', ['sent', 'scheduled'])->default('scheduled');
            $table->timestamps();
            $table->softDeletes();
        });

        // Table pivot pour lier les emails aux newsletters
        Schema::create('email_newsletter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_id')->constrained()->onDelete('cascade');
            $table->foreignId('newsletter_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_newsletter');
        Schema::dropIfExists('emails');
    }
};
