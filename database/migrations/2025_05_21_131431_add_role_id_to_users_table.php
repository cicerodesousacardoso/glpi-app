<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna role_id que pode ser nula
            // Define foreign key referenciando a tabela roles(id)
            // Se a role for deletada, seta role_id como null nos usuários
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove a foreign key role_id
            $table->dropForeign(['role_id']);
            // Remove a coluna role_id
            $table->dropColumn('role_id');
        });
    }
};
