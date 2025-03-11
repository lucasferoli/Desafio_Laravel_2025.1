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
  <link rel="icon" href="../../../public/assets/favicon-logo-sem-nome.png" type="image/png">
</head>
<header>@include('header')</header>
<body>
<h1>Saque</h1>

<p>Saldo: R$ {{ Auth::user()->balance }}</p>

<div id="modalCriar">
  <form method="POST" action="/sacar" enctype="multipart/form-data">
      @csrf
      <div>
          <label for="amount">Valor do Saque:</label>
          <input type="number" id="amount" name="amount" max="{{ Auth::user()->balance }}" required>
      </div>
      <button type="submit">Sacar Agora</button>
  </form>
</div>

</body>
</html>

