<div class="modal-body bg-gradient-to-br from-yellow-400 to-yellow-200 border border-black rounded-t-lg p-6 flex flex-col items-center">
    <div class="product-image mb-4">
        <img src="{{ asset('images/products/fonte.jpg') }}" alt="Product Image" class="rounded-lg shadow-lg w-40 h-40 object-cover border-2 border-yellow-600">
    </div>
    <div class="product-details text-center">
        <h4 class="product-name text-2xl font-bold text-gray-800 mb-2">{{ $randomProduct->name }}</h4>
        <p class="product-price text-xl text-yellow-700 font-semibold mb-2">R$ {{ number_format($randomProduct->price, 2, ',', '.') }}</p>
    </div>
</div>
<div class="modal-footer bg-yellow-100 rounded-b-lg flex justify-center items-center p-4">
    <a href="{{ route('product.details', $randomProduct->id) }}" class="btn btn-primary bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded shadow transition duration-200 mx-auto block text-center">Ver Produto</a>
</div>
