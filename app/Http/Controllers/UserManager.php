<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Para acessar informações do usuário autenticado
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shoe;

class UserManager extends Controller
{
    public function userMenu()
    {
        // Obtém o usuário autenticado
        $user = Auth::user();
    
        // Obtém todos os sapatos do usuário
        $shoes = $user->shoes;
    
        // Retorna a view com as informações do usuário e seus sapatos
        return view('user.user', compact('user', 'shoes'));
    }
    

    public function usersMenu()
    {
        // Obtém todos os usuários
        $users = User::all();

        // Retorna a view com a lista de todos os usuários
        return view('user.users', compact('users'));
    }


    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return view('user.user', compact('user'));
    }


}
