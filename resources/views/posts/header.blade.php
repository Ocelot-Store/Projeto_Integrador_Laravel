<nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 0;">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('index') }}"><img src="{{asset('assets/BlackLogo.png')}}" alt="" style="width: 45px; height: 45px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users') }}">Usuários</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('posts.index') }}">Comunidade</a>
        </li>

      </ul>

      <ul class="navbar-nav ms-auto" style="display: flex; margin-bottom: 0;">
        <li style="margin-bottom: 0;">
        </li>
        <li class="ms-1" style="margin-bottom: 0;">
          <a href="{{ route('user') }}">
            <img src="{{ Auth::user()->profileImage ? asset('storage/' . Auth::user()->profileImage) : asset('assets/DarkUser.png') }}" alt="Usu rio" class="img-fluid" style="width: 40px; height: 40px; margin-bottom: 0; border-radius: 50%; object-fit: cover;">
          </a>
        </li>
        <li style="margin-bottom: 0;">
          <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>
      </ul>

    </div>
  </div>
</nav>