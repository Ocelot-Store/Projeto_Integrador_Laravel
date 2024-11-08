@extends('user.layout')

@section('title', 'Lista de Usuários')
@section('style')
<link rel="stylesheet" href="{{ asset('css/user/users.css') }}">
@endsection

@section('content')
<div class="Main">
    <h1>Lista de Usuários</h1>

    @if(isset($seguindo) && isset($seguidores))
    <div class="profile-stats">
        <button class="stats-btn">{{ $seguindo }} Seguindo</button>
        <button class="stats-btn"> {{ $seguidores }} Seguidores</button>
    </div>
    @else
    <p>Erro: Não foi possível carregar os números de seguidores e seguidos.</p>
    @endif

    @if (isset($users) && $users->isEmpty())
    <p>Nenhum usuário encontrado.</p>
    @elseif(isset($users))
    <div class="Users">
        @foreach ($users as $user)
        @if($user->id !== Auth::id())
        <div class="Users-User">
            <img src="{{ $user->profileImage ? asset('storage/' . $user->profileImage) : asset('assets/DarkUser.png') }}"
                alt="Imagem de perfil de {{ $user->name }}"
                class="user-profile-img">


            <div class="user-info">
                <p><strong>{{ $user->name }}</strong></p>
                <p>{{ $user->email }}</p>

                @if(Auth::user()->following->contains($user->id))
                <form action="{{ route('user.unfollow', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="follow-btn unfollow">Deixar de Seguir</button>
                </form>
                @else
                <form action="{{ route('user.follow', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="follow-btn">Seguir</button>
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
<script>
    function showFollowing() {
        // Função para mostrar a lista de usuários seguidos
    }

    function showFollowers() {
        // Função para mostrar a lista de seguidores
    }

    function closeModal() {
        document.getElementById("modal").style.display = "none";
    }
</script>
@endsection