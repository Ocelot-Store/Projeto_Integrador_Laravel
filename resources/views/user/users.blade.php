@extends('user.usersLayout')

@section('title', 'Lista de Usuários')

@section('content')
<div class="Main">
    <h1>Lista de Usuários</h1>

    @if ($users->isEmpty())
    <p>Nenhum usuário encontrado.</p>
    @else
    <div class="Users">
        @foreach ($users as $user)
        <div class="Users-User">
            <div class="Users-User-Img">
                <img src="{{ asset('assets/DarkUser.png') }}" alt="Imagem do usuário">
            </div>
            <div class="user-info">
                <p><strong>Nome:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Data de Criação:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection