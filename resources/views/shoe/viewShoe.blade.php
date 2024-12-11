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
            <p class="price">Preço: <strong> ${{ number_format($shoe->price, 2, ',', '.') }}</strong></p>
            <!-- Novas Informações de Categoria -->
            <div class="category-info mt-4">
                <p><strong>Categoria:</strong> {{ $shoe->category }}</p>
            </div>
            <div class="category-info mt-2">
                <p><strong>Cor:</strong> {{ $shoe->color }}</p>
            </div>




        </div>

        <div class="col-md-4 d-flex justify-content-center">
            <div class="image-container">
                <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" class="img-fluid shoe-image">
            </div>
        </div>

        <div class="col-md-4" style="display: flex;flex-direction: column;align-items: center;">
            <div class="shoe-info">


                <div class="seller text-center">
                    <div class="seller-image-container">
                        <img src="{{ $shoe->user->profileImage ? asset('storage/' . $shoe->user->profileImage) : asset('assets/DarkUser.png') }}" alt="Imagem do Vendedor" class="user-image">
                    </div>
                    <span>Vendedor(a): <strong>{{ $shoe->user->name ?? 'Desconhecido(a)' }}</strong></span>
                </div>

                <div class="text-center ">
                    <div class="button-group" style="display: flex;flex-direction: column;align-items: center;justify-content: center; margin-top:0px">
                        <form action="{{ route('cart.add', ['shoeId' => $shoe->id]) }}" method="POST" class="d-inline" style="width: 250px;">
                            @csrf
                            <div class="size-selection my-4" style="width: 250px !important; margin-bottom: 10px !important;">
                                <div class="input-group mb-3">
                                    <label for="size" class="input-group-text">Tamanho:</label>
                                    <select name="size" class="form-select" required>
                                        <option value="" disabled selected>Selecionar</option>
                                        @foreach ($shoe->sizes as $size)
                                            <option value="{{ $size->size }}">{{ $size->size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary rounded-button mb-2" style="width: 250px !important; ">
                                Adicionar ao Carrinho
                            </button>
                        </form>


                        <form action="{{ route('addFavorite') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="shoe_id" value="{{ $shoe->id }}">
                            <button type="submit" class="btn btn-outline-secondary rounded-button mb-2" style="width: 250px !important; ">
                                {{ $isFavorite ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos' }}
                            </button>
                        </form>

                        <!-- resources/views/shoes/viewShoe.blade.php -->
                        <a href="{{ route('posts.index', ['shoe_id' => $shoe->id]) }}" class="btn btn-outline-secondary rounded-button" style="width: 250px !important; ">
                            Postar <img src="{{ asset('assets/post.png') }}" style="width: 20px;" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 description-div">
        <div class="description-container">
            <h3 class="description-title" style="font-size: 1.5rem;">Descrição</h3>
            <div class="description">
                {{ $shoe->description }}
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h3 class="related-title">Tênis Relacionados:</h3>
            <div class="d-flex flex-wrap justify-content-center gap-4">
                @forelse ($relatedShoes as $relatedShoe)
                <a href="{{ route('shoe.show', $relatedShoe->id) }}">
                    <div class="shoe-item">
                        <img src="{{ asset('storage/' . $relatedShoe->image) }}" alt="{{ $relatedShoe->model }}" width="250">
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