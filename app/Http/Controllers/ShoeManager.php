<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shoe;
use App\Models\Brand;
use App\Models\Favorite;


class ShoeManager extends Controller
{
    function addShoe(){
        $brands = Brand::all(); // Pegando todas as brands cadastradas
        return view('shoe.addShoe', compact('brands')); // Passando as brands para a view
    }

    function addShoePost(Request $request){
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

        if(!$shoe){
            return redirect(route('addShoe'))->with("error", "Unable to add shoe, try again.");
        }
        return redirect(route('addShoe'))->with("success", "Shoe successfully added.");
    }
    
    function displayShoes(){
        $shoes = Shoe::with('brand')->get(); // Obtém todos os tênis com suas marcas associadas
        return view('shoe.home', compact('shoes')); // Retorna a view com os dados
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $shoes = Shoe::where('model', 'LIKE', "%{$query}%")
                    ->orWhereHas('brand', function ($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%");
                    })->get();
        
        return view('shoe.home', compact('shoes'));
    }

    public function addFavorite(Request $request)
    {
        $userId = auth()->id();
        $shoeId = $request->input('shoe_id');
    
        $favorite = Favorite::where('user_id', $userId)->where('shoe_id', $shoeId)->first();
    
        if (!$favorite) {
            Favorite::create([
                'user_id' => $userId,
                'shoe_id' => $shoeId,
            ]);
        } else {
            // Se já estiver nos favoritos, você pode remover aqui se desejar
            $favorite->delete();
        }
    
        return redirect()->back(); 
    }

    public function show($id)
    {
        $shoe = Shoe::with('brand')->findOrFail($id); // Obtém o tênis pelo ID
        return view('shoe.viewShoe', compact('shoe')); // Retorna a view com o tênis
    }

      
}

