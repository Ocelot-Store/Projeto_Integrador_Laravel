@extends('user.layout')

@section('title', 'Informações do Usuário')
<link rel="stylesheet" href="{{ asset('css/user/user.css') }}">
@section('style')

@endsection

@section('content')
@if (session('success'))
<div class="popup-message success" id="popup-success">
    <p>{{ session('success') }}</p>
    <button class="close-popup" onclick="closePopup('popup-success')">&times;</button>
</div>
@endif

@if (session('error'))
<div class="popup-message error" id="popup-error">
    <p>{{ session('error') }}</p>
    <button class="close-popup" onclick="closePopup('popup-error')">&times;</button>
</div>
@endif

@if ($errors->any())
<div class="popup-message error" id="popup-errors">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button class="close-popup" onclick="closePopup('popup-errors')">&times;</button>
</div>
@endif

<div class="main-container">

    <!-- Cabeçalho do Perfil -->
    <header class="profile-header">

        <div class="profile-cover">
            <form id="update-profile-cover-form" action="{{ route('user.updateProfileCover') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="profile-cover-input" name="profile_cover" accept="image/*" style="display: none;" onchange="submitProfileCoverForm()">
                <img src="{{ $user->profileCoverUrl }}" alt="Imagem da Capa" class="overlay-image">
                <button type="button" class="upload-cover-button" onclick="document.getElementById('profile-cover-input').click();">
                    <img src="{{ asset('assets/AddProfileCover.png') }}" alt="Upload Icon" class="upload-icon">
                </button>
            </form>
        </div>


        <div class="profile-picture">
            <form id="update-profile-picture-form" action="{{ route('user.updateProfilePicture') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="profile-picture-input" name="profile_image" accept="image/*" style="display: none;" onchange="submitProfilePictureForm()">
                <img src="{{ $user->profile_image_url }}" alt="Imagem do Usuário" class="profile-pic" onclick="document.getElementById('profile-picture-input').click();">
            </form>
        </div>

        <h1 style="font-size: 2.0rem; margin: 1rem;">{{$user->name}}</h1>



        <div class="user-options">
            <a href="{{ route('addShoe') }}" class="button">+ ADICIONAR CALÇADOS</a>
            <a href="{{ route('cart.index') }}" class="button"> VER CARRINHO</a>
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
                @if(isset($shoes) && $shoes->isNotEmpty())
                @foreach ($shoes as $shoe)
                <a href="{{ route('viewShoe', $shoe->id) }}">
                    <div class="for-sale-container">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $shoe->image) }}" alt="Imagem do Tênis" class="img-fluid">
                            </div>
                            <div class="product-details">
                                <h2>{{ \Illuminate\Support\Str::limit($shoe->model, 15) }} <span class="new-label">NEW</span></h2>
                                <p class="category">{{ $shoe->category}}</p>
                                <p class="description">{{ $shoe->description }}</p>
                                <p class="price">$ {{ $shoe->price }}</p>
                                <div class="actions">
                                    <a href="{{ route('shoe.edit', $shoe->id) }}" class="edit-button">EDITAR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <p>Nenhum produto à venda por este usuário.</p>
                @endif
            </section>
        </div>

        <div id="Favoritos" class="tab-content">
            <!-- Seção de Produtos Favoritos -->
            <section class="products">
                @if(isset($favorites) && $favorites->isNotEmpty())
                @foreach ($favorites as $favorito)
                <a href="{{ route('viewShoe', $favorito->id) }}">
                    <div class="for-sale-container">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $favorito->shoe->image) }}" alt="Imagem do Tênis" class="img-fluid">
                            </div>
                            <div class="product-details">
                                <h2>{{ $favorito->shoe->model }} <span class="new-label">NEW</span></h2>
                                <p class="category">Nike Dunk Low</p>
                                <p class="description">{{ $favorito->shoe->description }}</p>
                                <p class="price">$ {{ $favorito->shoe->price }}</p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <p>Nenhum produto adicionado aos favoritos.</p>
                @endif
            </section>
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

    // Envia formulário de atualização da imagem do perfil
    function submitProfilePictureForm() {
        const form = document.getElementById('update-profile-picture-form');
        form.submit();
    }

    // Envia formulário de atualização da capa do perfil
    function submitProfileCoverForm() {
        const form = document.getElementById('update-profile-cover-form');
        form.submit();
    }

    // Fecha popup com base no id recebido como parâmetro
    function closePopup(id) {
        const popup = document.getElementById(id);
        if (popup) {
            popup.style.display = 'none';
        }
    }

    // Remove popups automaticamente após 5 segundos
    setTimeout(() => {
        document.querySelectorAll('.popup-message').forEach(popup => {
            popup.style.display = 'none';
        });
    }, 5000); // 5000 ms = 5 segundos
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