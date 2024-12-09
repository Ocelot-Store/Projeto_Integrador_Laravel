<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Para acessar informações do usuário autenticado
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shoe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Favorite;

class UserManager extends Controller
{
    public function userMenu()
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Obtém todos os sapatos do usuário
        $shoes = $user->shoes;

        $favorites = Favorite::where('user_id', Auth::id())->get();

        // Retorna a view com as informações do usuário e seus sapatos
        return view('user.user', compact('user', 'shoes', 'favorites'));
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
        $seguindo = $user->following()->count();
        $seguidores = $user->followers()->count();
        $shoes = $user->shoes; // Caso queira exibir os sapatos do usuário
    
        return view('user.otherUser', compact('user', 'seguindo', 'seguidores', 'shoes'));
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


    public function updateProfilePicture(Request $request)
    {
        $user = Auth::user();

        // Validação do arquivo
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Processa o upload da imagem
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Altere o caminho para 'images/users'
            $filePath = $file->storeAs('public/images/users', $fileName);

            // Remover imagem antiga, se existir
            if ($user->profileImage && Storage::exists('public/' . $user->profileImage)) {
                Storage::delete('public/' . $user->profileImage);
            }

            // Atualiza o caminho da imagem no banco de dados
            $user->profileImage = 'images/users/' . $fileName;
            $user->save();

            return redirect()->back()->with('success', 'Imagem de perfil atualizada com sucesso!');
        }



        return redirect()->back()->with('error', 'Falha ao fazer o upload da imagem.');
    }
    public function updateProfileCover(Request $request)
    {
        $user = Auth::user();

        // Validação do arquivo
        $request->validate([
            'profile_cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Processa o upload da imagem
        if ($request->hasFile('profile_cover')) {
            $file = $request->file('profile_cover');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Salva a imagem em 'public/images/users'
            $filePath = $file->storeAs('public/images/users', $fileName);

            // Remover a imagem de capa antiga, se existir
            if ($user->profileCover && Storage::exists('public/' . $user->profileCover)) {
                Storage::delete('public/' . $user->profileCover);
            }

            // Atualiza o caminho da imagem no banco de dados
            $user->profileCover = 'images/users/' . $fileName;
            $user->save();

            return redirect()->back()->with('success', 'Capa do perfil atualizada com sucesso!');
        }

        return redirect()->back()->with('error', 'Falha ao fazer o upload da imagem.');
    }
}
