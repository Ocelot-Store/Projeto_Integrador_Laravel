@extends('posts.layout')

@section('title', 'Comunidade')

@section('style')
<link rel="stylesheet" href="{{ asset('css/posts/posts.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>Comunidade</h1>

    <!-- Formulário para Criar Post -->
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <textarea id="content" name="content" rows="3" placeholder="O que está acontecendo?" required></textarea>
        <button type="submit">Postar</button>
    </form>

    <div class="posts-container">
        <!-- Lista de Posts -->

        <div class="posts-list">
            @foreach ($posts as $post)
            <div class="card">
                <p class="card-text">{{ $post->content }}</p>
                <p class="text-muted">
                    <strong>{{ $post->user->name }}</strong><br>
                    {{ $post->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}
                </p>
                <a href="{{ route('posts.show', $post->id) }}">Ver Comentários ({{ $post->comments->count() }})</a>
                <img src="{{ $post->user->profileImage ? asset('storage/' . $post->user->profileImage) : asset('assets/DarkUser.png') }}" alt="Imagem de Perfil">
            </div>
            @endforeach
        </div>
        <!-- Lista de Usuários -->
        <div class="users-list">
            <h2>Pessoas de relevância</h2>
            @foreach ($users as $user)
            @if($user->id !== Auth::id())
            <a href="{{ route('user.show', $user->id) }}">
                <div class="user-card">
                    <div class="user-info">
                        <img src="{{ $post->user->profileImage ? asset('storage/' . $post->user->profileImage) : asset('assets/DarkUser.png') }}" alt="Imagem de Perfil">
                        <p class="user-card-text">{{ $user->name }}</p>
                    </div>
                    
                    <div class="follow-button">
                        @if(Auth::user()->following->contains($user->id))
                        <form action="{{ route('user.unfollow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="follow-btn unfollow">Deixar de Seguir</button>
                        </form>
                        @else
                        <form action="{{ route('user.follow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="follow-btn">Seguir</button>
                        </form>
                        @endif
                    </div>
                </div>
            </a>   
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection