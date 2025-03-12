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

    <button type="button" class="btn btn-warning edit-user-btn" data-bs-toggle="modal" data-bs-target="#editUserModal">Editar seu Perfil</button>
    <button type="button" class="btn btn-danger delete-user-btn" data-bs-toggle="modal" data-bs-target="#deleteUserModal">Deletar seu Perfil</button>

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

      </div>
      </div>
    </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.view-user-btn').forEach(button => {
        button.addEventListener('click', function () {
          const userId = this.getAttribute('data-user-id');
          const modal = new bootstrap.Modal(document.getElementById(`showUserModal${userId}`));
          modal.show();
        });
      });

      document.querySelectorAll('.edit-user-btn').forEach(button => {
        button.addEventListener('click', function () {
          const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
          modal.show();
        });
      });

      document.querySelectorAll('.delete-user-btn').forEach(button => {
        button.addEventListener('click', function () {
          const modal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
          modal.show();
        });
      });
    });
    </script>
</script>
</body>

</html>
