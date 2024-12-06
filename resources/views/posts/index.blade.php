@extends('posts.layout')

@section('title', 'Comunidade')

@section('style')
<link rel="stylesheet" href="{{ asset('css/posts/index.css') }}">
@endsection

@section('content')
<div class="container">

    <!-- Formulário para Criar Post -->


    <div class="posts-container">
        <div class="menu">
            <button>Home</button>
            <button><img src="{{ asset('assets/postsFollowing.png') }}" alt=""> Following</button>
            <button><img src="{{ asset('assets/postsMyPosts.png') }}" alt=""> My posts</button>
        </div>
        <!-- Lista de Posts -->
        <div class="posts-list">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                @if (isset($shoeId))
                <input type="hidden" name="shoe_id" value="{{ $shoeId }}">
                @endif
                <div style="display: flex; gap: 10px;">
                    <img src="{{ Auth::user()->profileImage ? asset('storage/' . Auth::user()->profileImage) : asset('assets/DarkUser.png') }}" class="user-image" alt="">
                    <textarea id="content" name="content" rows="3" placeholder="O que está acontecendo?" required></textarea>
                </div>

                @if (isset($shoe))
                <div class="shoe-image-container">
                    <p>Você está postando sobre o seguinte tênis:</p>
                    <div class="shoe-item">
                        <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" width="200">
                        <div class="shoe-info-name">
                            <span class="model">{{ $shoe->model }}</span> <br>
                        </div>
                        <div class="shoe-info-otherinfo">
                            <span class="brand">{{ $shoe->brand->name }}</span>
                            •
                            <span class="price">$ {{ $shoe->price }}</span>
                        </div>
                    </div>
                </div>
                @endif

                <div class="button-container">
                    <button type="submit">Postar</button>

                    <!-- Exibe o botão de Cancelar apenas se houver um shoe_id setado -->
                    @if (isset($shoe))
                    <a href="{{ route('posts.index') }}" class="cancel-btn">
                        Cancelar
                    </a>
                    @endif
                </div>
            </form>
            @foreach ($posts as $post)
            <div class="card">
                <img class="user-image" src="{{ $post->user->profileImage ? asset('storage/' . $post->user->profileImage) : asset('assets/DarkUser.png') }}" alt="Imagem de Perfil">
                <div class="card-info">
                    <p class="text-muted">
                        <strong>{{ $post->user->name }}</strong>
                        {{ $post->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}
                    </p>
                    <p class="card-text">{{ $post->content }}</p>
                    <!-- Verifica se o post tem um shoe_id associado e exibe o tênis -->
                    @if ($post->shoe_id)
                    @php
                    $shoe = App\Models\Shoe::find($post->shoe_id);
                    @endphp
                    <a href="{{ route('viewShoe', $shoe->id) }}">
                        <div class="shoe-item">
                            <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" width="200">
                            <div class="shoe-info-name">
                                <span class="model">{{ $shoe->model }}</span> <br>
                            </div>
                            <div class="shoe-info-otherinfo">
                                <span class="brand">{{ $shoe->brand->name }}</span>
                                •
                                <span class="price">$ {{ $shoe->price }}</span>
                            </div>
                        </div>
                    </a>
                    @endif
                    <div class="comments">
                        <a href="{{ route('posts.show', $post->id) }}"><img src="{{ asset('assets/comments.png') }}" alt=""> ({{ $post->comments->count() }})</a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        <!-- Lista de Usuários -->
        <div class="users-list">
            <h2>Quem seguir</h2>
            @foreach ($users as $user)
            @if($user->id !== Auth::id())
            <a href="{{ route('user.show', $user->id) }}">
                <div class="user-card">
                    <div class="user-info">
                        <img src="{{ $user->profileImage ? asset('storage/' . $user->profileImage) : asset('assets/DarkUser.png') }}" alt="Imagem de Perfil">
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