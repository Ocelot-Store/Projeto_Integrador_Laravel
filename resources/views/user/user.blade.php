@extends('user.layout')

@section('title', 'Informações do Usuário')

@section('content')
    <div class="container mt-4">
        <h1>Informações do Usuário</h1>

        <ul>
            <li><strong>ID:</strong> {{ $user->id }}</li>
            <li><strong>Nome:</strong> {{ $user->name }}</li>
            <li><strong>Email:</strong> {{ $user->email }}</li>
            <li><strong>Criado em:</strong> {{ $user->created_at }}</li>
            <li><strong>Atualizado em:</strong> {{ $user->updated_at }}</li>    
        </ul>
        
        <a href="{{ route('addShoe') }}" class="btn btn-primary">Adicionar calçados</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Voltar para Home</a>
    </div>
@endsection
