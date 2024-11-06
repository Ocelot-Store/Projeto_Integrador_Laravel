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
        // Obtém todos os usuários, exceto o usuário autenticado
        $users = User::where('id', '!=', Auth::id())->get();
    
        // Obtém os números e listas de seguidores e seguindo para o usuário logado
        $seguindo = Auth::user()->following()->count();
        $seguidores = Auth::user()->followers()->count();
        $seguindoLista = Auth::user()->following;
        $seguidoresLista = Auth::user()->followers;
    
        return view('user.index', compact('users', 'seguindo', 'seguidores', 'seguindoLista', 'seguidoresLista'));
    }
    


    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return view('user.user', compact('user'));
    }

    public function follow(User $user)
    {
        $currentUser = Auth::user();

        if (!$currentUser->following->contains($user->id)) {
            $currentUser->following()->attach($user->id);
        }

        return redirect()->back()->with('success', 'Você agora está seguindo ' . $user->name);
    }

    public function unfollow(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->following->contains($user->id)) {
            $currentUser->following()->detach($user->id);
        }

        return redirect()->back()->with('success', 'Você deixou de seguir ' . $user->name);
    }
}
