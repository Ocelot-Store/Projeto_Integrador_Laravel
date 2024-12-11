<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shoe;
use App\Models\Brand;
use App\Models\Favorite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'brand_id' => 'required|exists:brands,id',  // Validação para garantir que o brand_id exista
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
            return redirect(route('addShoe'))->with('error', 'Unable to add shoe, try again.');
        }
        return redirect(route('addShoe'))->with('success', 'Shoe successfully added.');
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
    
        if (!$query) {
            return redirect()->route('home')->with('error', 'Digite um termo para buscar.');
        }
    
        $shoes = Shoe::where('model', 'LIKE', "%{$query}%")
            ->orWhereHas('brand', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->get();
    
        $isSearch = true;
    
        return view('shoe.home', compact('shoes', 'isSearch', 'query'));
    }    

    public function brand()
    {
        return $this->belongsTo(Brand::class);
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
    
        // Pega a marca do tênis selecionado
        $brand = $shoe->brand->name;
    
        // Buscar tênis relacionados com o mesmo nome de marca
        $relatedShoes = Shoe::where('id', '!=', $id)
            ->whereHas('brand', function($query) use ($brand) {
                $query->where('name', $brand);
            })
            ->take(4)
            ->get();
    
        return view('shoe.viewShoe', compact('shoe', 'isFavorite', 'relatedShoes'));
    }
    
    
    

    public function CheapestShoeHighlight()
    {
        // Obtém o tênis com o menor preço
        $cheapestShoe = Shoe::orderBy('price', 'asc')->first();

        // Retorna a view com o tênis mais barato
        return view('shoe.highlights', compact('cheapestShoe'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validação dos dados recebidos
            $validatedData = $request->validate([
                'model' => 'required|string|max:100',
                'brand_id' => 'required|exists:brands,id',
                'size' => 'required|string|max:100',
                'color' => 'required|string|max:100',
                'description' => 'required|string|max:999',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'price' => 'required|numeric|min:0',
                'category' => 'nullable|string|max:100',
            ], [
                'model.required' => 'O modelo é obrigatório.',
                'brand_id.exists' => 'A marca selecionada não existe.',
                'price.numeric' => 'O preço deve ser numérico.',
                'image.image' => 'O arquivo enviado deve ser uma imagem.',
            ]);

            // Busca o tênis ou lança exceção
            $shoe = Shoe::findOrFail($id);

            // Verifica se o usuário tem permissão (opcional)
            if ($shoe->user_id !== auth()->id()) {
                return redirect()->route('user')->with('error', 'Você não tem permissão para editar este tênis.');
            }

            // Atualiza os dados
            $shoe->fill($validatedData);

            // Substitui a imagem, se necessário
            if ($request->hasFile('image')) {
                // Remove a imagem antiga, se existir
                if ($shoe->image && Storage::disk('public')->exists($shoe->image)) {
                    Storage::disk('public')->delete($shoe->image);
                }

                // Armazena a nova imagem com um nome único
                $path = $request->file('image')->storeAs(
                    'images/shoes',
                    uniqid() . '.' . $request->file('image')->getClientOriginalExtension(),
                    'public'
                );
                $shoe->image = $path;
            }

            $shoe->save();

            // Redireciona com sucesso
            return redirect()->route('user')->with('success', 'Tênis atualizado com sucesso!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Erro se o tênis não for encontrado
            return redirect()->route('user')->with('error', 'Tênis não encontrado.');
        } catch (\Exception $e) {
            // Erro genérico, inclui detalhes do erro
            Log::error('Erro ao atualizar o tênis: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Erro ao atualizar o tênis. Tente novamente. ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $shoe = Shoe::findOrFail($id);
        $brands = Brand::all(); // Fetch all brands to display in the dropdown
        return view('shoe.editShoe', compact('shoe', 'brands'));
    }
}
