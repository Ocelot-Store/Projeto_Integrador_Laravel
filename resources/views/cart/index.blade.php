@extends('shoe.layout')
@section('title', 'Meu Carrinho')

@section('style')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
<div class="container mt-4">
    <div class="left-panel">
        <h2>Vendas:</h2>
        
        @foreach($cartItems as $item)
            <div class="product-card">
                <img src="{{ asset('storage/' . $item->shoe->image) }}" alt="{{ $item->shoe->model }}">
                <div class="product-details">
                    <p class="product-title">{{ $item->shoe->model }}</p>
                    <p class="product-price">R$ {{ number_format($item->shoe->price, 2, ',', '.') }}</p>
                    <p>Tamanho: {{ $item->size }}</p>
                    <p>Cor: 
                        @foreach($item->shoe->colors as $color)
                            <span style="background-color: {{ $color }}; width: 10px; height: 10px; display: inline-block; border-radius: 50%;"></span>
                        @endforeach
                    </p>
                </div>
                <div class="quantity-control">
                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                        <button type="submit" class="quantity-button">−</button>
                    </form>
                    <span>{{ $item->quantity }}</span>
                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                        <button type="submit" class="quantity-button">+</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="right-panel">
        <h3>Resumo do Pedido</h3>
        <p class="order-summary">Sub Total: R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
        <p class="order-summary">Frete: R$ {{ number_format($frete, 2, ',', '.') }}</p>
        <p class="order-summary">Quantidade: {{ $totalQuantity }} Unidades</p>
        <p class="order-summary">Desconto: R$ {{ number_format($discount, 2, ',', '.') }}</p>
        <p class="total-price">TOTAL: R$ {{ number_format($total, 2, ',', '.') }}</p>

        <form action="{{ route('order.submit') }}" method="POST">
            @csrf
            <button type="submit" class="submit-button">
                <i class="fas fa-shopping-cart"></i> Enviar Pedido
            </button>
        </form>
    </div>
</div>
@endsection

