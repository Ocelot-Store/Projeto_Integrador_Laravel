<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('index') }}"><img src="{{asset('assets/BlackLogo.png')}}" alt="" style="width: 45px; height: 45px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users') }}">Users</a>
        </li>

      </ul>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item mb-2">
          <form class="d-flex"   role="search" action="{{ route('search') }}" method="GET">
            <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" style="border-color: black; color: black; transition: all 0.2s ease-in-out;" onmouseover="this.style.backgroundColor='white'" onmouseout="this.style.backgroundColor='transparent'">Search</button>
          </form>
        </li>
        
        <li class="nav-item ms-1"> 
          <a href="{{ route('user') }}">
            <img src="{{ asset('assets/DarkUser.png') }}" alt="Usuário" class="img-fluid" style="width: 40px; height: 40px;">
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>
      </ul>



      
    </div>
  </div>
</nav>