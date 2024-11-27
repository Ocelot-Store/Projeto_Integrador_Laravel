<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Exibe a lista de posts e o formulário para criar novos
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get(); // Recupera posts com os usuários associados
        $users = User::all();

        return view('posts.index', compact('posts', 'users'));
    }

    // Armazena um novo post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000', // Validação para o conteúdo do post
        ]);
        Post::create([
            'user_id' => auth()->id(), // ID do usuário autenticado
            'shoe_id' => 1, // Substituir pelo ID do tênis, se necessário
            'content' => $validated['content'], // Envia o conteúdo validado
        ]);

        return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
    }

    public function storeComment(Request $request, $postId)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        // Cria o comentário
        Comment::create([
            'comment' => $validated['content'],
            'user_id' => auth()->id(),
            'post_id' => $postId,
        ]);

        return redirect()->route('posts.show', $postId)->with('success', 'Comentário adicionado!');
    }

    public function show(Post $post)
    {
        // Recupera o post com os comentários
        $post->load('comments.user'); // Carrega os comentários e os usuários associados

        return view('posts.show', compact('post'));
    }
}
