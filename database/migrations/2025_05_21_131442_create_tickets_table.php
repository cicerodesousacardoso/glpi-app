<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            
            // Campo status, padrão 'open'.
            // Caso queira usar enum, descomente a linha abaixo e comente a anterior.
            // $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
            $table->string('status')->default('open');
            
            // FK para usuário, cascata para excluir tickets se usuário for deletado
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
