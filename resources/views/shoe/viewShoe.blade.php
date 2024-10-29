@extends('shoe.viewShoeLayout') 
@section('title', 'Detalhes do Tênis')

@section('content')
<div class="shoe-details">
    <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}">
    <div class="shoe-info">
        <p>Modelo do Tênis: {{ $shoe->model }}</p>
        <p>Marca: {{ $shoe->brand->name }}</p>
        <p>Preço: R$ {{ number_format($shoe->price, 2, ',', '.') }}</p>
        
        <div class="seller">
            Vendedor(a): {{ $shoe->user->name ?? 'Desconhecido(a)' }}
            <div class="seller-image-container">
                <img src="{{ $shoe->user->path ?? asset('Assets/DarkUser.png') }}" alt="Imagem do Vendedor" class="user-image">
            </div>
        </div>
        
        <form method="post" {{-- action="{{ route('cart.add', $shoe->id) }}" --}}>
            <!-- Remover as {{-- --}} -->

            @csrf
            <button type="submit" class="add-to-cart" onclick="alertFunction()">Adicionar ao Carrinho</button>
        </form>
    </div>
</div>
<div class="description-container">
    <div class="description">
        {{ $shoe->description }}
    </div>
</div>
<script>
    function alertFunction() {
        alert("Tênis adicionado ao banco de dados");
    }
</script>
@endsection
