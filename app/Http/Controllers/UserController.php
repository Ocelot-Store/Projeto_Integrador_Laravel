<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Importa o modelo User

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Usuário autenticado

        // Recupera todos os usuários para exibir na lista
        $users = User::all();

        // Contagem de usuários que o usuário autenticado está seguindo
        $seguindo = $user->following()->count();

        // Contagem de seguidores do usuário autenticado
        $seguidores = $user->followers()->count();

        // Lista completa dos usuários que o usuário autenticado está seguindo
        $seguindoLista = $user->following;

        // Lista completa dos seguidores do usuário autenticado
        $seguidoresLista = $user->followers;

        $isSearch = false;

        // Passa todas as variáveis para a view
        return view('user.users', compact('users', 'seguindo', 'seguidores', 'seguindoLista', 'seguidoresLista', 'isSearch'));
    }

    public function search(Request $request)
    {

        $user = auth()->user();
        
        $query = $request->input('query');

        // Contagem de usuários que o usuário autenticado está seguindo
        $seguindo = $user->following()->count();

        // Contagem de seguidores do usuário autenticado
        $seguidores = $user->followers()->count();

        // Lista completa dos usuários que o usuário autenticado está seguindo
        $seguindoLista = $user->following;

        // Lista completa dos seguidores do usuário autenticado
        $seguidoresLista = $user->followers;

        // Valida se o termo de busca está presente
        if (!$query) {
            return redirect()->route('users')->with('error', 'Digite um termo para buscar.');
        }

        // Realiza a busca nos modelos e nas marcas
        $searchedUsers = User::where('name', 'LIKE', "%{$query}%")->get();

        // Indica que a página está em modo de busca
        $isSearch = true;

        return view('user.users', compact('searchedUsers', 'seguindo', 'seguidores', 'seguindoLista', 'seguidoresLista', 'isSearch', 'query'));
    }
}



