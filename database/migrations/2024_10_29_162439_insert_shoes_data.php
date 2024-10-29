<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InsertShoesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('user')->insert([
            'id' => '1',
            'name' => '123',
            'address' => '123',
            'email' => '123@gmail.com',
            'password' => Hash::make('123'), // Faz o hash da senha
            'PasswordConfirmation' => Hash::make('123'), // Novamente, não é comum armazenar essa informação
            'file_name' => null,
            'path' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Inserir dados na tabela 'shoe'
        DB::table('shoe')->insert([
            ['model' => 'Modelo A', 'brand_id' => 1, 'user_id' => 1, 'price' => 100.00, 'size' => '1', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Modelo B', 'brand_id' => 1, 'user_id' => 1, 'price' => 120.00, 'size' => '2', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Modelo C', 'brand_id' => 1, 'user_id' => 1, 'price' => 150.00, 'size' => '3', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Modelo D', 'brand_id' => 1, 'user_id' => 1, 'price' => 180.00, 'size' => '4', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],

            ['model' => 'Modelo A', 'brand_id' => 1, 'user_id' => 1, 'price' => 100.00, 'size' => '1', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Modelo B', 'brand_id' => 1, 'user_id' => 1, 'price' => 120.00, 'size' => '2', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Modelo C', 'brand_id' => 1, 'user_id' => 1, 'price' => 150.00, 'size' => '3', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Modelo D', 'brand_id' => 1, 'user_id' => 1, 'price' => 180.00, 'size' => '4', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],

            ['model' => 'Modelo A', 'brand_id' => 1, 'user_id' => 1, 'price' => 100.00, 'size' => '1', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Modelo B', 'brand_id' => 1, 'user_id' => 1, 'price' => 120.00, 'size' => '2', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Modelo C', 'brand_id' => 1, 'user_id' => 1, 'price' => 150.00, 'size' => '3', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Modelo D', 'brand_id' => 1, 'user_id' => 1, 'price' => 180.00, 'size' => '4', 'description' => 'Descrição do Tênis', 'color' => 'Preto', 'image' => 'ainda_n_setado', 'data_upload' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Atualizar imagens na tabela 'shoe'
        DB::statement("
            UPDATE shoe
            SET image = CASE
                WHEN id % 8 = 0 THEN 'images/shoes/tenis1.png'
                WHEN id % 8 = 1 THEN 'images/shoes/tenis2.png'
                WHEN id % 8 = 2 THEN 'images/shoes/tenis3.png'
                WHEN id % 8 = 3 THEN 'images/shoes/tenis4.png'
                WHEN id % 8 = 4 THEN 'images/shoes/tenis5.png'
                WHEN id % 8 = 5 THEN 'images/shoes/tenis6.png'
                WHEN id % 8 = 6 THEN 'images/shoes/tenis7.png'
                WHEN id % 8 = 7 THEN 'images/shoes/tenis8.png'
                ELSE image
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Reverter a atualização de imagem e remoção de registros
        DB::table('shoe')->where('user_id', 1)->delete();
    }
}
