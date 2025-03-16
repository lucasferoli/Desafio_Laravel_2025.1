<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
@include('header')
<body>
    <div class="container">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->category }}</td>
                    <td>
                        <button type="button" class="btn btn-warning edit-product-btn" data-product-id="{{ $product->id }}">Editar</button>
                        <button type="button" class="btn btn-danger delete-product-btn" data-product-id="{{ $product->id }}">Deletar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach($products as $product)
    <!-- Modal de Edição -->
    <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updateProduct', ['product' => $product->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name{{ $product->id }}">Nome</label>
                            <input type="text" id="name{{ $product->id }}" name="name" value="{{ $product->name }}">
                        </div>
                        <div>
                            <label for="price{{ $product->id }}">Preço</label>
                            <input type="number" id="price{{ $product->id }}" name="price" value="{{ $product->price }}">
                        </div>
                        <div>
                            <label for="quantity{{ $product->id }}">Quantidade</label>
                            <input type="number" id="quantity{{ $product->id }}" name="quantity" value="{{ $product->quantity }}">
                        </div>
                        <div>
                            <label for="description{{ $product->id }}">Descrição</label>
                            <textarea id="description{{ $product->id }}" name="description">{{ $product->description }}</textarea>
                        </div>
                        <div>
                            <label for="category{{ $product->id }}">Categoria</label>
                            <input type="text" id="category{{ $product->id }}" name="category" value="{{ $product->category }}">
                        </div>
                        <div>
                            <label for="photo{{ $product->id }}">Foto</label>
                            <input type="text" id="photo{{ $product->id }}" name="photo" value="{{ $product->photo }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-success">Salvar alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Exclusão -->
    <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deletar Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja deletar o produto <strong>{{ $product->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('deleteProduct', ['product' => $product->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.edit-product-btn').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-product-id');
                const modal = new bootstrap.Modal(document.getElementById(`editProductModal${productId}`));
                modal.show();
            });
        });

        document.querySelectorAll('.delete-product-btn').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-product-id');
                const modal = new bootstrap.Modal(document.getElementById(`deleteProductModal${productId}`));
                modal.show();
            });
        });
    });
</script>

</body>
</html>
