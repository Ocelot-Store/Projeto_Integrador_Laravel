@extends('user.userLayout')

@section('title', 'Informações do Usuário')

@section('content')
<div class="main-container">

    <!-- Cabeçalho do Perfil -->
    <header class="profile-header">

        <!-- Imagem de Capa do Perfil -->
        <div class="profile-cover">
            <img src="{{ asset('assets/fundo_index.jpg') }}" alt="Imagem sobreposta" class="overlay-image">
        </div>

        <!-- Imagem do Usuário -->
        <div class="profile-picture">
            <img src="{{ asset($user->profile_image ? 'images/' . $user->profile_image : 'assets/AddImage.png') }}" alt="Imagem do Usuário" class="profile-pic">
        </div>



        <div class="action-button">
            <a href="{{ route('addShoe') }}" class="button">+ ADICIONAR CALÇADOS</a>
        </div>

        <div class="user-description" id="user-display">
            <h1><strong>{{ $user->name }}</strong></h1>
            <p>{{ $user->description }}</p>
            <button onclick="toggleEditMode()" class="edit-button">EDITAR</button>


            <!-- Formulário de Edição (oculto inicialmente) -->
            <form id="user-form" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf
                @method('PUT')

                <!-- Campo de Nome Editável -->
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>

                <!-- Campo de Descrição Editável -->
                <label for="description">Descrição:</label>
                <textarea id="description" name="description" rows="4" cols="50"></textarea>

                <!-- Campo para Imagem de Perfil -->
                <label for="profile_image">Imagem de Perfil:</label>
                <input type="file" id="profile_image" name="profile_image" accept="image/*">

                <!-- Campo para Imagem de Capa -->
                <label for="cover_image">Imagem de Capa:</label>
                <input type="file" id="cover_image" name="cover_image" accept="image/*">

                <button type="submit" class="save-button">Salvar Alterações</button>
                <button type="button" onclick="toggleEditMode()" class="cancel-button">Cancelar</button>
            </form>
        </div>

        <!-- Descrição do Usuário e Botão de Editar -->


    </header>

    <!-- Botão Voltar -->
    <div class="back-buttons">
        <a href="{{ route('home') }}" class="button-secondary">VOLTAR</a>
    </div>

    <!-- Seção de Produtos à Venda -->
    <section class="products">
        <h2>PRODUTOS A VENDA:</h2>
        @foreach ($shoes as $shoe)
        <div class="container">
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('storage/' . $shoe->image) }}" alt="Imagem tenis" class="img-fluid">
                </div>
                <div class="product-details">
                    <h2>{{ $shoe->model }} <span class="new-label">NEW</span></h2>
                    <p class="category">Nike Dunk Low</p>
                    <p class="description">{{ $shoe->description }}</p>
                    <p class="price">{{ $shoe->price }}</p>

                    <div class="color-options">
                        <span class="color" style="background-color: #ff0000;" title="Rojo"></span>
                        <span class="color" style="background-color: #0000ff;" title="Azul"></span>
                        <span class="color" style="background-color: #00ff00;" title="Verde"></span>
                    </div>

                    <div class="size-options">
                        <button class="size-btn">36</button>
                        <button class="size-btn">37</button>
                        <button class="size-btn">38</button>
                        <button class="size-btn">40</button>
                        <button class="size-btn">42</button>
                    </div>

                    <button class="buy-btn">COMPRAR</button>
                </div>
            </div>
        </div>
        @endforeach

        <script>
            function changeColor(imagePath) {
                const shoeImage = document.getElementById('shoe-image');
                shoeImage.src = imagePath;
            }
        </script>






    </section>

</div>

<!-- JavaScript para Alternar Modo de Edição e Compartilhar Perfil -->
<script>
    function toggleEditMode() {
        const form = document.getElementById('user-form');
        const display = document.getElementById('user-display');

        if (form.style.display === 'none') {
            form.style.display = 'block';
            display.style.display = 'none';
        } else {
            form.style.display = 'none';
            display.style.display = 'block';
        }
    }
</script>


@endsection