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
                <a href="{{ route('user.show', $user->id) }}">
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
                </a>
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
    const seguindoLista = @json($seguindoLista ?? []);
    const seguidoresLista = @json($seguidoresLista ?? []);

    function showFollowing() {
        document.getElementById("modal-title").innerText = "Usuários Seguindo";
        document.getElementById("modal-body").innerHTML = formatUserList(seguindoLista);
        document.getElementById("modal").style.display = "block";
    }

    function showFollowers() {
        document.getElementById("modal-title").innerText = "Seus Seguidores";
        document.getElementById("modal-body").innerHTML = formatUserList(seguidoresLista);
        document.getElementById("modal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("modal").style.display = "none";
    }

    // Função para formatar a lista de usuários em HTML
    function formatUserList(users) {
        if (users.length === 0) {
            return "<p>Não há usuários para exibir.</p>";
        }
        return users.map(user => `
            <div class="user-item">
                <p><strong>Nome:</strong> ${user.name}</p>
                <p><strong>Email:</strong> ${user.email}</p>
            </div>
        `).join('');
    }

    // Fechar o modal ao clicar fora dele
    window.onclick = function(event) {
        const modal = document.getElementById("modal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
@endsection



