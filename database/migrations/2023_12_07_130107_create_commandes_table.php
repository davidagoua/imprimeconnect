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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
            $table->string('client_nom');
            $table->string('contact');
            $table->string('mode_paiement')->nullable();
            $table->date('deadline')->nullable();
            $table->string('lieu_livraison')->nullable();
            $table->string('format')->nullable();
            $table->unsignedBigInteger('conseiller_id')->nullable();
            $table->unsignedBigInteger('infographiste_id')->nullable();
            $table->string('status')->default('reception');
            $table->string('montant_lettre')->nullable();
            $table->unsignedBigInteger('avance')->default(0);
            $table->integer('regle')->default(0);
            $table->string('canal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
