<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Shoe;
use App\Models\Brand;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Exibe a lista de posts e o formulário para criar novos
    public function index(Request $request)
    {
        $selectedBrand = $request->query('brand_id', null); // Obtém a marca selecionada
        $shoeId = $request->query('shoe_id', null); // Obtém o ID do tênis, se fornecido

        // Constrói a query de posts
        $postsQuery = Post::with(['user', 'shoe.brand'])
            ->orderBy('created_at', 'desc');

        // Aplica o filtro por marca, se necessário
        if ($selectedBrand) {
            $postsQuery->whereHas('shoe', function ($query) use ($selectedBrand) {
                $query->where('brand_id', $selectedBrand);
            });
        }

        $posts = $postsQuery->get(); // Obtém os posts filtrados
        $brands = Brand::all(); // Lista de marcas para o dropdown
        $users = User::all(); // Lista de usuários
        $shoe = $shoeId ? Shoe::find($shoeId) : null; // Carrega o tênis, se fornecido

        return view('posts.index', compact('posts', 'users', 'shoeId', 'shoe', 'brands', 'selectedBrand'));
    }


    // Armazena um novo post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'shoe_id' => 'nullable|exists:shoe,id',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'shoe_id' => $validated['shoe_id'] ?? null,
            'content' => $validated['content'],
        ]);

        return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
    }

    public function storeComment(Request $request, $postId)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Comment::create([
            'comment' => $validated['content'],
            'user_id' => auth()->id(),
            'post_id' => $postId,
        ]);

        return redirect()->route('posts.show', $postId)->with('success', 'Comentário adicionado!');
    }

    public function show(Post $post)
    {
        // Verificar se o post tem um 'shoe_id' válido
        if (!$post->shoe_id) {
            return redirect()->back()->with('error', 'Este post não tem um tênis associado.');
        }
    
        // Carregar os comentários com os usuários associados
        $post->load('comments.user');
    
        // Buscar posts relacionados com o mesmo 'shoe_id' do post atual, excluindo o próprio post
        $relatedPosts = Post::with(['user', 'shoe.brand'])
            ->where('shoe_id', $post->shoe_id)
            ->where('id', '!=', $post->id) // Excluir o próprio post
            ->latest() // Ordenar pelos posts mais recentes
            ->limit(3) // Limitar a quantidade de posts relacionados
            ->get();
    
        // Passar os dados para a view
        return view('posts.show', compact('post', 'relatedPosts'));
    }
    

    public function following(Request $request)
    {
        $selectedBrand = $request->query('brand_id', null); // Obtém a marca selecionada

        $postsQuery = Post::with(['user', 'comments', 'shoe.brand'])
            ->whereIn('user_id', Auth::user()->following->pluck('id'))
            ->latest();

        // Aplica o filtro por marca, se necessário
        if ($selectedBrand) {
            $postsQuery->whereHas('shoe', function ($query) use ($selectedBrand) {
                $query->where('brand_id', $selectedBrand);
            });
        }

        $posts = $postsQuery->get();
        $users = User::all();
        $brands = Brand::all();

        return view('posts.index', compact('posts', 'users', 'brands', 'selectedBrand'))->with('followingOnly', true);
    }

    public function myPosts(Request $request)
    {
        $selectedBrand = $request->query('brand_id', null); // Obtém a marca selecionada

        $postsQuery = Post::with(['user', 'comments', 'shoe.brand'])
            ->where('user_id', Auth::id())
            ->latest();

        // Aplica o filtro por marca, se necessário
        if ($selectedBrand) {
            $postsQuery->whereHas('shoe', function ($query) use ($selectedBrand) {
                $query->where('brand_id', $selectedBrand);
            });
        }

        $posts = $postsQuery->get();
        $users = User::all();
        $brands = Brand::all();

        return view('posts.index', compact('posts', 'users', 'brands', 'selectedBrand'));
    }


    public function filterByBrand(Request $request)
    {
        $brand = Brand::find($request->brand_id);

        $postsQuery = Post::with(['user', 'shoe.brand'])->latest();

        if ($brand) {
            $postsQuery->whereHas('shoe', function ($query) use ($brand) {
                $query->where('brand_id', $brand->id);
            });
        }

        $posts = $postsQuery->get();
        $brands = Brand::all();
        $users = User::all();
        $selectedBrand = $request->brand_id;

        return view('posts.index', compact('posts', 'brands', 'users', 'selectedBrand'));
    }

    public function delete(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Ação não autorizada.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post excluído com sucesso!');
    }
    
    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    

}
