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
    Schema::create('tareas', function (Blueprint $table) {
        $table->id(); // bigIncrements PK
        $table->string('titulo', 100); // string(100) obligatorio
        $table->text('descripcion')->nullable(); // text opcional
        $table->enum('prioridad', ['baja', 'media', 'alta'])->default('media'); // enum con default
        $table->boolean('completada')->default(false); // boolean default false
        $table->date('fecha_limite')->nullable(); // date opcional
        $table->timestamps(); // created_at y updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
