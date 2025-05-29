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
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->string('status')->default('aberto'); // aberto, em_andamento, resolvido
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // quem abriu
            $table->foreignId('tecnico_id')->nullable()->constrained('users')->onDelete('set null'); // quem está resolvendo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};
