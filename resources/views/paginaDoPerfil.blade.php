<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Perfil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lobster&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
    rel="stylesheet" />
  <link rel="icon" href="{{ asset('assets/favicon-logo-sem-nome.png') }}" type="image/png">
</head>

<body>
  <div class="container">
    <header>@include('header')</header>
    <h1>Seu Perfil</h1>

    <div class="row">
      <div class="col-md-4 mb-3">
      <button type="button" class="btn btn-success w-100 criar-anuncio-btn" data-bs-toggle="modal" data-bs-target="#criarProdutoModal">Criar Anúncio</button>
      </div>
      <div class="col-md-4 mb-3">
      <a href="/editarProdutos" class="btn btn-primary w-100">Ver Seus Anúncios</a>
      </div>
      <div class="col-md-4 mb-3">
      <a href="/historico-compras" class="btn btn-info w-100">Histórico de Compras</a>
      </div>
      <div class="col-md-4 mb-3">
      <a href="/historico-vendas" class="btn btn-secondary w-100">Histórico de Vendas</a>
      </div>
      <div class="col-md-4 mb-3">
      <button type="button" class="btn btn-warning edit-user-btn w-100" data-bs-toggle="modal" data-bs-target="#editUserModal">Editar seu Perfil</button>
      </div>
      <div class="col-md-4 mb-3">
      <button type="button" class="btn btn-danger delete-user-btn w-100" data-bs-toggle="modal" data-bs-target="#deleteUserModal">Deletar seu Perfil</button>
      </div>
    </div>

    {{-- atualizar perfil --}}
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editUserModalLabel">Editar Perfil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('usuarioUpdate', auth()->user()->id) }}">
              @csrf
              @method('PATCH')

              <!-- Nome -->
              <div class="form-group">
                <label for="name">Nome</label>
                <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required autofocus />
              </div>

              <!-- Nova Senha -->
              <div class="form-group">
                <label for="password">Nova Senha</label>
                <input id="password" name="password" type="password" placeholder="Em Branco = Não Alterar" />
              </div>

              <!-- Endereço -->
              <div class="form-group">
                <label for="address">Endereço</label>
                <input id="address" name="address" type="text" value="{{ old('address', auth()->user()->address) }}" />
              </div>

              <!-- Telefone -->
              <div class="form-group">
                <label for="telephone">Telefone</label>
                <input id="telephone" name="telephone" type="text" value="{{ old('telephone', auth()->user()->telephone) }}" />
              </div>

              <!-- Foto (URL) -->
              <div class="form-group">
                <label for="photo">Foto (URL)</label>
                <input id="photo" name="photo" type="url" value="{{ old('photo', auth()->user()->photo) }}" />
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="deleteUserModalLabel">Deletar Perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
          {{ __('Are you sure you want to delete your account?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
        </p>

        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
          @csrf
          @method('delete')

          <div class="mt-6">
          <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

          <x-text-input
            id="password"
            name="password"
            type="password"
            class="mt-1 block w-3/4"
            placeholder="{{ __('Password') }}"
          />

          <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
          </div>

          <div class="mt-6 flex justify-end">
          <x-secondary-button data-bs-dismiss="modal">
            {{ __('Cancel') }}
          </x-secondary-button>

          <x-danger-button class="ms-3">
            {{ __('Delete Account') }}
          </x-danger-button>
          </div>
        </form>
        </div>
      </div>
      </div>
    </div>

    {{-- Modal Criar Produto --}}
    <div class="modal fade" id="criarProdutoModal" tabindex="-1" aria-labelledby="criarProdutoModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="criarProdutoModalLabel">Criar Produto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('criarproduto') }}" method="POST" enctype="multipart/form-data">
          @csrf



          <div class="mb-3">
          <label for="foto" class="form-label">Foto do Produto</label>
          <input type="file" class="form-control" id="foto" name="photo" accept="image/*" required>
          </div>
          <div class="mb-3">
          <label for="nome" class="form-label">Nome do Produto</label>
          <input type="text" class="form-control" id="nome" name="name" required>
          </div>
          <div class="mb-3">
          <label for="preco" class="form-label">Preço</label>
          <input type="number" class="form-control" id="preco" name="price" step="0.01" required>
          </div>
          <div class="mb-3">
          <label for="quantidade" class="form-label">Quantidade</label>
          <input type="number" class="form-control" id="quantidade" name="quantity" required>
          </div>
          <div class="mb-3">
          <label for="descricao" class="form-label">Descrição</label>
          <textarea class="form-control" id="descricao" name="description" rows="3" required></textarea>
          </div>
          <div class="mb-3">
          <label for="categoria" class="form-label">Categoria</label>
          <input type="text" class="form-control" id="categoria" name="category" required>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Criar Produto</button>
          </div>
        </form>
        </div>
      </div>
      </div>
    </div>


    <script>

      //Script para mostrar o modal editar do usuario se clicar em editar
      document.querySelectorAll('.edit-user-btn').forEach(button => {
        button.addEventListener('click', function () {
          const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
          modal.show();
        });
      });

      //Script para mostrar modal excluir usuario se clicar em deletar
      document.querySelectorAll('.delete-user-btn').forEach(button => {
        button.addEventListener('click', function () {
          const modal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
          modal.show();
        });
      });

      //Script para mostrar modal criar anuncio se clicar em criar anuncio
      document.querySelectorAll('.criar-anuncio-btn').forEach(button => {
        button.addEventListener('click', function () {
          const modal = new bootstrap.Modal(document.getElementById('criarProdutoModal'));
          modal.show();
        });
      });

      //Script para esconder o modal caso clique no X defechar o modal
      document.querySelectorAll('.btn-close').forEach(button => {
        button.addEventListener('click', function () {
          const modal = bootstrap.Modal.getInstance(button.closest('.modal'));
          modal.hide();
        });
      });

      document.querySelectorAll('.modal').forEach(modalElement => {
        modalElement.addEventListener('hidden.bs.modal', function () {
          document.body.classList.remove('modal-open');
          document.querySelector('.modal-backdrop').remove();
        });
      });
    </script>
</script>
</body>

</html>
