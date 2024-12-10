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
            <a href="{{ route('posts.index') }}"><button><img src="{{ asset('assets/postsHome.png') }}" alt=""> Início</button></a>
            <a href="{{ route('posts.following') }}"><button><img src="{{ asset('assets/postsFollowing.png') }}" alt=""> Seguindo</button></a>
            <a href="{{ route('posts.myPosts') }}"><button><img src="{{ asset('assets/postsMyPosts.png') }}" alt=""> Meus Posts</button></a>

            <!-- Menu de Brands -->
            <form method="GET" action="{{ route('posts.index') }}" class="d-flex align-items-center mb-4">
                <select name="brand_id" id="brand_id" class="form-select w-auto" onchange="this.form.submit()">
                    <option value="">Todas as Marcas</option>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $selectedBrand == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                    @endforeach
                </select>
            </form>



        </div>

        <!-- Lista de Posts -->
        <div class="posts-list">
            @if (!isset($followingOnly))
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                @if (isset($shoeId))
                <input type="hidden" name="shoe_id" value="{{ $shoeId }}">
                @endif
                <div style="display: flex; gap: 10px; margin-bottom: 5px;">
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

                    @if (isset($shoe))
                    <a href="{{ route('posts.index') }}" class="cancel-btn">
                        Cancelar
                    </a>
                    @endif
                </div>
            </form>
            @endif

            @foreach ($posts as $post)
            <div class="card">
                <a href="{{ route('user.show', $post->user->id) }}">
                    <img class="user-image" src="{{ $post->user->profileImage ? asset('storage/' . $post->user->profileImage) : asset('assets/DarkUser.png') }}" alt="Imagem de Perfil">
                </a>
                <div class="card-info">
                    <a href="{{ route('user.show', $post->user->id) }}">
                        <p class="text-muted">
                            <strong>{{ $post->user->name }}</strong>
                            {{ $post->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}
                        </p>
                    </a>
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
                    @if (Auth::id() === $post->user_id)
                    <form action="{{ route('posts.delete', $post->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">
                            <img src="{{ asset('assets/postsDelete.png') }}" alt="">  
                        </button>
                    </form>
                    @endif

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