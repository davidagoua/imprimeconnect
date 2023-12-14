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
        Schema::create('lignes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->unsignedBigInteger('commande_id');
            $table->integer('quantite')->default(1);
            $table->string('designation');
            $table->string('status')->default('reception');
            $table->string('dimension')->nullable();
            $table->string('nom_fichier')->nullable();
            $table->integer('nombre')->nullable();
            $table->integer('pu')->nullable();
            $table->string('file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lignes');
    }
};
