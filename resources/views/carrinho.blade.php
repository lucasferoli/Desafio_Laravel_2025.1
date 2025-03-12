<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Carrinho</title>
  <link rel="stylesheet" href="{{ asset('css/lista-posts.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lobster&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
    rel="stylesheet" />
  <link rel="icon" href="{{ asset('assets/favicon-logo-sem-nome.png') }}" type="image/png">
</head>
<header>@include('header')</header>
<body>
  <div class="container">
    <h1>Meu Carrinho</h1>
    <table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Preço</th>
          <th>Total</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cartItems as $item)
        <tr>
          <td>{{ $item->name }}</td>
          <td>{{ $item->quantity }}</td>
          <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
          <td>R$ {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
          <td>
            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit">Remover</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="total">
      <h3>Total: R$ {{ number_format($total, 2, ',', '.') }}</h3>
    </div>
    <div class="actions">
      <a href="{{ route('checkout') }}" class="btn">Finalizar Compra</a>
    </div>
  </div>
</body>
</html>
