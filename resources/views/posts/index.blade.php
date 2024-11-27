@extends('posts.layout')

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
            <h2>Usuários</h2>
            @foreach ($users as $user)
                <div class="card">
                    <p class="card-text">{{ $user->name }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
