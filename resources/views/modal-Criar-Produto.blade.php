<div class="modal fade" id="modalCriarProduto" tabindex="-1" role="dialog" aria-labelledby="modalCriarProdutoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCriarProdutoLabel">Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="product-image">
                    <img src="https://assets.portalleodias.com/2024/04/Davi-Brito-1.jpg" alt="Imagem do Produto" class="img-fluid">
                </div>
                <div class="product-details">
                    <h4 class="product-name">Nome do Produto</h4>
                    <p class="product-price">R$ 00,00</p>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ url('/product/individual-page') }}" class="btn btn-primary">Ver Mais</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>