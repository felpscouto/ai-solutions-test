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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('category_id'); // Alterei o campo para unsignedBigInteger, pois o mesmo também pode ser nulo
            $table->string('title', 120); // O campo deve ser um pouco maior, pois a quantidade da caracteres inicial é pequena
            $table->text('contents');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
                // Removi o cascade on delete para evitar que a remoção de um documento remova também suas categorias
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
