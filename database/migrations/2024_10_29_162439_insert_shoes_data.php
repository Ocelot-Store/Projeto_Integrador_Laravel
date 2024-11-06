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
        // Adiciona novas colunas na tabela 'shoe' caso elas ainda não existam
        Schema::table('shoe', function (Blueprint $table) {
            if (!Schema::hasColumn('shoe', 'category')) {
                $table->string('category')->nullable();
            }
            if (!Schema::hasColumn('shoe', 'indicated_for')) {
                $table->string('indicated_for')->nullable();
            }
            if (!Schema::hasColumn('shoe', 'material')) {
                $table->string('material')->nullable();
            }
            if (!Schema::hasColumn('shoe', 'weight')) {
                $table->integer('weight')->nullable();
            }
            if (!Schema::hasColumn('shoe', 'technology')) {
                $table->string('technology')->nullable();
            }
            if (!Schema::hasColumn('shoe', 'warranty')) {
                $table->string('warranty')->nullable();
            }
        });
        DB::table('shoe')->insert([
            [
                'model' => 'Nike Dunk Low',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 100.00,
                'size' => '1',
                'description' => 'O Nike Dunk Low apresenta um design clássico com cabedal em couro, trazendo uma combinação de branco e verde escuro, ideal para uso casual e urbano.',
                'color' => 'Branco e Verde Escuro',
                'image' => 'images/shoes/tenis1.png',
                'data_upload' => now(),
                'category' => 'Esporte Casual',
                'indicated_for' => 'Caminhada',
                'material' => 'Couro',
                'weight' => 250,
                'technology' => 'Air Max',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Fenty x Puma Avanti',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 120.00,
                'size' => '2',
                'description' => 'O Fenty x Puma Avanti é um tênis exclusivo que mistura o estilo vintage com modernidade, desenvolvido em colaboração com Rihanna. Seu design em couro bege com detalhes marrons traz um visual sofisticado e premium.',
                'color' => 'Bege e Marrom',
                'image' => 'images/shoes/tenis2.png', 
                'data_upload' => now(),
                'category' => 'Esporte Casual',
                'indicated_for' => 'Caminhada e Estilo Casual',
                'material' => 'Couro',
                'weight' => 250,
                'technology' => 'Sem tecnologia específica',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Adidas Forum Low',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 150.00,
                'size' => '3',
                'description' => 'O Adidas Forum Low é um clássico que combina estilo retrô com modernidade. Este modelo apresenta uma combinação de branco, vinho e detalhes em amarelo, ideal para quem busca um visual esportivo e urbano.',
                'color' => 'Branco, Vinho e Amarelo',
                'image' => 'images/shoes/tenis3.png',
                'data_upload' => now(),
                'category' => 'Esporte Casual',
                'indicated_for' => 'Uso Casual e Estilo',
                'material' => 'Sintético e Couro',
                'weight' => 300,
                'technology' => 'Suporte de tornozelo reforçado',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Nike Precision 6',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 180.00,
                'size' => '4',
                'description' => 'O Nike Precision 6 é um tênis de basquete projetado para desempenho e agilidade em quadra. Com um visual dinâmico em preto e vermelho, oferece excelente suporte para movimentos rápidos e mudanças de direção.',
                'color' => 'Preto e Vermelho',
                'image' => 'images/shoes/tenis4.png',
                'data_upload' => now(),
                'category' => 'Basquete',
                'indicated_for' => 'Quadra e Jogo',
                'material' => 'Sintético e Mesh',
                'weight' => 300,
                'technology' => 'Amortecimento Nike Precision',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Mizuno Morelia Classic',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 100.00,
                'size' => '1',
                'description' => 'O Mizuno Morelia Classic é um clássico para futebol, projetado para proporcionar conforto e controle de bola em campo. Com design em preto e branco, é ideal para jogadores que buscam performance e estilo.',
                'color' => 'Preto e Branco',
                'image' => 'images/shoes/tenis5.png',
                'data_upload' => now(),
                'category' => 'Futebol',
                'indicated_for' => 'Gramado e Campo',
                'material' => 'Couro Sintético',
                'weight' => 280,
                'technology' => 'Solado com travas para gramado',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'New Balance Fresh Foam More v4',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 120.00,
                'size' => '2',
                'description' => 'O New Balance Fresh Foam More v4 é um tênis de corrida projetado para proporcionar máximo conforto e amortecimento em longas distâncias. Seu design em preto com detalhes em cinza escuro oferece estilo discreto e moderno.',
                'color' => 'Preto e Cinza Escuro',
                'image' => 'images/shoes/tenis6.png',
                'data_upload' => now(),
                'category' => 'Corrida',
                'indicated_for' => 'Corridas de Longa Distância',
                'material' => 'Mesh Respirável e Sintético',
                'weight' => 280,
                'technology' => 'Amortecimento Fresh Foam',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Fila Arcade Low',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 150.00,
                'size' => '3',
                'description' => 'O Fila Arcade Low traz um estilo retrô com uma paleta suave em azul e branco, ideal para compor looks casuais com um toque vintage. O logo em laranja dá um contraste interessante ao design.',
                'color' => 'Azul Claro, Branco e Laranja',
                'image' => 'images/shoes/tenis7.png',
                'data_upload' => now(),
                'category' => 'Casual',
                'indicated_for' => 'Uso Diário e Estilo Casual',
                'material' => 'Couro Sintético',
                'weight' => 290,
                'technology' => 'Conforto Extra no Calcanhar',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Converse Chuck Taylor All Star Move',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 180.00,
                'size' => '4',
                'description' => 'O Converse Chuck Taylor All Star Move é uma versão moderna do clássico All Star, com um visual robusto e uma plataforma elevada que oferece estilo e conforto extra. Ideal para quem busca um toque diferenciado no look casual.',
                'color' => 'Preto e Branco',
                'image' => 'images/shoes/tenis8.png',
                'data_upload' => now(),
                'category' => 'Casual',
                'indicated_for' => 'Estilo Casual e Uso Diário',
                'material' => 'Lona',
                'weight' => 320,
                'technology' => 'Plataforma Elevada para Conforto Extra',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Adidas Superstar',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 99.00,
                'size' => '1',
                'description' => 'O Adidas Superstar é um ícone clássico, com design em branco e listras pretas. Este modelo é conhecido pelo seu “bico de concha” e traz um estilo atemporal para o uso casual e streetwear.',
                'color' => 'Branco e Preto',
                'image' => 'images/shoes/tenis9.png',
                'data_upload' => now(),
                'category' => 'Casual',
                'indicated_for' => 'Uso Casual e Streetwear',
                'material' => 'Couro Sintético',
                'weight' => 280,
                'technology' => 'Design Clássico com Bico de Concha',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Puma X-Ray',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 120.00,
                'size' => '2',
                'description' => 'O Puma X-Ray é um tênis casual com design chunky inspirado nos anos 90. Suas cores vibrantes, incluindo rosa, verde neon, azul e preto, tornam-o ideal para quem busca um visual ousado e moderno.',
                'color' => 'Branco, Preto, Rosa, Verde Neon e Azul',
                'image' => 'images/shoes/tenis10.png',
                'data_upload' => now(),
                'category' => 'Casual',
                'indicated_for' => 'Estilo Casual e Streetwear',
                'material' => 'Sintético e Mesh',
                'weight' => 300,
                'technology' => 'Solado Chunky para Conforto e Estilo',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Nike Revolution 6',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 150.00,
                'size' => '3',
                'description' => 'O Nike Revolution 6 é um tênis de corrida versátil, projetado para oferecer conforto e leveza em corridas e atividades diárias. Seu design em preto e branco é discreto e moderno, perfeito para o uso diário.',
                'color' => 'Preto e Branco',
                'image' => 'images/shoes/tenis11.png',
                'data_upload' => now(),
                'category' => 'Corrida',
                'indicated_for' => 'Corridas e Uso Diário',
                'material' => 'Mesh Respirável e Sintético',
                'weight' => 250,
                'technology' => 'Entressola Macia para Amortecimento',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'model' => 'Converse Chuck Taylor All Star High Top',
                'brand_id' => 1,
                'user_id' => 1,
                'price' => 180.00,
                'size' => '4',
                'description' => 'O Converse Chuck Taylor All Star High Top é um clássico atemporal, agora apresentado em um vibrante azul claro. Com seu design icônico de cano alto e bico de borracha, é uma escolha perfeita para looks casuais e estilosos.',
                'color' => 'Azul Claro',
                'image' => 'images/shoes/tenis12.png',
                'data_upload' => now(),
                'category' => 'Casual',
                'indicated_for' => 'Estilo Casual e Streetwear',
                'material' => 'Lona',
                'weight' => 300,
                'technology' => 'Design Clássico com Cano Alto',
                'warranty' => '3 meses',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shoe', function (Blueprint $table) {
            if (Schema::hasColumn('shoe', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('shoe', 'indicated_for')) {
                $table->dropColumn('indicated_for');
            }
            if (Schema::hasColumn('shoe', 'material')) {
                $table->dropColumn('material');
            }
            if (Schema::hasColumn('shoe', 'weight')) {
                $table->dropColumn('weight');
            }
            if (Schema::hasColumn('shoe', 'technology')) {
                $table->dropColumn('technology');
            }
            if (Schema::hasColumn('shoe', 'warranty')) {
                $table->dropColumn('warranty');
            }
        });

        DB::table('shoe')->where('user_id', 1)->delete();
    }
}
