<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ocelot Store</title>
    <!-- Referência ao arquivo CSS usando o helper asset() -->
    <link rel="stylesheet" href="{{ asset('css/Index.css') }}">
    <!-- Referência ao favicon -->
    <link rel="icon" href="{{ asset('assets/Ocelot.ico') }}" type="image/x-icon">
    
</head>
<body>
    <div class="overlay"></div>
    <div class="main">
        <!-- Referência à imagem usando o helper asset() -->
        <img src="{{ asset('assets/WhiteLogo.png') }}" alt="Logo">
        <h1>OCELOT</h1>
        <h2>ALWAYS FORWARD</h2>
        <p>Seu site de calçados esportivos</p>

        <div class="div-buttons">
            <!-- Links atualizados para rotas Laravel -->
            <a href="{{ route('registration') }}"><button class="Register-button">Cadastro</button></a>
            <a href="{{ url('login') }}"><button class="Login-button">Login</button></a>
        </div>
    </div>
</body>
</html>
