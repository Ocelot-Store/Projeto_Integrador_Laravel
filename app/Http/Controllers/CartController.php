<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Shoe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function index() {
        $cartItems = Cart::with('shoe')->get();
        $cartTotal = $cartItems->sum(function($item) {
            return $item->shoe->price * $item->quantity;
        });
        return view('cart.index', compact('cartItems', 'cartTotal'));
    }
    
    public function addToCart(Request $request, $shoeId)
    {
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('shoe_id', $shoeId)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
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

    public function calcularFrete(Request $request)
    {
        $cepOrigem = '18013-280'; // CEP de origem fixo
        $cepDestino = $request->input('cep');
        $peso = $request->input('peso');

        // API fictícia para calcular o frete
        $tarifaBase = 10.00; // Valor fixo em reais
    
        return redirect()->back()->with('frete', $tarifaBase);
    }

}
