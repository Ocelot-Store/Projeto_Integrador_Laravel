<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddSizesToShoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Lista dos tamanhos que serão adicionados
        $sizes = [34, 36, 38, 40, 42, 44];

        // Para cada tênis na tabela 'shoe', adicionar os tamanhos
        $shoes = DB::table('shoe')->get();
        
        foreach ($shoes as $shoe) {
            foreach ($sizes as $size) {
                DB::table('shoe_sizes')->insert([
                    'shoe_id' => $shoe->id,
                    'size' => $size,
                    'quantity' => 0, // Defina a quantidade conforme necessário
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remover as entradas da tabela 'shoe_sizes' baseadas no 'shoe_id'
        DB::table('shoe_sizes')->whereIn('shoe_id', function ($query) {
            $query->select('id')->from('shoe');
        })->delete();
    }
}
