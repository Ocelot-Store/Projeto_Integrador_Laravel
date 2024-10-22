@extends('shoe.homeLayout')
@section('title', 'Visualizar Calçados')

@section('content')

<div class="container mt-4 shoe-container">
    <div class="title">
        <h1>Tênis Disponíveis.</h1>
        <h1>Infinidade ao alcance do seu dedo</h1>
    </div>

    <div class="carousel">
        <div class="carousel-items">
            @foreach($shoes as $shoe)
            <div class="shoe-item">
                <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" width="200">
                <div class="shoe-info-name">
                    <span class="model">{{ $shoe->model }}</span> <br>
                </div>
                <div class="shoe-info-otherinfo">
                    <span class="brand">{{ $shoe->brand->name }}</span>
                    •
                    <span class="price">$ {{ $shoe->price }}</span>
                </div>
                <a href="{{ route('viewShoe', $shoe->id) }}">View Details</a>
            </div>
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
            <div class="shoe-item">
                <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->model }}" width="200">
                <div class="shoe-info-name">
                    <span class="model">{{ $shoe->model }}</span> <br>
                </div>
                <div class="shoe-info-otherinfo">
                    <span class="brand">{{ $shoe->brand->name }}</span>
                    •
                    <span class="price">$ {{ $shoe->price }}</span>
                </div>
                <a href="{{ route('viewShoe', $shoe->id) }}">View Details</a>
            </div>
            @endforeach
        </div>
        <button class="prev">&lt</button>
        <button class="next">&gt</button>

    </div>
</div>

<script>
    function setupCarousel(carousel) {
        const items = carousel.querySelector('.carousel-items');
        const itemWidth = 300;
        const totalItems = items.querySelectorAll('.shoe-item').length;
        const carouselWidth = carousel.offsetWidth;
        let maxOffset = -(itemWidth * totalItems); // Ajuste no cálculo do deslocamento máximo
        let offset = 0;
        let hasMoved = false; // Flag para verificar se já foi movido para a direita

        const prevButton = carousel.querySelector('.prev');
        const nextButton = carousel.querySelector('.next');

        nextButton.addEventListener('click', () => {
            if (offset > maxOffset) { // Limita o deslocamento para não passar do final
                offset -= itemWidth * 2; // Ajuste para a quantidade de itens que você deseja mover
                items.style.transform = `translateX(${offset}px)`;
                hasMoved = true; // Atualiza a flag
                prevButton.style.opacity = 1; // Torna o botão Prev visível
            }
        });

        prevButton.addEventListener('click', () => {
            if (offset < 0) { // Limita o deslocamento para não voltar além do início
                offset += itemWidth * 2; // Ajuste para a quantidade de itens que você deseja mover
                items.style.transform = `translateX(${offset}px)`;

                if (offset >= 0) { // Verifica se voltou ao início
                    prevButton.style.opacity = 0; // Torna o botão Prev invisível
                    hasMoved = false; // Reseta a flag
                }
            }
        });

        // Inicializa o estado do botão Prev
        if (!hasMoved) {
            prevButton.style.opacity = 0; // Inicialmente invisível
        }
    }

    document.querySelectorAll('.carousel').forEach(carousel => setupCarousel(carousel));
</script>

@endsection