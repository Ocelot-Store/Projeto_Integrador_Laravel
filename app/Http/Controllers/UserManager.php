<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Para acessar informações do usuário autenticado
use Illuminate\Http\Request;

class UserManager extends Controller
{
    public function show()
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Retorna a view com as informações do usuário
        // O compact cria um array associativo a partir de variáveis
        return view('user', compact('user'));
    }
}

