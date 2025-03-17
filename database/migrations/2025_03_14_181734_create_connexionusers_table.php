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
        Schema::create('connexionusers', function (Blueprint $table) {
            $table->id();
            $table->string('connexion_outcome')->nullable();
            $table->dateTime('connexion_date')->nullable();
            $table->string('connexion_ip')->nullable();
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connexionusers');
    }
};
