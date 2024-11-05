<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Shoe;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Obtém o carrinho do usuário autenticado com os detalhes do tênis
        $cartItems = Cart::with('shoe')->where('user_id', Auth::id())->get();
        
        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request, $shoeId)
    {
        // Verifica se o item já está no carrinho
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('shoe_id', $shoeId)
                        ->first();

        if ($cartItem) {
            // Se o item já estiver no carrinho, incrementa a quantidade
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            // Caso contrário, adiciona um novo item ao carrinho
            Cart::create([
                'user_id' => Auth::id(),
                'shoe_id' => $shoeId,
                'quantity' => $request->input('quantity', 1)
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item adicionado ao carrinho.');
    }

    public function updateCart(Request $request, $cartId)
    {
        $cartItem = Cart::findOrFail($cartId);

        $cartItem->update(['quantity' => $request->input('quantity', 1)]);

        return redirect()->route('cart.index')->with('success', 'Carrinho atualizado.');
    }

    public function removeFromCart($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removido do carrinho.');
    }
}
