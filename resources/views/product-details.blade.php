<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>@include('header')</header>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('build/assets/Davi-Brito.jpg') }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <p class="price"><strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                <p><strong>Quantidade Disponível:</strong> {{ $product->quantity}}</p>
                <p><strong>Descrição:</strong> {{ $product->description }}</p>
                <p><strong>Categoria:</strong> {{ $product->category }}</p>
                <p><strong>Anunciante:</strong> {{ $product->advertiser->name }}</p>
                <p><strong>Telefone do Anunciante:</strong> {{ $product->advertiser->telephone }}</p>
                <p><strong>Data de Criação:</strong> {{ $product->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <form action="/checkout" method="POST">
                @csrf
                <input type="hidden" name="produto_id" value="{{ $product->id }}">
                <input type="number" name="quantidade_produto" id="quantity" class="form-control" min="1" max="{{ $product->quantity }}" value="1">
                <button type="submit" class="btn btn-primary mt-3">Comprar</button>
            </form>
        </div>
    </div>

</body>
</html>
