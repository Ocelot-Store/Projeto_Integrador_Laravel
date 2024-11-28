@extends('user.layout')

@section('title', 'Perfil de {{ $user->name }}')

@section('style')
<link rel="stylesheet" href="{{ asset('css/user/user.css') }}">
@endsection

@section('content')
<div class="main-container">

    <!-- Cabeçalho do Perfil -->
    <header class="profile-header">
        <div class="profile-cover">
            <img src="{{ $user->profileCover ? asset('storage/' . $user->profileCover) : asset('assets/ProfileCover.png') }}"
                 alt="Capa de {{ $user->name }}"
                 class="overlay-image">
        </div>

        <div class="profile-picture">
            <img src="{{ $user->profileImage ? asset('storage/' . $user->profileImage) : asset('assets/DarkUser.png') }}"
                 alt="Imagem de perfil de {{ $user->name }}"
                 class="profile-pic">
        </div>

        <h1 style="font-size: 2.0rem; margin: 1rem;">{{ $user->name }}</h1>

        @if(Auth::id() !== $user->id)
        <div class="user-options">
            @if(Auth::user()->following->contains($user->id))
            <form action="{{ route('user.unfollow', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="button-secondary">Deixar de Seguir</button>
            </form>
            @else
            <form action="{{ route('user.follow', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="button">Seguir</button>
            </form>
            @endif
        </div>
        @endif
    </header>

    <!-- Seção de Abas -->
    <div class="tabs-container">
        <div class="tabs">
            <a href="#Produtos-de-Venda" class="tab active">
                <i class="icon icon-grid"></i> PRODUTOS A VENDA
            </a>
        </div>

        <div id="Produtos-de-Venda" class="tab-content active">
            <!-- Seção de Produtos à Venda -->
            <section class="products">
                @if(isset($shoes) && $shoes->isNotEmpty())
                    @foreach ($shoes as $shoe)
                    <div class="for-sale-container">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $shoe->image) }}" alt="Imagem do Tênis" class="img-fluid">
                            </div>
                            <div class="product-details">
                                <h2>{{ $shoe->model }} <span class="new-label">NEW</span></h2>
                                <p class="category">Nike Dunk Low</p>
                                <p class="description">{{ $shoe->description }}</p>
                                <p class="price">$ {{ $shoe->price }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <p>Nenhum produto à venda por este usuário.</p>
                @endif
            </section>
        </div>
    </div>

</div>

<script>
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
@endsection
