@extends('shoe.viewShoeLayout') 
@section('title', 'Detalhes do Tênis')

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

            <div class="color-selection my-3">
                <label class="form-label">Selecione a Cor:</label>
                <div class="color-options">
                    <span class="color-circle" style="background-color: #000;"></span>
                    <span class="color-circle" style="background-color: #fff; border: 1px solid #ccc;"></span>
                    <span class="color-circle" style="background-color: #007bff;"></span>
                    <span class="color-circle" style="background-color: #ff0000;"></span>
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

                <div class="size-selection my-3">
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

                <div class="description-container">
                    <h3>Descrição</h3>
                    <div class="description">
                        {{ Str::limit($shoe->description, 100) }}
                        @if (strlen($shoe->description) > 100)
                            <span id="more" style="display:none;">{{ substr($shoe->description, 100) }}</span>
                            <button type="button" class="btn btn-link" onclick="toggleDescription()">Ver mais</button>
                        @endif
                    </div>
                </div>

                <div class="seller mt-4">
                    <span>Vendedor(a): {{ $shoe->user->name ?? 'Desconhecido(a)' }}</span>
                    <div class="seller-image-container">
                        <img src="{{ $shoe->user->path ?? asset('Assets/DarkUser.png') }}" alt="Imagem do Vendedor" class="user-image">
                    </div>
                </div>

                <div class="text-center mt-4">
                    <div class="button-group">
                        <button type="button" class="btn btn-primary rounded-button mb-2" onclick="alertFunction()">Adicionar ao Carrinho</button>
                        <button type="button" class="btn btn-outline-secondary rounded-button" onclick="alertFunction()">Adicionar aos Favoritos</button>
                    </div>
                </div>
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













