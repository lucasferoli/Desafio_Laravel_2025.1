@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
            <p>{{ $product->description }}</p>
        </div>
    </div>
</div>
@endsection