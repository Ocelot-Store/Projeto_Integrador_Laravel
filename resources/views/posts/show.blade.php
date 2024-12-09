@extends('posts.layout')

@section('title', 'Comunidade')

@section('style')
<link rel="stylesheet" href="{{ asset('css/posts/comments.css') }}">
@endsection

@section('content')
<div class="container">
    <!-- Post principal -->
    <div class="card">
        <!-- Cabeçalho do post: imagem e nome do usuário -->
        <div class="card-info">
            <img class="user-image" src="{{ $post->user->profileImage ? asset('storage/' . $post->user->profileImage) : asset('assets/DarkUser.png') }}" alt="Imagem de Perfil">
            <div>
                <strong>{{ $post->user->name }}</strong>
                <p class="post-time">{{ $post->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Conteúdo do post -->
        <p class="card-text">{{ $post->content }}</p>

        <!-- Se o post tiver um tênis associado, exibe a imagem e informações -->
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

        <!-- Data e hora do post -->
        
    </div>

    <!-- Formulário de comentário -->
    <div class="comment-section">
        <form action="{{ route('posts.comment.store', $post->id) }}" method="POST" class="comment-form">
            @csrf
            <div style="display: flex; gap: 5px; margin-bottom: 5px;">
                <img src="{{ Auth::user()->profileImage ? asset('storage/' . Auth::user()->profileImage) : asset('assets/DarkUser.png') }}" class="user-image" alt="">
                <textarea name="content" rows="3" placeholder="Adicionar um comentário..." required></textarea>
            </div>
            <button type="submit">Comentar</button>
        </form>

        <!-- Lista de comentários -->

        <h3>{{ $post->comments->count() }} Comentários</h3>
        <div class="comments-list">
            @foreach ($post->comments as $comment)
            <div class="comment">
                <div class="comment-info" >
                    <img class="user-image" src="{{ $comment->user->profileImage ? asset('storage/' . $comment->user->profileImage) : asset('assets/DarkUser.png') }}" style="min-width: 50px;" alt="Imagem de Perfil">
                    <div style="display: flex; flex-direction: column; margin-top: 10px;">
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <strong style="margin-right: 5px;">- {{ $comment->user->name }} </strong>
                            <p style="margin:0;" >({{ $comment->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }})</p>
                        </div>
                        <p>{{ $comment->comment }}</p>
                    </div>
                </div>
                
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection