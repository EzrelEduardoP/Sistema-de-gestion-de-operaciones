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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();

            //la llave foranea hace referencia a la tabla usuarios con la relacion del id_cliente
            $table->foreignId('client_id')
                    ->constrained('users')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table->string('name');
            $table->string('type');
            //en estatus se pone asi para que al momento de dar de alta un nuevo dispositivo se tenga que activar para el funcionamiento
            $table->string('status')->default('inactivo');
            $table->string('location');

            //el nullable es por que no todos los dispositivos tienen metadatos y permite que no se crea informacion adicional
            $table->json('metadata')->nullable();
            
            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
            $table->softDeletes(); // Soft deletes para dispositivos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
