<div class="modal-body bg-yellow-500 border border-black">
    <div class="product-image">

        <img src="{{ asset('build/assets/Davi-Brito.jpg') }}" alt="Product Image" class="img-fluid">
    </div>
    <div class="product-details">

        <h4 class="product-name">{{ $randomProduct->name }}</h4>

        <p class="product-price">R$ {{ number_format($randomProduct->price, 2, ',', '.') }}</p>
    </div>
</div>
<div class="modal-footer">

    <a href="{{ route('product.details', $randomProduct->id) }}" class="btn btn-primary">Ver Mais</a>
</div>