<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header Modal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
</head>

<body>
  <header style="background-color: cyan; padding: 10px;">
    <nav class="nav-bar">
      <div style="display: flex; justify-content: space-between;">
        <a href="/historicoDeCompras" style="flex: 1; text-align: center; font-size: 1.5em; padding: 10px; color: black;">Histórico de Compras</a>
        <a href="/" style="flex: 1; text-align: center; font-size: 1.5em; padding: 10px; color: black;">Página de Produto</a>
        <div style="flex: 1; text-align: center; font-size: 1.5em; padding: 10px; color: black;">
          @auth
            @if(auth()->guard('web')->check())
              <a href="/paginaDeSaque" style="color: black;">Saldo: R$ {{ auth()->user()->balance }}</a>
            @elseif(auth()->guard('admin')->check())
              <a href="/painelAdm" style="color: black;">Painel Adm</a>
            @endif
          @endauth
        </div>
        @if (Route::has('login'))
          <div style="flex: 1; text-align: center; font-size: 1.5em; padding: 10px;">
            @auth
              <a href="/paginaDoPerfil" style="color: black;">Ver Perfil</a>
              <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: black; cursor: pointer;">Logout</button>
              </form>
            @else
              <a href="{{ route('login') }}" style="color: black;">Log in</a>
            @endauth
          </div>
        @endif
      </div>
    </nav>
  </header>
</body>
</html>
