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
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruteur_id');
            $table->string('titreOffre');
            $table->string('lieuOffre');
            $table->string('typecontrat_Offre');
            $table->text('descriptionOffres');
            $table->float('salaire', 8, 2)->nullable();
            $table->string('status')->default('en attente');
            $table->date('dateEXPIRATION');
            $table->timestamps();
            $table->foreign('recruteur_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
