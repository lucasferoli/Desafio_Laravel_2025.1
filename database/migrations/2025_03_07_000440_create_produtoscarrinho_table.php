<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosCarrinhoTable extends Migration
{
     /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
          Schema::create('produtos_carrinho', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('produto_id');
                $table->unsignedBigInteger('carrinho_id');
                $table->integer('quantidade_produto');
                $table->timestamps();

                $table->foreign('produto_id')->references('id')->on('product')->onDelete('cascade');
                $table->foreign('carrinho_id')->references('id')->on('carrinho')->onDelete('cascade');
          });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
          Schema::dropIfExists('produtos_carrinho');
     }
}