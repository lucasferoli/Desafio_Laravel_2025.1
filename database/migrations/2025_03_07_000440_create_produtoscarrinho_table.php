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
        Schema::create('produtoscarrinho', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('carrinho_id');
            $table->integer('quantidade_produto');
            $table->timestamps();

            // Ensuring foreign key references the correct table
            $table->foreign('produto_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('carrinho_id')->references('id')->on('carrinhos')->onDelete('cascade');
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
