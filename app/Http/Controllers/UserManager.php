<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Para acessar informações do usuário autenticado
use Illuminate\Http\Request;
use App\Models\User;

class UserManager extends Controller
{
    public function userMenu()
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Retorna a view com as informações do usuário
        // O compact cria um array associativo a partir de variáveis
        return view('user.user', compact('user'));
    }
    
    public function usersMenu()
    {
        // Obtém todos os usuários
        $users = User::all();

        // Retorna a view com a lista de todos os usuários
        return view('user.users', compact('users'));
    }
}

