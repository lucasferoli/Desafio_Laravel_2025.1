<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Histórico de Vendas</title>
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
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<header>@include('header')</header>

<body>
  <div class="container mt-4 text-center">
    <h1>Histórico de Vendas!</h1>
  </div>

  <div class="container mt-4">
    <div class="row">
      <div class="col-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Ordem ID</th>
              <th>Nome</th>
              <th>Quantia</th>
              <th>Data</th>
              <th>Preco</th>
              <th>Valor Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($movimentacoes as $movimentacao)
                @if($movimentacao->product->advertiser_id == Auth::user()->id)
                <tr>
                  <td>{{ $movimentacao->id }}</td>
                  <td>{{ $movimentacao->product->name }}</td>
                  <td>{{ $movimentacao->product_quantity }}</td>
                  <td>{{ \Carbon\Carbon::parse($movimentacao->date)->format('d/m/Y') }}</td>
                  <td>{{ $movimentacao->product->price }}</td>
                  <td>{{ $movimentacao->product_quantity * $movimentacao->product->price }}</td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <a href="{{ route('historico-vendas-pdf') }}" class="btn btn-danger">Gerar PDF</a>
  </div>
</body>
</html>