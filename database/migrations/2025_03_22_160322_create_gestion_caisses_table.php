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
        Schema::create('gestion_caisses', function (Blueprint $table) {
            $table->id();
            $table->string('TypeBeneficier');
            $table->string('Beneficiaire');
            $table->string('TypeMouvement');
            $table->double('Montant');
            $table->string('modePaiement');
            $table->string('Numero')->nullable();
            $table->text('Decharche')->nullable();
            $table->text('AutreDoc')->nullable();
            $table->date('Date');
            $table->text('Detail')->nullable();
            $table->unsignedBigInteger('ressource_id')->nullable();
            $table->foreign('ressource_id')->references('id')->on('ressources')->onDelete('set null');
            // $table->unsignedBigInteger('nature_id')->nullable();
            // $table->foreign('nature_id')->references('id')->on('natures')->onDelete('set null');
            $table->unsignedBigInteger('membre_id')->nullable();
            $table->foreign('membre_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->boolean('supprimer')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestion_caisses');
    }
};
