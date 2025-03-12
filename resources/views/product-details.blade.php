<header>@include('header')</header>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="img-fluid">
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
        <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <input type="hidden" name="product" value="{{ json_encode($product) }}">
            <div class="form-group">
                <label for="quantity">Quantidade:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{ $product->quantity }}" value="1">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Adicionar ao Carrinho</button>
        </form>
    </div>
</div>

