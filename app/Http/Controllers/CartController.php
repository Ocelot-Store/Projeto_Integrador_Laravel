<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Shoe;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('shoe')
            ->where('user_id', Auth::id())
            ->get();

        // Calcular o subtotal (soma do preço de todos os itens)
        $cartTotal = $cartItems->sum(function ($item) {
            return $item->shoe->price * $item->quantity;
        });

        // Armazenar o subtotal na sessão para uso posterior
        session()->put('subtotal', $cartTotal);

        return view('cart.index', compact('cartItems', 'cartTotal'));
    }

    public function addToCart(Request $request, $shoeId)
    {
        $shoe = Shoe::findOrFail($shoeId);

        // Validar o tamanho com base nos tamanhos disponíveis para o sapato
        $validated = $request->validate([
            'size' => 'required|in:' . implode(',', $shoe->sizes->pluck('size')->toArray())
        ]);

        $size = $request->input('size'); // Captura o tamanho

        // Verifique se o tamanho é válido
        if (empty($size)) {
            return redirect()->back()->withErrors(['size' => 'Tamanho é obrigatório.']);
        }

        // Verificar se o item já existe no carrinho
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('shoe_id', $shoeId)
            ->first();

        if ($cartItem) {
            // Se o item já existe, apenas aumente a quantidade
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            // Caso contrário, crie um novo item no carrinho
            Cart::create([
                'user_id' => Auth::id(),
                'shoe_id' => $shoeId,
                'quantity' => $request->input('quantity', 1),
                'size' => $size,  // Passando o tamanho corretamente
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



    public function applyCoupon(Request $request)
    {
        // Remover qualquer valor de desconto da sessão
        session()->forget(['discount', 'coupon_applied']);

        $couponCode = $request->input('coupon_code');
        $coupon = Coupon::where('code', $couponCode)->first();

        // Se o cupom não for válido ou expirado, ou mesmo se for válido, removemos qualquer desconto da sessão
        if (!$coupon || !$coupon->isValid()) {
            // Redireciona de volta com erro, sem aplicar nada
            return redirect()->back()->withErrors(['coupon_code' => 'Cupom inválido ou expirado!']);
        }

        $subtotal = session('subtotal', 0);

        if ($subtotal <= 0) {
            return redirect()->back()->withErrors(['coupon_code' => 'Subtotal inválido.']);
        }

        // Calculando o desconto
        $discount = ($subtotal * $coupon->discount) / 100;
        $total = $subtotal - $discount;

        // Salvando as informações de desconto na sessão, quando o cupom for válido
        session([
            'discount' => $discount,
            'total' => $total,
            'subtotal' => $subtotal,
            'coupon_applied' => true, // Definir que um cupom foi aplicado com sucesso
        ]);

        return redirect()->back()->with('message', 'Cupom aplicado com sucesso!');
    }

    public function confirmacao()
    {
        return view('pedido.confirmacao');
    }
}
