<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoe;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Brand; // Importar o modelo Brand

class ShoeController extends Controller
{
    /**
     * Exibe o formulário de edição de um tênis.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    try {
        // Busca o tênis pelo ID
        $shoe = Shoe::findOrFail($id);

        // Carrega todas as marcas
        $brands = Brand::all();

        // Retorna a view de edição com os dados do tênis e as marcas
        return view('shoe.edit', compact('shoe', 'brands'));
    } catch (\Exception $e) {
        return redirect()->route('viewShoes')->with('error', 'Tênis não encontrado.');
    }
} 

    /**
     * Atualiza os dados de um tênis no banco de dados.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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

            // Atualiza os dados
            $shoe->fill($validatedData);

            // Substitui a imagem, se necessária
            if ($request->hasFile('image')) {
                // Remove a imagem antiga, se existir
                if ($shoe->image && Storage::disk('public')->exists($shoe->image)) {
                    Storage::disk('public')->delete($shoe->image);
                }

                // Armazena a nova imagem
                $path = $request->file('image')->store('images/shoes', 'public');
                $shoe->image = $path;
            }

            $shoe->save();

            return redirect()->route('viewShoes')->with('success', 'Tênis atualizado com sucesso!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('viewShoes')->with('error', 'Tênis não encontrado.');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar o tênis: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Erro ao atualizar o tênis. Tente novamente.');
        }
    }
}
