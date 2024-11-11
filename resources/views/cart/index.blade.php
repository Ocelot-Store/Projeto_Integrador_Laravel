@extends('shoe.layout')
@section('title', 'Cart')

@section('style')
<link rel="stylesheet" href="{{ asset('css/shoe/cart.css') }}">
@endsection

@section('content')
<div class="container mt-4">
    <h1>Meu Carrinho</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cartItems->isEmpty())
        <p>Seu carrinho está vazio.</p>
    @else
        <div class="cart-item">
            @foreach($cartItems as $item)
                <div class="cart-product">
                    <div class="product-info">
                        <img src="{{ asset('storage/' . $item->shoe->image) }}" alt="{{ $item->shoe->model }}" class="product-image">
                        <div class="details">
                            <h2>{{ $item->shoe->model }}</h2>
                            <span>R$ {{ number_format($item->shoe->price, 2, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="quantity">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="quantity-input">
                            <button type="submit" class="btn-update">Atualizar</button>
                        </form>
                    </div>
                    <div class="price">
                        <span>R$ {{ number_format($item->shoe->price * $item->quantity, 2, ',', '.') }}</span>
                    </div>
                    <div class="actions">
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-remove">Remover</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="cart-summary">
            <div class="subtotal">
                <span>Subtotal</span>
                <span>R$ {{ number_format($cartItems->sum(fn($item) => $item->shoe->price * $item->quantity), 2, ',', '.') }}</span>
            </div>

            <div class="shipping">
                <form action="{{ route('calcular-frete') }}" method="POST">
                    @csrf
                    <label for="cep">Insira o CEP de destino:</label>
                    <input type="text" id="cep" class="form-frete" name="cep" required>

                    <button type="submit" class="btn-frete">Calcular Frete</button>
                </form>

                @if(session('frete'))
                    <p>Valor do Frete: R$ {{ session('frete') }}</p>
                @endif
            </div>

            <div class="total">
                <strong>Total</strong>
                <strong>R$ {{ number_format($cartItems->sum(fn($item) => $item->shoe->price * $item->quantity), 2, ',', '.') }}</strong>
            </div>
            <button class="btn-pay">Enviar Pedido</button>
        </div>
    @endif
</div>
@endsection
