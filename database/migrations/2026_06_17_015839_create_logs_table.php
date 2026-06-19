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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            //si se borra usuarios se eliminaran los logs de este
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onDelete('cascade');

            $table->string('action');
            $table->text('description');

            $table->string('model_type')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            

            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            
            // IP del usuario que realizó la acción
            $table->string('ip_address')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
