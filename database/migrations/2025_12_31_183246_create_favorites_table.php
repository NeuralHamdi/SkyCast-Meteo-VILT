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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            // Clé étrangère : Si on supprime l'utilisateur, on supprime ses favoris (cascade)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Le nom de la ville (ex: "Agadir", "Paris")
            $table->string('city');

            $table->timestamps(); // Crée created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
