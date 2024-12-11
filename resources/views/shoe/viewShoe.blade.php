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

            <!-- Novas Informações de Categoria -->
            <div class="category-info mt-4">
                <p><strong>Categoria:</strong> {{ $shoe->category }}</p>
            </div>

            <form action="{{ route('cart.add', ['shoeId' => $shoe->id]) }}" method="POST" class="d-inline">
                @csrf
                <div class="size-selection my-4">
                    <label class="form-label">Selecione o Tamanho:</label>
                    <select name="size" class="form-control" required>
                        <option value="">Selecione o Tamanho</option>
                        @foreach ($shoe->sizes as $size)
                        <option value="{{ $size->size }}">{{ $size->size }}</option>
                        @endforeach
                    </select>

                </div>

                <button type="submit" class="btn btn-primary rounded-button mb-2">
                    Adicionar ao Carrinho
                </button>
            </form>

        </div>

        <div class="col-md-4 d-flex justify-content-center">
            <div class="image-container">
                <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" class="img-fluid shoe-image">
            </div>
        </div>

        <div class="col-md-4">
            <div class="shoe-info">
                <p class="price">Preço: <strong> ${{ number_format($shoe->price, 2, ',', '.') }}</strong></p>

                <div class="seller mt-4 text-center">
                    <div class="seller-image-container">
                        <img src="{{ $shoe->user->profileImage ? asset('storage/' . $shoe->user->profileImage) : asset('assets/DarkUser.png') }}" alt="Imagem do Vendedor" class="user-image">
                    </div>
                    <span>Vendedor(a): <strong>{{ $shoe->user->name ?? 'Desconhecido(a)' }}</strong></span>
                </div>

                <div class="text-center mt-4">
                    <div class="button-group">
                        <!-- O botão de adicionar ao carrinho já está no formulário acima, então removemos o formulário duplicado abaixo -->
                        <form action="{{ route('addFavorite') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="shoe_id" value="{{ $shoe->id }}">
                            <button type="submit" class="btn btn-outline-secondary rounded-button mb-2">
                                {{ $isFavorite ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos' }}
                            </button>
                        </form>

                        <!-- resources/views/shoes/viewShoe.blade.php -->
                        <a href="{{ route('posts.index', ['shoe_id' => $shoe->id]) }}" class="btn btn-outline-secondary rounded-button">
                            Postar <img src="{{ asset('assets/post.png') }}" style="width: 20px;" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 description-container">
            <h3 class="description-title" style="font-size: 1.5rem;">Descrição</h3>
            <div class="description">
                {{ $shoe->description }}
            </div>
        </div>
    </div>

    <div class="row mt-5">
    <div class="col-12">
        <h3 class="related-title">Tênis Relacionados</h3>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            @forelse ($relatedShoes as $relatedShoe)
                <a href="{{ route('shoe.show', $relatedShoe->id) }}">
                    <div class="shoe-item">
                        <img src="{{ asset('storage/' . $relatedShoe->image) }}" alt="{{ $relatedShoe->model }}" width="200">
                        <div class="shoe-info">
                            <div class="shoe-info-name">
                                <span class="model">{{ $relatedShoe->model }}</span>
                            </div>
                            <div class="shoe-info-price">
                                <span class="price">$ {{ $relatedShoe->price }}</span>
                            </div>
                        </div>
                        <div class="shoe-info-otherinfo">
                            <span class="brand">{{ $relatedShoe->brand->name }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <p>Não há tênis relacionados disponíveis.</p>
            @endforelse
        </div>
    </div>
</div>


@endsection