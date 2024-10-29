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
                    <h2> Dunk Low - Verde</h2>
                </div>
                <a href="{{ route('viewShoe', ['id' => 1]) }}" class="sneaker-link"></a>
                <div class="image-container">
                    <img src="{{ asset('storage/images/shoes/tenis8.png') }}" alt="Tênis Nike Verde" class="d-block w-100">
                </div>
            </section>
        </div>
        
        <!-- Promotions Section -->
        <div class="carousel-item">
            <section id="promotions" class="promotion-section">
                <div class="content">
                    <h1>Promoção:</h1>
                    <h2>All Strar - Preto</h2>
                </div>
                <a href="{{ route('viewShoe', ['id' => 2]) }}" class="sneaker-link"></a>
                <div class="image-container">
                    <img src="{{ asset('storage/images/shoes/tenis6.png') }}" alt="Tênis Air Max Preto" class="d-block w-100">
                </div>
            </section>
        </div>
        
        <!-- New Arrivals Section -->
        <div class="carousel-item">
            <section id="new-arrivals" class="new-arrival-section">
                <div class="content">
                    <h1>Novidades:</h1>
                    <h2>Chuteira Mizuno</h2>
                </div>
                <a href="{{ route('viewShoe', ['id' => 3]) }}" class="sneaker-link"></a>
                <div class="image-container">
                    <img src="{{ asset('storage/images/shoes/tenis1.png') }}" alt="Tênis Jordan Branco" class="d-block w-100">
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
<script>
    var carousel = new bootstrap.Carousel(document.getElementById('carouselIndicators'), {
        interval: 5000, // 5 segundos
        ride: 'carousel' // Inicia o carrossel automaticamente
    });
</script>

