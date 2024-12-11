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
            'name' => 'Admin do sistema',
            'address' => '123',
            'email' => '123@gmail.com',
            'password' => Hash::make('123'), // Faz o hash da senha
            'PasswordConfirmation' => Hash::make('123'), // Novamente, não é comum armazenar essa informação
            'profileImage' => null,
            'profileCover' => 'images/users/ProfileCover.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Inserir dados na tabela 'shoe'
        DB::table('shoe')->insert([
            ['model' => 'Nike Dunk Low', 'brand_id' => 1, 'user_id' => 1, 'price' => 100.00, 'description' => 'O Nike Dunk Low combina estilo atemporal com funcionalidade. Sua construção robusta, estética minimalista e o logotipo da Nike fazem dele uma escolha versátil para qualquer ocasião, seja para compor um look casual ou para uma sessão de skate.', 'color' => 'Preto e branco', 'image' => 'images/shoes/tenis1.png', 'data_upload' => now(), 'category' => 'Casual', 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Fenty x Puma Avanti', 'brand_id' => 3, 'user_id' => 1, 'price' => 120.00, 'description' => 'O Fenty x Puma Avanti é um tênis que mistura influências retrô com o toque moderno e sofisticado de Fenty. Inspirado no clássico Puma King de futebol, esse modelo traz uma estética vintage aliada a um acabamento premium, destacando-se como uma peça de moda exclusiva e de alto padrão. A colaboração com Rihanna adiciona elementos de luxo e estilo, tornando-o uma escolha de destaque para aqueles que buscam um visual fashion-forward.', 'color' => 'Bege', 'image' => 'images/shoes/tenis2.png', 'data_upload' => now(), 'category' => 'Casual', 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Adidas Forum Low', 'brand_id' => 2, 'user_id' => 1, 'price' => 150.00, 'description' => 'O Adidas Forum Low é um clássico da marca Adidas, originalmente lançado na década de 1980 como um tênis de basquete. Com o passar do tempo, ele se transformou em um ícone da moda urbana, popular entre fãs de streetwear e colecionadores. Este modelo específico apresenta uma paleta de cores única, misturando branco, vinho e detalhes em amarelo, que conferem um visual retrô e estiloso, perfeito para compor looks casuais e modernos.', 'color' => 'Branco e bege', 'image' => 'images/shoes/tenis3.png', 'data_upload' => now(), 'category' => 'Esportivo', 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Nike Precision 6', 'brand_id' => 1, 'user_id' => 1, 'price' => 180.00, 'description' => 'O Nike Precision 6 é um tênis de basquete que combina design moderno e funcionalidade, desenvolvido para oferecer desempenho e estabilidade em quadra. Com um visual dinâmico e uma estrutura leve, ele é ideal para jogadores que buscam agilidade e suporte em movimentos rápidos e mudanças de direção. A cor predominante em preto e vermelho dá ao modelo um aspecto arrojado e esportivo, ideal para quem quer se destacar tanto no jogo quanto no estilo.', 'color' => 'Preto, vermelho e branco', 'image' => 'images/shoes/tenis4.png', 'data_upload' => now(), 'category' => 'Esportivo', 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Mizuno Morelia Classic', 'brand_id' => 6, 'user_id' => 1, 'price' => 100.00, 'description' => 'O Mizuno Morelia Classic é um tênis de futebol que faz parte da linha Morelia, conhecida pela sua qualidade e durabilidade. Este modelo combina o design clássico com a tecnologia moderna, proporcionando aos jogadores um excelente desempenho e conforto em campo. O Morelia é especialmente popular entre jogadores que valorizam um toque de bola preciso e estabilidade, ideal para gramados artificiais e superfícies firmes.', 'color' => 'Preto e branco', 'image' => 'images/shoes/tenis5.png', 'data_upload' => now(), 'category' => 'Esportivo', 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'New Balance Fresh Foam More v4', 'brand_id' => 7, 'user_id' => 1, 'price' => 120.00, 'description' => 'O New Balance Fresh Foam More v4 é um tênis de corrida projetado para oferecer máximo conforto e amortecimento em longas distâncias. Este modelo faz parte da linha Fresh Foam da New Balance, conhecida por sua tecnologia de espuma suave e leve que proporciona uma experiência de corrida mais macia e responsiva. Com uma estética moderna e minimalista em preto e cinza, o Fresh Foam More v4 é ideal tanto para corredores quanto para uso casual, oferecendo estilo e funcionalidade em um só modelo.', 'color' => 'Preto', 'image' => 'images/shoes/tenis6.png', 'data_upload' => now(), 'category' => 'Esportivo', 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Fila Arcade Low', 'brand_id' => 8, 'user_id' => 1, 'price' => 150.00, 'description' => 'O Fila Arcade Low é um tênis casual que traz um visual retrô inspirado nos clássicos modelos dos anos 80 e 90, com um toque moderno que combina estilo e conforto. O design minimalista com linhas simples e sua paleta de cores em tons suaves de azul e branco tornam-no uma opção versátil para o dia a dia. O logotipo Fila em laranja adiciona um detalhe vibrante, dando um toque de autenticidade e personalidade ao modelo.', 'color' => 'Branco e azul', 'image' => 'images/shoes/tenis7.png', 'data_upload' => now(), 'category' => 'Casual', 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Converse Chuck Taylor All Star Move', 'brand_id' => 9, 'user_id' => 1, 'price' => 180.00, 'description' => 'O Converse Chuck Taylor All Star Move é uma variação moderna e estilizada do clássico Chuck Taylor, com um visual atualizado e uma plataforma elevada que oferece estilo e conforto extra. Esse modelo mantém os elementos icônicos do All Star, como o bico de borracha e o logotipo da Converse no tornozelo, mas traz uma silhueta ousada e contemporânea, com uma sola robusta que se destaca. É ideal para quem busca um visual casual com um toque moderno e diferenciado.', 'color' => 'Preto e branco', 'image' => 'images/shoes/tenis8.png', 'data_upload' => now(), 'category' => 'Casual', 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Adidas Superstar', 'brand_id' => 2, 'user_id' => 1, 'price' => 99.00, 'description' => 'O Adidas Superstar é um dos modelos mais icônicos da Adidas, originalmente lançado na década de 1970 como um tênis de basquete e rapidamente adotado pela cultura urbana e hip-hop. Seu design clássico e minimalista, com as inconfundíveis três listras e o “bico de concha” (shell toe) de borracha, tornou o Superstar uma peça atemporal, facilmente reconhecida e amplamente utilizada no mundo da moda casual e streetwear.', 'color' => 'Branco e preto', 'image' => 'images/shoes/tenis9.png', 'data_upload' => now(), 'category' => 'Casual', 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Puma X-Ray', 'brand_id' => 3, 'user_id' => 1, 'price' => 120.00, 'description' => 'O Puma X-Ray é um tênis casual de estilo chunky, inspirado na moda retrô dos anos 90 e no visual robusto dos tênis de corrida daquela época. Com uma combinação vibrante de cores, o modelo X-Ray se destaca pela sua estética moderna e impactante, ideal para compor looks ousados e cheios de personalidade. Esse tênis combina materiais variados em sua construção, proporcionando um visual dinâmico e uma experiência de conforto durante o uso.', 'color' => 'Cores variadas', 'image' => 'images/shoes/tenis10.png', 'data_upload' => now(), 'category' => 'Casual', 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Nike Revolution 6', 'brand_id' => 1, 'user_id' => 1, 'price' => 150.00, 'description' => 'O Nike Revolution 6 é um tênis de corrida versátil, projetado para oferecer conforto e leveza em corridas e atividades diárias. Com um design simples e funcional, ele é uma escolha popular tanto para corredores iniciantes quanto para aqueles que buscam um tênis confortável para o dia a dia. Este modelo combina uma entressola macia com um cabedal respirável, proporcionando suporte e amortecimento em uma estrutura leve.', 'color' => 'Preto e branco', 'image' => 'images/shoes/tenis11.png', 'data_upload' => now(), 'category' => 'Esportivo', 'created_at' => now(), 'updated_at' => now()],
            ['model' => 'Converse Chuck Taylor All Star High Top', 'brand_id' => 9, 'user_id' => 1, 'price' => 180.00, 'description' => 'O Converse Chuck Taylor All Star High Top é um clássico icônico, conhecido mundialmente pelo seu design atemporal e popularidade em diversas gerações. Originalmente lançado como um tênis de basquete, ele se tornou uma peça essencial na moda casual e streetwear, apreciado pelo seu estilo simples e versátil. O modelo mostrado é de cano alto, na cor azul claro, com o tradicional logotipo circular da Converse All Star no tornozelo.', 'color' => 'Azul e branco', 'image' => 'images/shoes/tenis12.png', 'data_upload' => now(), 'category' => 'Casual', 'created_at' => now(), 'updated_at' => now()],
        ]);
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
