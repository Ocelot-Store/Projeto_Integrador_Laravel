<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id(); // Cria uma coluna 'id' do tipo integer com auto incremento
            $table->string('name', 100); // Cria uma coluna 'name' com tipo varchar(100)
            $table->string('address', 100); // Cria uma coluna 'address' com tipo varchar(100)
            $table->string('email', 100); // Cria uma coluna 'email' com tipo varchar(100)
            $table->string('password', 255); // Cria uma coluna 'password' com tipo varchar(255)
            $table->string('PasswordConfirmation', 255); // Cria uma coluna 'PasswordConfirmation' com tipo varchar(255)
            $table->string('file_name', 100)->nullable(); // Cria uma coluna 'file_name' com tipo varchar(100) e permite valor nulo
            $table->string('path', 100)->nullable(); // Cria uma coluna 'path' com tipo varchar(100) e permite valor nulo
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user'); // Remove a tabela 'user' se ela existir
    }
}
