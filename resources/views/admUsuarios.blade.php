<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrar Usuarios</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <div class="container">
    <h1>Administrar Usuários</h1>

    <!-- Modal to Create User -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createUserModal">
      Criar Usuário
    </button>

    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="createUserModalLabel">Criar Usuário</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('createUser') }}" method="POST">
        @csrf
        <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmar Senha</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="mb-3">
        <label for="address" class="form-label">Endereço</label>
        <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
        <label for="telephone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telephone" name="telephone" required>
        </div>
        <div class="mb-3">
        <label for="birth_date" class="form-label">Data de Nascimento</label>
        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
        </div>
        <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf" required>
        </div>
        <div class="mb-3">
        <label for="balance" class="form-label">Saldo</label>
        <input type="number" class="form-control" id="balance" name="balance" required>
        </div>
        <div class="mb-3">
        <label for="photo" class="form-label">Foto</label>
        <input type="text" class="form-control" id="photo" name="photo" required>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Criar Usuário</button>
        </div>
      </form>
      </div>
      </div>
      </div>
    </div>

    <table class="table table-striped mt-4">
      <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
      </tr>
      </thead>
      <tbody>
      @foreach($users as $user)
        <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          <button type="button" class="btn btn-info view-user-btn" data-user-id="{{ $user->id }}">Visualizar</button>
        </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

  @foreach($users as $user)
  <div class="modal fade" id="showUserModal{{$user->id}}" tabindex="-1" aria-labelledby="showUserModalLabel{{$user->id}}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showUserModalLabel{{$user->id}}">Visualizar Usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>ID: {{ $user->id }}</p>
          <p>Nome: {{ $user->name }}</p>
          <p>Email: {{ $user->email }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editUserModal{{$user->id}}" tabindex="-1" aria-labelledby="editUserModalLabel{{$user->id}}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel{{$user->id}}">Editar Usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('updateUser', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="name{{$user->id}}" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name{{$user->id}}" name="name" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
              <label for="email{{$user->id}}" class="form-label">Email</label>
              <input type="email" class="form-control" id="email{{$user->id}}" name="email" value="{{ $user->email }}">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary">Salvar alterações</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteUserModal{{$user->id}}" tabindex="-1" aria-labelledby="deleteUserModalLabel{{$user->id}}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteUserModalLabel{{$user->id}}">Deletar Usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Tem certeza que deseja deletar o usuário <strong>{{ $user->name }}</strong>?</p>
        </div>
        <div class="modal-footer">
          <form action="{{ route('deleteUser', $user->id) }}" method="POST">
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

  <script src="{{ asset('js/app.js') }}"></script>
