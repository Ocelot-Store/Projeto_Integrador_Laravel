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

        // Passa todas as variáveis para a view
        return view('user.users', compact('users', 'seguindo', 'seguidores', 'seguindoLista', 'seguidoresLista'));
    }
}



