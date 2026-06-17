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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            //llave foranea a device_id
            $table->foreignId('device_id')
                    ->constrained('devices')
                    ->onDelete('restrict');
            //segunda llave foranea a usuarios asignados, si se borra un usuario automaticamente lo elimina
            $table->foreignId('assigned_user_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();

            $table->string('type');
            $table->string('status')->default('pendiente');
            $table->text('description');
            $table->string('priority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
