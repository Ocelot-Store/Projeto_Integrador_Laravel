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
        <button id="seguindo-tab" class="stats-btn active">Seguindo ({{ $seguindo }})</button>
        <button id="seguidores-tab" class="stats-btn">Seguidores ({{ $seguidores }})</button>
    </div>
    @else
    <p>Erro: Não foi possível carregar os números de seguidores e seguidos.</p>
    @endif

    <div class="Users">
        <!-- Todos os usuários exibidos inicialmente -->
        <div id="todos-os-usuarios-list" class="user-list">
            @foreach ($users as $user)
            @if($user->id !== Auth::id())
            <a href="{{ route('user.show', $user->id) }}">
                <div class="Users-User">
                    <img src="{{ $user->profileImage ? asset('storage/' . $user->profileImage) : asset('assets/DarkUser.png') }}"
                        alt="Imagem de perfil de {{ $user->name }}"
                        class="user-profile-img">
                    <div class="user-info">
                        <p><strong>{{ $user->name }}</strong></p>
                    </div>

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
            </a>
            @endif
            @endforeach
        </div>

        <!-- Lista de "Seguindo", que será alternada -->
        <div id="seguindo-list" class="user-list" style="display: none;">
            @foreach ($seguindoLista as $userFollowing)
            <a href="{{ route('user.show', $userFollowing->id) }}">
                <div class="Users-User">
                    <img src="{{ $userFollowing->profileImage ? asset('storage/' . $userFollowing->profileImage) : asset('assets/DarkUser.png') }}"
                        alt="Imagem de perfil de {{ $userFollowing->name }}"
                        class="user-profile-img">
                    <div class="user-info">
                        <p><strong>{{ $userFollowing->name }}</strong></p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Lista de "Seguidores", que será alternada -->
        <div id="seguidores-list" class="user-list" style="display: none;">
            @foreach ($seguidoresLista as $user)
            @if($user->id !== Auth::id())
            <a href="{{ route('user.show', $user->id) }}">
                <div class="Users-User">
                    <img src="{{ $user->profileImage ? asset('storage/' . $user->profileImage) : asset('assets/DarkUser.png') }}"
                        alt="Imagem de perfil de {{ $user->name }}"
                        class="user-profile-img">
                    <div class="user-info">
                        <p><strong>{{ $user->name }}</strong></p>
                    </div>

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
            </a>
            @endif
            @endforeach
        </div>
    </div>

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
    document.addEventListener('DOMContentLoaded', function() {
    // Alterna entre as abas "Seguindo" e "Seguidores"
    document.getElementById('seguindo-tab').addEventListener('click', function() {
        // Exibe a lista de "Seguindo" e oculta a lista de "Seguidores"
        document.getElementById('seguindo-list').style.display = 'block';
        document.getElementById('seguidores-list').style.display = 'none';
        document.getElementById('todos-os-usuarios-list').style.display = 'none'; // Esconde a lista de todos os usuários
        this.classList.add('active');
        document.getElementById('seguidores-tab').classList.remove('active');
    });

    document.getElementById('seguidores-tab').addEventListener('click', function() {
        // Exibe a lista de "Seguidores" e oculta a lista de "Seguindo"
        document.getElementById('seguindo-list').style.display = 'none';
        document.getElementById('seguidores-list').style.display = 'block';
        document.getElementById('todos-os-usuarios-list').style.display = 'none'; // Esconde a lista de todos os usuários
        this.classList.add('active');
        document.getElementById('seguindo-tab').classList.remove('active');
    });

    // Inicializa a exibição da lista de "Seguindo" ao carregar a página
    document.getElementById('seguindo-list').style.display = 'block';
    document.getElementById('seguidores-list').style.display = 'none';
    document.getElementById('todos-os-usuarios-list').style.display = 'none'; // Esconde a lista de todos os usuários

    // Inicialmente, o botão "Seguindo" estará ativo
    document.getElementById('seguindo-tab').classList.add('active');
    document.getElementById('seguidores-tab').classList.remove('active');
});

// Função para fechar o modal
function closeModal() {
    document.getElementById("modal").style.display = "none";
}

</script>
@endsection
