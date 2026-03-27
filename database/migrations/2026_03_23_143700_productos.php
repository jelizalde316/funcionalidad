<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            
            $table->string('nombre');            
            $table->integer('precio')->default(0);
            $table->text('descripcion')->nullable();
            $table->integer('stock')->default(0);
            $table->string('sku')->unique();
            $table->boolean('estado')->default(true);

            // Relación con categorías
            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->onDelete('cascade');

            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
