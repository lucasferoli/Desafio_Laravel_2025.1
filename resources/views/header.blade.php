<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Posts</title>
  <link rel="stylesheet" href="../../../public/css/lista-posts.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lobster&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
    rel="stylesheet" />
</head>

<body>
  <header style="background-color: cyan; padding: 10px;">
    <nav class="nav-bar">
      <div style="display: flex; justify-content: space-between;">
        <a href="/historicoDeCompras" class="historicoDeCompras" style="flex: 1; text-align: center; font-size: 1.5em; padding: 10px; color: black;">Historico De Compras</a>
        <a href="/paginaDeProduto" class="paginaDeProduto" style="flex: 1; text-align: center; font-size: 1.5em; padding: 10px; color: black;">Pagina De Produto</a>
        <a href="/seuPerfil" class="seuPerfil" style="flex: 1; text-align: center; font-size: 1.5em; padding: 10px; color: black;">Seu Perfil</a>
        <div class="saldo" style="flex: 1; text-align: center; font-size: 1.5em; padding: 10px; color: black;">
          <span>Saldo: R$ 1000,00</span>
        </div>
        @if (Route::has('login'))
          <div style="flex: 1; text-align: center; font-size: 1.5em; padding: 10px;">
            @auth
              <a href="{{ url('/dashboard') }}" style="color: black;">Dashboard</a>
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
