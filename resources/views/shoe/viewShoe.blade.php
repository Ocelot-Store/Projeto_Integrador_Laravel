@extends('shoe.layout')
@section('title', 'Detalhes do Tênis')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/shoe/viewShoe.css') }}">
@endsection

@section('content')
<div class="container mt-5">
    <div class="row shoe-details">
        <div class="col-md-4">
            <h2 class="shoe-title" style="font-size: 2rem;">{{ $shoe->model }}</h2>
            <div class="rating">
                <span class="stars">
                    @for ($i = 0; $i < 5; $i++)
                        <i class="bi bi-star{{ $i < $shoe->rating ? '' : '-fill' }}"></i>
                        @endfor
                </span>
                <span> ({{ $shoe->reviews_count }} avaliações)</span>
            </div>

            <!-- Novas Informações de Categoria -->
            <div class="category-info mt-4">
                <p><strong>Indicado para:</strong> Caminhada</p>
                <p><strong>Material:</strong> Sintético</p>
                <p><strong>Categoria:</strong> Esporte Casual</p>
                <p><strong>Peso do Produto:</strong> 250g</p>
                <p><strong>Tecnologia:</strong> Air Max</p>
                <p><strong>Garantia do Fabricante:</strong> 3 meses</p>
            </div>

            <div class="color-selection my-3">
                <label class="form-label">Selecione a Cor:</label>
                <div class="color-options">
                    <input type="radio" id="color-black" name="color" value="black" class="color-circle-input">
                    <label for="color-black" class="color-circle" style="background-color: #000;"></label>

                    <input type="radio" id="color-white" name="color" value="white" class="color-circle-input">
                    <label for="color-white" class="color-circle" style="background-color: #fff; border: 1px solid #ccc;"></label>

                    <input type="radio" id="color-blue" name="color" value="blue" class="color-circle-input">
                    <label for="color-blue" class="color-circle" style="background-color: #007bff;"></label>

                    <input type="radio" id="color-red" name="color" value="red" class="color-circle-input">
                    <label for="color-red" class="color-circle" style="background-color: #ff0000;"></label>
                </div>
            </div>


            <div class="share-link my-3">
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="shareLink()">Compartilhar Link</button>
            </div>
        </div>

        <div class="col-md-4 d-flex justify-content-center">
            <div class="image-container">
                <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" class="img-fluid shoe-image">
            </div>
        </div>

        <div class="col-md-4">
            <div class="shoe-info">
                <p class="price">Preço: <strong>R$ {{ number_format($shoe->price, 2, ',', '.') }}</strong></p>

                <div class="size-selection my-4">
                    <label class="form-label">Selecione o Tamanho:</label>
                    <div class="size-options">
                        <span class="size-circle">36</span>
                        <span class="size-circle">37</span>
                        <span class="size-circle">38</span>
                        <span class="size-circle">39</span>
                        <span class="size-circle">40</span>
                        <span class="size-circle">41</span>
                    </div>
                </div>

                <div class="seller mt-4 text-center">
                    <div class="seller-image-container">
                        <img src="{{ $shoe->user->path ?? asset('Assets/DarkUser.png') }}" alt="Imagem do Vendedor" class="user-image">
                    </div>
                    <span>Vendedor(a): <strong>{{ $shoe->user->name ?? 'Desconhecido(a)' }}</strong></span>
                </div>

                <div class="text-center mt-4">
                    <div class="button-group">
                        <button type="button" class="btn btn-primary rounded-button mb-2" onclick="alertFunction()">Adicionar ao Carrinho</button>

                        <form action="{{ route('addFavorite') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="shoe_id" value="{{ $shoe->id }}">
                            <button type="submit" class="btn btn-outline-secondary rounded-button">
                                {{ $isFavorite ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos' }}
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 description-container">
            <h3 class="description-title" style="font-size: 1.5rem;">Descrição</h3>
            <div class="description">
                {{ Str::limit($shoe->description, 100) }}
                @if (strlen($shoe->description) > 100)
                <span id="more" style="display:none;">{{ substr($shoe->description, 100) }}</span>
                <button type="button" class="btn btn-link" onclick="toggleDescription()">Ver mais</button>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function alertFunction() {
        alert("A funcionalidade ainda não está implementada.");
    }

    function toggleDescription() {
        var moreText = document.getElementById("more");
        var btnText = document.querySelector(".btn-link");
        if (moreText.style.display === "none") {
            moreText.style.display = "inline";
            btnText.innerHTML = "Ver menos";
        } else {
            moreText.style.display = "none";
            btnText.innerHTML = "Ver mais";
        }
    }

    function shareLink() {
        alert("Link compartilhado!");
    }
</script>
@endsection