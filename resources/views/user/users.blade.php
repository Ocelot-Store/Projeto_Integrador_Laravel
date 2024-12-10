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

    @if(!$isSearch)
    <div class="Users">
        <!-- Lista de Todos os Usuários -->
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
                    @if(Auth::user()->following->contains($userFollowing->id))
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
            @endforeach
        </div>

        <!-- Lista de "Seguidores", que será alternada -->
        <div id="seguidores-list" class="user-list" style="display: none;">
            @foreach ($seguidoresLista as $follower)
            @if($follower->id !== Auth::id())
            <a href="{{ route('user.show', $follower->id) }}">
                <div class="Users-User">
                    <img src="{{ $follower->profileImage ? asset('storage/' . $follower->profileImage) : asset('assets/DarkUser.png') }}"
                        alt="Imagem de perfil de {{ $follower->name }}"
                        class="user-profile-img">
                    <div class="user-info">
                        <p><strong>{{ $follower->name }}</strong></p>
                    </div>

                    @if(Auth::user()->following->contains($follower->id))
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
    @else
    <div class="Users">
        <!-- Lista de Todos os Usuários -->
        <div id="todos-os-usuarios-list" class="user-list">
            @foreach ($searchedUsers as $user)
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
                    @if(Auth::user()->following->contains($userFollowing->id))
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
            @endforeach
        </div>

        <!-- Lista de "Seguidores", que será alternada -->
        <div id="seguidores-list" class="user-list" style="display: none;">
            @foreach ($seguidoresLista as $follower)
            @if($follower->id !== Auth::id())
            <a href="{{ route('user.show', $follower->id) }}">
                <div class="Users-User">
                    <img src="{{ $follower->profileImage ? asset('storage/' . $follower->profileImage) : asset('assets/DarkUser.png') }}"
                        alt="Imagem de perfil de {{ $follower->name }}"
                        class="user-profile-img">
                    <div class="user-info">
                        <p><strong>{{ $follower->name }}</strong></p>
                    </div>

                    @if(Auth::user()->following->contains($follower->id))
                    <form action="{{ route('user.unfollow', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="follow-btn unfollow">Deixar de Seguir</button>
                    </form>
                    @else
                    <form action="{{ route('user.follow', $follower->id) }}" method="POST">
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Alterna entre as abas "Seguindo", "Seguidores", e "Todos os Usuários"
        document.getElementById('seguindo-tab').addEventListener('click', function() {
            document.getElementById('seguindo-list').style.display = 'block';
            document.getElementById('seguidores-list').style.display = 'none';
            document.getElementById('todos-os-usuarios-list').style.display = 'none';
            this.classList.add('active');
            document.getElementById('seguidores-tab').classList.remove('active');
        });

        document.getElementById('seguidores-tab').addEventListener('click', function() {
            document.getElementById('seguindo-list').style.display = 'none';
            document.getElementById('seguidores-list').style.display = 'block';
            document.getElementById('todos-os-usuarios-list').style.display = 'none';
            this.classList.add('active');
            document.getElementById('seguindo-tab').classList.remove('active');
        });

        // Exibe todos os usuários inicialmente
        document.getElementById('seguindo-list').style.display = 'none';
        document.getElementById('seguidores-list').style.display = 'none';
        document.getElementById('todos-os-usuarios-list').style.display = 'block';

        // Remove a classe ativa das abas inicialmente
        document.getElementById('seguindo-tab').classList.remove('active');
        document.getElementById('seguidores-tab').classList.remove('active');
    });

    // Função para fechar o modal
    function closeModal() {
        document.getElementById("modal").style.display = "none";
    }
</script>

<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>

<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>


@endsection