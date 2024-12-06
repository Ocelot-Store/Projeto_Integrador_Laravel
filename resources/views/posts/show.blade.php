@extends('posts.layout')

@section('title', 'Comunidade')

@section('style')  
<link rel="stylesheet" href="{{ asset('css/posts/comments.css') }}"> 
@endsection


@section('content')
<div class="container">
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

                </div>
            </div>

    
    
    <!-- Formulário de comentário -->
    <form action="{{ route('posts.comment.store', $post->id) }}" method="POST" class="comment-form">
        @csrf
        <textarea name="content" rows="3" placeholder="Adicionar um comentário..." required></textarea>
        <button type="submit">Comentar</button>
    </form>

    <h3>{{ $post->comments->count() }} Comentários</h3>

    <div class="comments-list">
        @foreach ($post->comments as $comment)
            <div class="comment">
                <p>{{ $comment->comment }}</p>
                <p class="text-muted">- {{ $comment->user->name }} ({{ $comment->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }})</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
