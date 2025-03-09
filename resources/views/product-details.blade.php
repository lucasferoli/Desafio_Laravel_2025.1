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
            <p><strong>Data de Criação:</strong> {{ $product->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>
</div>