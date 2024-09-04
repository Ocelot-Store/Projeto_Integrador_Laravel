<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Use o modelo User para interagir com a tabela de usuários
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registration'); // Retorna a view de registro
    }

    public function register(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Confirmar senha
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Criação do usuário
        $user = User::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Autenticar o usuário e redirecionar
        auth()->login($user);

        return redirect()->route('view.shoes'); // Redireciona para a página de visualização dos sapatos
    }
}
