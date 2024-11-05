@extends('user.layout')

@section('title', 'Informações do Usuário')
<link rel="stylesheet" href="{{ asset('css/user/user.css') }}">
@section('style')

@endsection

@section('content')
<div class="main-container">

    <!-- Cabeçalho do Perfil -->
    <header class="profile-header">
        <div class="profile-cover">
            <img src="{{ asset('assets/fundo_index.jpg') }}" alt="Imagem sobreposta" class="overlay-image">
        </div>

        <div class="profile-picture">
            <img src="{{ asset($user->profile_image ? 'images/' . $user->profile_image : 'assets/AddImage.png') }}" alt="Imagem do Usuário" class="profile-pic">
        </div>

        <div class="user-options">
            <a href="{{ route('addShoe') }}" class="button">+ ADICIONAR CALÇADOS</a>
            <a href="{{ route('cart.index') }}" class="button">Ver Carrinho</a>
        </div>
    </header>


    <!-- Seção de Abas -->
    <div class="tabs-container">
        <div class="tabs">
            <a href="#Produtos-de-Venda" class="tab active">
                <i class="icon icon-grid"></i> PRODUTOS A VENDA
            </a>
            <a href="#Favoritos" class="tab">
                <i class="icon icon-bookmark"></i> FAVORITOS
            </a>
        </div>

        <div id="Produtos-de-Venda" class="tab-content active">
            <!-- Seção de Produtos à Venda -->
            <section class="products">
                @foreach ($shoes as $shoe)
                <div class="for-sale-container">
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
                                @foreach([36, 37, 38, 40, 42] as $size)
                                <button class="size-btn">{{ $size }}</button>
                                @endforeach
                            </div>

                            <button class="buy-btn">COMPRAR</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </section>
        </div>

        <div id="Favoritos" class="tab-content">
            Favoritos
        </div>
    </div>


</div>

<script>
    // Alternar modo de edição
    function toggleEditMode() {
        const form = document.getElementById('user-form');
        const display = document.getElementById('user-display');

        form.style.display = form.style.display === 'none' ? 'block' : 'none';
        display.style.display = display.style.display === 'none' ? 'block' : 'none';
    }

    // Alternar abas
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function(event) {
            event.preventDefault();

            document.querySelectorAll('.tab, .tab-content').forEach(element => element.classList.remove('active'));

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
@endsection