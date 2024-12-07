<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertBrandsIntoBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('brand')->insert([
            ['id' => 1, 'name' => 'Nike', 'description' => 'Marca conhecida por sua inovação e qualidade em calçados esportivos.'],
            ['id' => 2, 'name' => 'Adidas', 'description' => 'Uma das marcas líderes em artigos esportivos, incluindo tênis de alto desempenho.'],
            ['id' => 3, 'name' => 'Puma', 'description' => 'Marca alemã reconhecida por seu estilo único e design diferenciado de calçados esportivos.'],
            ['id' => 4, 'name' => 'Skechers', 'description' => 'Marca especializada em calçados esportivos com ênfase em conforto e estilo moderno.'],
            ['id' => 5, 'name' => 'Asics', 'description' => 'Marca conhecida por sua tecnologia avançada em calçados esportivos, especialmente tênis de corrida.'],
            ['id' => 6, 'name' => 'Mizuno', 'description' => 'A Mizuno é uma marca japonesa renomada por seus tênis de corrida, conhecidos pela durabilidade e tecnologia de amortecimento, como a tecnologia Wave.'],
            ['id' => 7, 'name' => 'New Balance', 'description' => 'A New Balance é uma marca americana fundada em 1906, famosa por seus tênis confortáveis e inovadores para esportes.'],
            ['id' => 8, 'name' => 'Fila', 'description' => 'A Fila é uma marca italiana fundada em 1911, conhecida por seus tênis e roupas esportivas de estilo clássico e moderno.'],
            ['id' => 9, 'name' => 'All Star', 'description' => 'A All Star é uma marca americana de tênis fundada em 1908, famosa por seu modelo clássico de lona com a estrela no calcanhar.'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Opcional: Remover as marcas inseridas
        DB::table('brand')->whereIn('id', [1, 2, 3, 4, 5])->delete();
    }
}
