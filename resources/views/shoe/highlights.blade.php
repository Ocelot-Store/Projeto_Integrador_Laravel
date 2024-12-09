<!-- Tela de Destaque - Highlights -->
<div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Highlight"></button>
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Promotion"></button>
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="New Arrivals"></button>
    </div>

    <div class="carousel-inner">
        <!-- Highlight Section -->
        <div class="carousel-item active">
            <section id="highlight" class="highlight-section">
                <div class="content">
                    <h1>Destaque do dia:</h1>
                    <h2>Nike Revolution 6</h2>
                    <!-- Link estático ou variável dependendo dos requisitos -->
                    <a href="{{ route('viewShoe', 11) }}">Confira mais Informações</a> <!-- Substitua o ID com um ID válido se necessário -->
                </div>
                <div class="image-container">
                    <img src="{{ asset('storage/images/shoes/tenis11.png') }}" alt="Tênis Nike Verde" class="d-block w-100">
                </div>
            </section>
        </div>

        <!-- Promotions Section (Cheapest Shoes) -->
        <div class="carousel-item">
            <section id="promotions" class="promotion-section">
                <div class="content">
                    <h1>Promoção:</h1>
                    @if($cheapestShoes->isNotEmpty())
                        <h2>{{ $cheapestShoes->first()->model }}</h2>
                        <a href="{{ route('viewShoe', $cheapestShoes->first()->id) }}">Confira mais Informações</a>
                    @else
                        <h2>Nenhum produto disponível.</h2>
                    @endif
                </div>
                <div class="image-container">
                    @if($cheapestShoes->isNotEmpty())
                        <img src="{{ asset('storage/' . $cheapestShoes->first()->image) }}" alt="{{ $cheapestShoes->first()->model }}" class="d-block w-100">
                    @else
                        <img src="{{ asset('path/to/default/image.png') }}" alt="Imagem padrão" class="d-block w-100">
                    @endif
                </div>
            </section>
        </div>

        <!-- New Arrivals Section (Latest Shoe) -->
        <div class="carousel-item">
            <section id="new-arrivals" class="new-arrival-section">
                <div class="content">
                    <h1>Novidades:</h1>
                    @if($latestShoe)
                        <h2>{{ $latestShoe->model }}</h2>
                        <a href="{{ route('viewShoe', $latestShoe->id) }}">Confira mais Informações</a>
                    @else
                        <h2>Nenhum novo produto disponível.</h2>
                    @endif
                </div>
                <div class="image-container">
                    @if($latestShoe && $latestShoe->image)
                        <img src="{{ asset('storage/' . $latestShoe->image) }}" alt="{{ $latestShoe->model }}" class="d-block w-100">
                    @else
                        <img src="{{ asset('path/to/default/image.png') }}" alt="Imagem padrão" class="d-block w-100">
                    @endif
                </div>
            </section>
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
