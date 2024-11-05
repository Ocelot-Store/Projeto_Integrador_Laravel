@extends('user.layout')

@section('title', 'Informações do Usuário')
<link rel="stylesheet" href="{{ asset('css/user/user.css') }}">
@section('style')

@endsection

@section('content')
<div class="main-container">

    <!-- Cabeçalho do Perfil -->
    <header class="profile-header">
        <!-- Imagem de Capa do Perfil -->
        <div class="profile-cover">
            <img src="{{ asset('assets/fundo_index.jpg') }}" alt="Imagem sobreposta" class="overlay-image">
        </div>

        <!-- Imagem do Usuário -->
        <div class="profile-picture">
            <img src="{{ asset($user->profile_image ? 'images/' . $user->profile_image : 'assets/AddImage.png') }}" alt="Imagem do Usuário" class="profile-pic">
        </div>

        <div class="user-options">
            <a href="{{ route('addShoe') }}" class="button">+ ADICIONAR CALÇADOS</a>
            <a href="{{ route('cart.index') }}" class="button">Ver Carrinho</a>
        </div>


    </header>

    <!-- Botão Voltar -->
    <div class="back-buttons">
        <a href="{{ route('home') }}" class="button-secondary">VOLTAR</a>
    </div>

    <!-- Seção de Abas -->
    <div class="tabs-container">
        <div class="tabs">
            <a href="#Produtos de Venda" class="tab active">
                <i class="icon icon-grid"></i> PRODUTOS DE VENDA
            </a>
            <a href="#Favoritos" class="tab">
                <i class="icon icon-bookmark"></i> FAVORITOS
            </a>
        </div>

        <div id="Produtos de Venda" class="tab-content active">
            Produtos a Venda
        </div>

        @foreach ($shoes as $shoe)
        <div class="container">
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('storage/' . $shoe->image) }}" alt="Imagem tenis" class="img-fluid">
                </div>
                <div class="product-details">
                    <h2>{{ $shoe->model }} <span class="new-label">NEW</span></h2>
                    <p class="category">Nike Dunk Low</p>
                    <p class="description">{{ $shoe->description }}</p>
                    <p class="price">{{ $shoe->price }}</p>

                    <div class="color-options">
                        <span class="color" style="background-color: #ff0000;" title="Rojo"></span>
                        <span class="color" style="background-color: #0000ff;" title="Azul"></span>
                        <span class="color" style="background-color: #00ff00;" title="Verde"></span>
                    </div>

                    <div class="size-options">
                        <button class="size-btn">36</button>
                        <button class="size-btn">37</button>
                        <button class="size-btn">38</button>
                        <button class="size-btn">40</button>
                        <button class="size-btn">42</button>
                    </div>

                    <button class="buy-btn">COMPRAR</button>
                </div>
            </div>
        </div>
             @endforeach
        <div id="Favoritos" class="tab-content">
            Favoritos
        </div>
    </div>

    <!-- Seção de Produtos à Venda -->
    <section class="products">
        <div class="container">
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('assets/tenis1.png') }}" alt="Imagem tenis" class="img-fluid">
                </div>
                <div class="product-details">
                    <h2>Nike Dunk Low <span class="new-label">NEW</span></h2>
                    <p class="category">Nike Dunk Low</p>
                    <p class="description">é um modelo de tênis bastante popular e icônico, lançado inicialmente nos anos 80. Ele foi projetado para ser um tênis unissex, atraindo tanto homens quanto mulheres.</p>
                    <p class="price">R$2000.99</p>

                    <div class="color-options">
                        <span class="color" style="background-color: #ff0000;" title="Rojo"></span>
                        <span class="color" style="background-color: #0000ff;" title="Azul"></span>
                        <span class="color" style="background-color: #00ff00;" title="Verde"></span>
                    </div>

                    <div class="size-options">
                        <button class="size-btn">36</button>
                        <button class="size-btn">37</button>
                        <button class="size-btn">38</button>
                        <button class="size-btn">40</button>
                        <button class="size-btn">42</button>
                    </div>

                    <button class="buy-btn">VER DETALHES</button>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript para Alternar Modo de Edição e Alternar Abas -->
<script>
    function toggleEditMode() {
        const form = document.getElementById('user-form');
        const display = document.getElementById('user-display');

        if (form.style.display === 'none') {
            form.style.display = 'block';
            display.style.display = 'none';
        } else {
            form.style.display = 'none';
            display.style.display = 'block';
        }
    }

    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function(event) {
            event.preventDefault();

            // Remove a classe 'active' de todas as abas e conteúdos
            document.querySelectorAll('.tab, .tab-content').forEach(element => {
                element.classList.remove('active');
            });

            // Adiciona a classe 'active' na aba e no conteúdo atual
            tab.classList.add('active');
            document.querySelector(tab.getAttribute('href')).classList.add('active');
        });
    });
</script>

<!-- Integração com o VLibras -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>

<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>
<!-- Fim da Integração VLibras -->

@endsection