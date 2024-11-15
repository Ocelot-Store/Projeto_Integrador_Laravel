@extends('shoe.layout')
@section('title', 'Cart')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/shoe/cart.css') }}">

@endsection

@section('content')
<div class="container mt-4">
    
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    
    @if($cartItems->isEmpty())
    <div class="empty-cart">
        <h2>Seu carrinho está vazio.</h2>
        <p>Continue navegando até encontrar algo que você goste e adicione aqui</p>
        <i class="fa-solid fa-cart-shopping"></i>
        <a href="{{ route('home') }}" class="btn-back">Voltar</a>
    </div>
    
    @else
    <h1>Meu Carrinho</h1>
        <div class="cart-item">
            @foreach($cartItems as $item)
                <div class="cart-product">
                <label class="custom-checkbox">
                <input type="checkbox" class="product-checkbox" data-price="{{ $item->shoe->price * $item->quantity }}" checked>
                <span class="checkmark"></span>
            </label>


                    <div class="product-info">
                        <img src="{{ asset('storage/' . $item->shoe->image) }}" alt="{{ $item->shoe->model }}" class="product-image">
                        <div class="details">
                            <h2>{{ $item->shoe->model }}</h2>
                            <h3>{{ \Illuminate\Support\Str::limit($item->shoe->description,100)}}</h3
                            <span>R$ {{ number_format($item->shoe->price, 2, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="quantity">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                            @csrf
                            <div class="quantity-control">
                                <button type="button" class="btn-decrement">-</button>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="quantity-input" readonly>
                                <button type="button" class="btn-increment">+</button>
                            </div>
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
                <span id="subtotal">{{ number_format($cartItems->sum(fn($item) => $item->shoe->price * $item->quantity), 2, ',', '.') }}</span>
             </div>

            <div class="shipping">
                <form action="{{ route('calcular-frete') }}" method="POST">
                    @csrf
                    <label for="cep">CEP de destino:</label>
                    <input type="text" id="cep" class="form-frete" name="cep" required>

                    <button type="submit" class="btn-frete">Calcular Frete</button>
                </form>

                @if(session('frete'))
                    <p>Valor do Frete: R$ {{ session('frete') }}</p>
                @endif
            </div>

            <div class="total">
                <strong>Total</strong>
                <strong>R$ <span id="total">{{ number_format($cartItems->sum(fn($item) => $item->shoe->price * $item->quantity), 2, ',', '.') }}</span></strong>
            </div>
            <button class="btn-pay">Enviar Pedido</button>
        </div>
    @endif
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const subtotalElement = document.getElementById('subtotal');
    const totalElement = document.getElementById('total');

    function updateTotal() {
        let subtotal = 0;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.getAttribute('data-price'));
                const quantity = parseInt(checkbox.closest('.cart-product').querySelector('.quantity-input').value);
                subtotal += price * quantity;
            }
        });
        subtotalElement.textContent = subtotal.toFixed(2).replace('.', ',');
        totalElement.textContent = subtotal.toFixed(2).replace('.', ',');
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotal);
    });

    // Botões de incremento e decremento
    document.querySelector('.btn-decrement').addEventListener('click', function() {
        const quantityInput = document.querySelector('.quantity-input');
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) { 
            quantityInput.value = currentValue - 1;
        }
    });

    document.querySelector('.btn-increment').addEventListener('click', function() {
        const quantityInput = document.querySelector('.quantity-input');
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
    });

    updateTotal();
});
</script>


@endsection
