<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Histórico de Compras</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
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
              @if($movimentacao->buyer_id == Auth::user()->id)
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
  </div>
</body>
</html>
