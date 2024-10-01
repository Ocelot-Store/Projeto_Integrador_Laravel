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
