@extends('shoe.homeLayout')
@section('title', 'Visualizar Calçados')

@section('content')

<div class="container mt-4">
    <h1>Tênis Disponíveis</h1>

    <div class="shoe-container">
        @if ($shoes->isEmpty())
            <p>Nenhum tênis disponível.</p>
        @else
            @foreach ($shoes as $shoe)
                <div class="shoe-item">
                    <a href="{{ route('viewShoe', $shoe->id) }}">
                        <form method="POST" action="{{ route('favorites.add') }}">
                            @csrf
                            <input type="hidden" name="shoe_id" value="{{ $shoe->id }}">
                            <button type="submit" name="like_button">
                                @php
                                    $favorites = auth()->user()->favorites->pluck('shoe_id');
                                    $isFavorite = $favorites->contains($shoe->id);
                                    $favoriteImage = $isFavorite ? 'Favorites.png' : 'FavoriteUnchecked.png';
                                @endphp
                                <img src="{{ asset('Assets/' . $favoriteImage) }}" alt="{{ $isFavorite ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos' }}" style="width: 50px; height: 50px;">
                            </button>
                        </form>
                        <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" height="150">
                        <div class="shoe-info">
                            <div>
                                <div class="shoe-info-name">
                                    <span class="model">{{ $shoe->model }}</span><br>
                                </div>
                                <div class="shoe-info-otherinfo">
                                    <span class="brand">{{ $shoe->brand->name }}</span> • 
                                    <span class="price">R$ {{ number_format($shoe->price, 2, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</div>

@endsection
