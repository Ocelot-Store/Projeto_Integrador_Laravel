@extends('posts.layout')

@section('content')
<div class="container">
    <div class="card">
        <p class="card-text">{{ $post->content }}</p>
        <p class="text-muted">
            <strong>{{ $post->user->name }}</strong><br>
            {{ $post->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}
        </p>
    </div>

    <h3>{{ $post->comments->count() }} Comentários</h3>
    
    <!-- Formulário de comentário -->
    <form action="{{ route('posts.comment.store', $post->id) }}" method="POST">
        @csrf
        <textarea name="content" rows="3" placeholder="Adicionar um comentário..." required></textarea>
        <button type="submit">Comentar</button>
    </form>

    <div class="comments-list">
        @foreach ($post->comments as $comment)
            <div class="comment">
                <p>{{ $comment->comment }}</p>
                <p class="text-muted">- {{ $comment->user->name }} ({{ $comment->created_at->format('d/m/Y H:i') }})</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
