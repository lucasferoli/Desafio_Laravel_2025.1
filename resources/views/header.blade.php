<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header Modal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .azul-claro-background {
      background-color: #00aaff;
    }
  </style>
</head>

<body>
  <header class="azul-claro-background py-3">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand font-weight-bold" href="/welcome">Página de Produto</a>
        <div class="navbar-nav ml-auto">
          @auth
            @if(auth()->guard('web')->check())
              <a class="nav-item nav-link font-weight-bold" href="/paginaDeSaque">Saldo: R$ {{ auth()->user()->balance }}</a>
            @elseif(auth()->guard('admin')->check())
              <a class="nav-item nav-link font-weight-bold" href="/painelAdm">Painel Adm</a>
            @endif
          @endauth
          @if (Route::has('login'))
            @auth
              <a class="nav-item nav-link font-weight-bold" href="/paginaDoPerfil">Ver Perfil</a>
              <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="form-inline">
                @csrf
                <button type="submit" class="btn btn-danger font-weight-bold">Logout</button>
              </form>
            @else
              <a class="nav-item nav-link font-weight-bold" href="{{ route('login') }}">Log in</a>
            @endauth
          @endif
        </div>
      </div>
    </nav>
  </header>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
