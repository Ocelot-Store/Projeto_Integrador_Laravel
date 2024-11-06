@extends('user.layout')

@section('title', 'Lista de Usuários')
@section('style')
<link rel="stylesheet" href="{{ asset('css/user/users.css') }}">
@endsection

@section('content')
<div class="Main">
    <h1>Lista de Usuários</h1>

    @if (isset($users) && $users->isEmpty())
    <p>Nenhum usuário encontrado.</p>
    @elseif(isset($users))
    <div class="Users">
        @if(isset($seguindo) && isset($seguidores))
        <div class="profile-stats">
            <!-- Botões com números reais de Seguidores e Seguindo -->
            <button class="stats-btn" onclick="showFollowing()">{{ $seguindo }} Seguindo</button>
            <button class="stats-btn" onclick="showFollowers()">{{ $seguidores }} Seguidores</button>
        </div>
        @else
        <p>Erro: Não foi possível carregar os números de seguidores e seguidos.</p>
        @endif

        @foreach ($users as $user)
        @if($user->id !== Auth::id())
        <div class="Users-User">
            <div class="user-info">
                <p><strong>Nome:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>

                @if(Auth::user()->following->contains($user->id))
                <form action="{{ route('user.unfollow', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit">Deixar de Seguir</button>
                </form>
                @else
                <form action="{{ route('user.follow', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit">Seguir</button>
                </form>
                @endif
            </div>
        </div>
        @endif
        @endforeach

    </div>
    @else
    <p>Erro: A variável de usuários não foi definida.</p>
    @endif

    <!-- Modal para exibir Seguidores ou Seguindo -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2 id="modal-title">Lista de Usuários</h2>
            <div id="modal-body">
                <!-- Lista dinâmica de usuários será inserida aqui -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection