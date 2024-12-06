<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Shoe;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Exibe a lista de posts e o formulário para criar novos
    public function index(Request $request)
    {
        $shoeId = $request->query('shoe_id', null); // Se não houver 'shoe_id' na URL, o valor será null
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get(); // Recupera posts com os usuários associados
        $users = User::all();
        $shoe = null;

        if ($shoeId) {
            $shoe = Shoe::find($shoeId); // Tenta encontrar o tênis pelo ID
        }

        return view('posts.index', compact('posts', 'users', 'shoeId', 'shoe'));
    }

    // Armazena um novo post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'shoe_id' => 'nullable|exists:shoe,id', // Valida se o ID do tênis existe
        ]);

        Post::create([
            'user_id' => auth()->id(), // ID do usuário autenticado
            'shoe_id' => $validated['shoe_id'] ?? null, // Se não for fornecido, o valor será null
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
