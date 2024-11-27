<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shoe;
use App\Models\Brand;
use App\Models\Favorite;
use App\Models\User;


class ShoeManager extends Controller
{
    function addShoe()
    {
        $brands = Brand::all(); // Pegando todas as brands cadastradas
        return view('shoe.addShoe', compact('brands')); // Passando as brands para a view
    }

    function addShoePost(Request $request)
    {
        $request->validate([
            'model' => 'required',
            'size' => 'required',
            'color' => 'required',
            'brand_id' => 'required|exists:brand,id',  // Validação para garantir que o brand_id exista
            'price' => 'required|numeric|min:0', // Validação para o preço
            'description' => 'required|string|max:500', // Validação para a descrição
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validação da imagem

        ]);

        $data = $request->only('model', 'size', 'color', 'brand_id', 'price', 'description'); // Incluindo brand_id
        $data['user_id'] = auth()->id(); // Captura o ID do usuário autenticado

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/shoes', 'public'); // Armazena a imagem no diretório público
            $data['image'] = $imagePath; // Adiciona o caminho da imagem ao array de dados
        }

        $shoe = Shoe::create($data);

        if (!$shoe) {
            return redirect(route('addShoe'))->with(" error", "Unable to add shoe, try again.");
        }
        return redirect(route('addShoe'))->with("success", "Shoe successfully added.");
    }

    public function displayShoes()
    {
        $shoes = Shoe::with('brand')->get();
        $cheapestShoes = Shoe::with('brand')
            ->orderBy('price', 'asc')
            ->take(20)
            ->get();
    
        $latestShoe = Shoe::orderBy('created_at', 'desc')->first(); // Obtém o tênis mais recente
    
        // Definindo $isSearch como false para a exibição padrão
        $isSearch = false;
    
        return view('shoe.home', compact('shoes', 'cheapestShoes', 'latestShoe', 'isSearch'));
    }
    
    

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Valida se o termo de busca está presente
        if (!$query) {
            return redirect()->route('home')->with('error', 'Digite um termo para buscar.');
        }
    
        // Realiza a busca nos modelos e nas marcas
        $shoes = Shoe::where('model', 'LIKE', "%{$query}%")
            ->orWhereHas('brand', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->get();
    
        // Indica que a página está em modo de busca
        $isSearch = true;
    
        return view('shoe.home', compact('shoes', 'isSearch', 'query'));
    }
    
    
    
    public function addFavorite(Request $request)
    {
        $userId = auth()->id();
        $shoeId = $request->input('shoe_id');

        // Verifica se o item já está nos favoritos
        $favorite = Favorite::where('user_id', $userId)->where('shoe_id', $shoeId)->first();

        if (!$favorite) {
            // Adiciona aos favoritos se ainda não estiver
            Favorite::create([
                'user_id' => $userId,
                'shoe_id' => $shoeId,
            ]);
            return redirect()->back()->with('success', 'Item adicionado aos favoritos.');
        } else {
            // Remove dos favoritos caso já esteja
            $favorite->delete();
            return redirect()->back()->with('success', 'Item removido dos favoritos.');
        }
    }


    public function show($id)
    {
        $shoe = Shoe::with('brand')->findOrFail($id);
    
        // Verifica se o tênis está nos favoritos do usuário autenticado
        $isFavorite = Favorite::where('user_id', auth()->id())
            ->where('shoe_id', $shoe->id)
            ->exists();
    
        return view('shoe.viewShoe', compact('shoe', 'isFavorite'));
    }
    


    public function CheapestShoeHighlight()
    {
        // Obtém o tênis com o menor preço
        $cheapestShoe = Shoe::orderBy('price', 'asc')->first();

        // Retorna a view com o tênis mais barato
        return view('shoe.highlights', compact('cheapestShoe'));
    }
}
