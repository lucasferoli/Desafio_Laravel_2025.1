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
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_pedido');
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('comprador_id');
            $table->integer('quantidade_produto');
            $table->date('data');
            $table->timestamps();

            // Assuming produto_id and comprador_id are foreign keys
            $table->foreign('produto_id')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('comprador_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacoes');
    }
};
