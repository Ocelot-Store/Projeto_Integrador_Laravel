<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoe', function (Blueprint $table) {
            $table->id(); // Isso cria um campo 'id' auto-incremental
            $table->string('model', 100);
            $table->foreignId('brand_id')->constrained('brand')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->string('description', 999);
            $table->string('color', 100);
            $table->string('image', 100);
            $table->timestamp('data_upload')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('category', 100)->nullable();  // Adicionando o campo 'category' à tabela
            $table->timestamps(); // Adiciona created_at e updated_at se necessário
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoe');
    }
}
