<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id(); // Cria a coluna 'id' como BIGINT AUTO_INCREMENT
            $table->unsignedBigInteger('user_id'); // Altere para unsignedBigInteger
            $table->unsignedBigInteger('shoe_id'); // Altere para unsignedBigInteger
            
            // Define as chaves estrangeiras
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('shoe_id')->references('id')->on('shoe')->onDelete('cascade');
            
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
