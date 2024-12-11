<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoeSizesTable extends Migration
{
    public function up()
    {
        Schema::create('shoe_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shoe_id')->constrained('shoe')->onDelete('cascade'); // Associa ao tênis
            $table->integer('size'); // Numeração do tênis
            $table->integer('quantity')->default(0); // Estoque disponível para essa numeração
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shoe_sizes');
    }
}
