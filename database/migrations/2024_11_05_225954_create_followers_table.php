<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id'); // ID do usuário que está seguindo
            $table->unsignedBigInteger('following_id'); // ID do usuário que está sendo seguido
            $table->timestamps();

            // Define as chaves estrangeiras para manter a integridade referencial
            $table->foreign('follower_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('following_id')->references('id')->on('user')->onDelete('cascade');

            // Garante que um usuário não possa seguir o mesmo usuário mais de uma vez
            $table->unique(['follower_id', 'following_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}

