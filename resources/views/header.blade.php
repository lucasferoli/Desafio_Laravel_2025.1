<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header Modal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
  <style>
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: white;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 300px;
      text-align: center;
      border-radius: 10px;
    }

    .modal-content button {
      display: block;
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      font-size: 1em;
      cursor: pointer;
    }

    .modal-content button:hover {
      background-color: #f1f1f1;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover {
      color: black;
    }
  </style>
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
              <a href="#" id="profileLink" style="color: black;">Seu Perfil</a>
            @else
              <a href="{{ route('login') }}" style="color: black;">Log in</a>
            @endauth
          </div>
        @endif
      </div>
    </nav>
  </header>

  <div id="profileModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <button id="viewProfile">Ver Perfil</button>
      <form id="logoutForm" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
      </form>
    </div>
  </div>

  <script>
    const modal = document.getElementById('profileModal');
    const profileLink = document.getElementById('profileLink');
    const closeBtn = document.querySelector('.close');

    profileLink.addEventListener('click', (e) => {
      e.preventDefault();
      modal.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });

    document.getElementById('viewProfile').addEventListener('click', () => {
      window.location.href = "/paginaDoPerfil";
    });
  </script>
</body>
</html>
