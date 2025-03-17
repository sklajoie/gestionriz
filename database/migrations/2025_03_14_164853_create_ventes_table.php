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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->string('Reference');
            $table->string('Montant');
            $table->string('Avance')->nullable();
            $table->string('Solde')->nullable();
            $table->string('Client')->nullable();
            $table->string('Contact')->nullable();
            $table->string('Tht')->nullable();
            $table->string('Remise')->nullable();
            $table->string('Tva')->nullable();
            $table->string('Etat')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
