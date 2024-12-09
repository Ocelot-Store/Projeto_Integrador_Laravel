@extends('shoe.layout')
@section('title', $isSearch ? 'Resultados da Busca' : 'Visualizar Calçados')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/shoe/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shoe/highlights.css') }}">
@endsection

@section('content')

@if(session('error'))
    <div class="alert alert-warning">{{ session('error') }}</div>
@endif

@if($isSearch)
    <!-- Conteúdo para exibir apenas os resultados da busca -->
    <div class="container mt-4 shoe-container">
        <div class="title">
            <h1>Resultados da Busca para "{{ $query }}"</h1>
        </div>

        @if($shoes->isEmpty())
            <p>Nenhum resultado encontrado para a busca.</p>
        @else
            <div class="row">
                @foreach($shoes as $shoe)
                    <div class="col-md-4">
                        <a href="{{ route('viewShoe', $shoe->id) }}">
                            <div class="shoe-item">
                                <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" width="200">
                                <div class="shoe-info-name">
                                    <span class="model">{{ \Illuminate\Support\Str::limit($shoe->model, 20) }}</span> <br>
                                </div>
                                <div class="shoe-info-otherinfo">
                                    <span class="brand">{{ $shoe->brand->name }}</span>
                                    •
                                    <span class="price">$ {{ $shoe->price }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@else
    <!-- Conteúdo padrão da página inicial -->
    @include('shoe.highlights', ['cheapestShoes' => $cheapestShoes, 'latestShoe' => $latestShoe])

    <div class="container mt-4 shoe-container">
        <div class="title">
            <h1>Tênis Disponíveis.</h1>
            <h1>Infinidade ao alcance do seu dedo</h1>
        </div>

        <div class="carousel">
            <div class="carousel-items">
                @foreach($shoes as $shoe)
                <a href="{{ route('viewShoe', $shoe->id) }}">
                    <div class="shoe-item">
                        <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" width="200">
                        <div class="shoe-info-name">
                            <span class="model">{{ \Illuminate\Support\Str::limit($shoe->model, 20) }}</span> <br>
                        </div>
                        <div class="shoe-info-otherinfo">
                            <span class="brand">{{ $shoe->brand->name }}</span>
                            •
                            <span class="price">$ {{ $shoe->price }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            <button class="prev">&lt</button>
            <button class="next">&gt</button>
        </div>
    </div>

    <div class="container mt-4 shoe-container">
        <div class="title">
            <h1>Melhores Preços.</h1>
            <h1>Solução em conta pra você</h1>
        </div>

        <div class="carousel">
            <div class="carousel-items">
                @foreach($cheapestShoes as $shoe)
                <a href="{{ route('viewShoe', $shoe->id) }}">
                    <div class="shoe-item">
                        <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" width="200">
                        <div class="shoe-info-name">
                            <span class="model">{{ \Illuminate\Support\Str::limit($shoe->model, 20) }}</span> <br>
                        </div>
                        <div class="shoe-info-otherinfo">
                            <span class="brand">{{ $shoe->brand->name }}</span>
                            •
                            <span class="price">$ {{ $shoe->price }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            <button class="prev">&lt</button>
            <button class="next">&gt</button>
        </div>
    </div>
@endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function setupCarousel(carousel) {
                const items = carousel.querySelector('.carousel-items');
                if (!items) return; // Verifica se o elemento existe

                const totalItems = items.querySelectorAll('.shoe-item').length;
                if (totalItems === 0) return; // Verifica se há itens

                const itemWidth = 320; // Ajuste de acordo com a largura total do item
                const maxOffset = -(itemWidth * (totalItems - 1));
                let offset = 0;

                const prevButton = carousel.querySelector('.prev');
                const nextButton = carousel.querySelector('.next');

                nextButton.addEventListener('click', () => {
                    if (offset > maxOffset) {
                        offset -= itemWidth;
                        items.style.transform = `translateX(${offset}px)`;
                        prevButton.style.opacity = 1; // Exibe o botão Prev
                    }
                    if (offset <= maxOffset) {
                        nextButton.style.opacity = 0; // Esconde o botão Next
                    }
                });

                prevButton.addEventListener('click', () => {
                    if (offset < 0) {
                        offset += itemWidth;
                        items.style.transform = `translateX(${offset}px)`;
                        nextButton.style.opacity = 1; // Exibe o botão Next
                    }
                    if (offset >= 0) {
                        prevButton.style.opacity = 0; // Esconde o botão Prev
                    }
                });

                // Inicializa a opacidade dos botões
                prevButton.style.opacity = 0; // Inicialmente invisível
            }

            const carousels = document.querySelectorAll('.carousel');
            if (carousels.length === 0) {
                console.warn('Nenhum carrossel encontrado.'); // Log opcional para debugging
            } else {
                carousels.forEach(carousel => setupCarousel(carousel));
            }
        });
    </script>
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>

<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>

@include('shoe.footer')
@endsection

