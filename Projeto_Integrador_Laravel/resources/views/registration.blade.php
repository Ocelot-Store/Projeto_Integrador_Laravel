<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="{{ asset('assets/css/registration.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
    <link rel="icon" href="{{ asset('assets/images/Ocelot.ico') }}" type="image/x-icon">
</head>
<body>
<div class="overlay"></div>
    <a href="{{ url('/') }}"><img class="homeImg" src="{{ asset('assets/images/Home.png') }}" alt="Home"></a>
    <div class="main">
        <div class="window">
            <div class="containerh1">
                <img src="{{ asset('assets/images/BlackLogo.png') }}" alt="Logo">
                <h1>OCELOT</h1>
            </div>
            <h2>ALWAYS FORWARD</h2>
            
            <div class="form-container">
                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf
                    <div class="input-box">
                        <img src="{{ asset('assets/images/DarkUser.png') }}" alt="User">
                        <input type="text" id="name" name="name" placeholder="Nome de Usuário" value="{{ old('name') }}">
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-box">
                        <img src="{{ asset('assets/images/Address.png') }}" alt="Address">
                        <input type="text" id="address" name="address" placeholder="Endereço" value="{{ old('address') }}">
                        @error('address')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-box">
                        <img src="{{ asset('assets/images/Email.png') }}" alt="Email">
                        <input type="text" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-box">
                        <img src="{{ asset('assets/images/Password.png') }}" alt="Password">
                        <input type="password" id="password" name="password" placeholder="Senha">
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-box">
                        <img src="{{ asset('assets/images/Password.png') }}" alt="Confirm Password">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Senha">
                    </div>
                    <div class="divsubmit">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
