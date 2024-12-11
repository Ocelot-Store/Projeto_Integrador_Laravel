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
        <a href="{{ route('home') }}" style="background-color: #3924a3;" class="btn-back">Voltar</a>
    </div>
    
    @else
    <h2>Meu Carrinho</h2>
    <div class="cart-container">
        
        <div class="cart-item">
            @foreach($cartItems as $item)
                <div class="cart-product">

                    <div class="product-info">
                        <img src="{{ asset('storage/' . $item->shoe->image) }}" alt="{{ $item->shoe->model }}" class="product-image">
                        <div class="details">
                            <h2>{{ $item->shoe->model }}</h2>
                            <h3>{{ \Illuminate\Support\Str::limit($item->shoe->description, 50) }}</h3>
                            <span>R$ {{ number_format($item->shoe->price, 2, ',', '.') }}</span>
                            <!-- Exibe o tamanho do tênis aqui -->
                            <p><strong>Tamanho:</strong> {{ $item->size }}</p> <!-- Considerando que o tamanho é um atributo do item -->
                        </div>
                    </div>
                    <div class="quantity">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="update-quantity-form">
                            @csrf
                            <div class="quantity-control">
                                <button type="button" class="btn-decrement" data-id="{{ $item->id }}">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="quantity-input" readonly>
                                <button type="button" class="btn-increment" data-id="{{ $item->id }}">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="price">
                        <span class="item-price">R$ {{ number_format($item->shoe->price * $item->quantity, 2, ',', '.') }}</span>
                    </div>
                    <div class="actions">
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-remove">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="cart-summary">
            <h5>Resumo da compra</h5>
            <div class="subtotal">
                <span>Subtotal</span>
                <span id="subtotal">{{ number_format(session('subtotal', 0), 2, ',', '.') }}</span>
            </div>

            @if($errors->has('coupon_code'))
                <div class="alert alert-danger">
                    {{ $errors->first('coupon_code') }}
                </div>
            @endif

            <div class="descontos">
                <form action="{{ route('cart.applyCoupon') }}" method="POST">
                    @csrf
                    <span>Cupom de Desconto</span>
                    <button class="btn-apply" id="apply-coupon-btn">Adicionar</button>
                    <div id="coupon-form" style="display: none; margin-top: 20px;">
                        <input type="text" name="coupon_code" id="coupon_code" required class="input-coupon">
                        <button class="btn-add-descount" type="submit">Aplicar</button>
                    </div>
                </form>
            </div>

            @if(session('coupon_applied') && session('discount') > 0)
                <p>Desconto: R$ {{ number_format(session('discount'), 2, ',', '.') }}</p>
            @endif

            <div class="total">
                <strong>Total</strong>
                <strong>R$ <span id="total">{{ number_format(session('total', session('subtotal', 0)), 2, ',', '.') }}</span></strong>
            </div>

            <div class="btns">
                <a href="{{ route('cart.ordered') }}" class="btn-pay">Enviar Pedido</a>
                <a href="{{ route('home') }}" class="btn-home">Escolher mais produtos</a>
            </div>

        </div>

    @endif
</div>

<script>
const decrementButtons = document.querySelectorAll('.btn-decrement');
const incrementButtons = document.querySelectorAll('.btn-increment');

decrementButtons.forEach(button => {
    button.addEventListener('click', function () {
        const quantityInput = this.closest('.quantity-control').querySelector('.quantity-input');
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
            updateTotal(); // Atualiza o total após a alteração
        }
    });
});

incrementButtons.forEach(button => {
    button.addEventListener('click', function () {
        const quantityInput = this.closest('.quantity-control').querySelector('.quantity-input');
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
        updateTotal(); // Atualiza o total após a alteração
    });
});

// Função para atualizar o subtotal e o total na interface
function updateTotal() {
    // Recupere o subtotal (soma dos valores dos produtos)
    let subtotal = 0;
    const itemPrices = document.querySelectorAll('.item-price');
    const quantityInputs = document.querySelectorAll('.quantity-input');
    
    itemPrices.forEach((item, index) => {
        const price = parseFloat(item.textContent.replace('R$', '').replace(',', '.'));
        const quantity = parseInt(quantityInputs[index].value);
        subtotal += price * quantity;
    });

    // Atualiza o subtotal na página
    document.getElementById('subtotal').textContent = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;

    // Atualiza o total (considerando o desconto, se houver)
    let discount = parseFloat('{{ session("discount", 0) }}');
    let total = subtotal - discount;

    document.getElementById('total').textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
}

// Chama a função de atualização do total ao carregar a página
updateTotal();

    document.getElementById('apply-coupon-btn').addEventListener('click', function() {
        event.preventDefault();
        var couponForm = document.getElementById('coupon-form');
        
        
        if (couponForm.style.display === 'none' || couponForm.style.display === '') {
            couponForm.style.display = 'block'; 
        } else {
            couponForm.style.display = 'none'; 
        }
    });
</script>
@endsection
