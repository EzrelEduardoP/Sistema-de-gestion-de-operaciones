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
        Schema::create('incident_histories', function (Blueprint $table) {
            $table->id();
            //si se borra las incidencias tambien se borrara el historial del dispositivo
            $table->foreignId('incident_id')
                    ->constrained('incidents')
                    ->onDelete('cascade');

            $table->string('new_status');
            $table->string('old_status');

            // Descripción del cambio del porque se cambio el estado
            $table->text('description')->nullable();

            //se hizo una llave foranea para usuarios, para que se vea quien fue el usuario
            $table->foreignId('changed_by')
                    ->constrained('users')
                    ->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_histories');
    }
};
