<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
@include('header')
<body>
    <div class="container mt-4">
      <div class="container mt-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
            Criar Usuário
        </button>

        <table class="table mt-3">
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
                        <button type="button" class="btn btn-warning edit-user-btn" data-user-id="{{ $user->id }}">Editar</button>
                        <button type="button" class="btn btn-danger delete-user-btn" data-user-id="{{ $user->id }}">Deletar</button>
                        <button type="button" class="btn btn-success">Mandar E-mail</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach($users as $user)
    <!-- Modal de Visualização -->
    <div class="modal fade" id="showUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="showUserModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Visualizar Usuário</h5>
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

    <!-- Modal de Edição -->
    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Editar Usuário</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('updateUser', $user->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div>
                          <label for="name{{ $user->id }}">Nome</label>
                          <input type="text" id="name{{ $user->id }}" name="name" value="{{ $user->name }}">
                      </div>
                      <div>
                          <label for="email{{ $user->id }}">Email</label>
                          <input type="email" id="email{{ $user->id }}" name="email" value="{{ $user->email }}">
                      </div>
                      <div>
                          <label for="address{{ $user->id }}">Endereço</label>
                          <input type="text" id="address{{ $user->id }}" name="address" value="{{ $user->address }}">
                      </div>
                      <div>
                          <label for="telephone{{ $user->id }}">Telefone</label>
                          <input type="text" id="telephone{{ $user->id }}" name="telephone" value="{{ $user->telephone }}">
                      </div>
                      <div>
                          <label for="birth_date{{ $user->id }}">Data de Nascimento</label>
                          <input type="date" id="birth_date{{ $user->id }}" name="birth_date" value="{{ $user->birth_date }}">
                      </div>
                      <div>
                          <label for="cpf{{ $user->id }}">CPF</label>
                          <input type="text" id="cpf{{ $user->id }}" name="cpf" value="{{ $user->cpf }}">
                      </div>
                      <div>
                          <label for="balance{{ $user->id }}">Saldo</label>
                          <input type="number" id="balance{{ $user->id }}" name="balance" value="{{ $user->balance }}">
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
    <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUserModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deletar Usuário</h5>
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

    

    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createUserModalLabel">Criar Usuário</h5>
            <button type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('createUser') }}" method="POST">
              @csrf
              <div>
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" required>
              </div>
              <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
              </div>
              <div>
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
              </div>
              <div>
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
              </div>
              <div>
                <label for="address">Endereço</label>
                <input type="text" id="address" name="address" required>
              </div>
              <div>
                <label for="telephone">Telefone</label>
                <input type="text" id="telephone" name="telephone" required>
              </div>
              <div>
                <label for="birth_date">Data de Nascimento</label>
                <input type="date" id="birth_date" name="birth_date" required>
              </div>
              <div>
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" required>
              </div>
              <div>
                <label for="balance">Saldo</label>
                <input type="number" id="balance" name="balance" required>
              </div>
              <div>
                <label for="photo">Foto</label>
                <input type="text" id="photo" name="photo" required>
              </div>
              <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal">Fechar</button>
                <button type="submit">Criar Usuário</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- Modal de Contato -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('contact.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Assunto</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Mensagem</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required> </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
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
                const userId = this.getAttribute('data-user-id');
                const modal = new bootstrap.Modal(document.getElementById(`editUserModal${userId}`));
                modal.show();
            });
        });

        document.querySelectorAll('.delete-user-btn').forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-user-id');
                const modal = new bootstrap.Modal(document.getElementById(`deleteUserModal${userId}`));
                modal.show();
            });
        });

        document.querySelectorAll('.btn-success').forEach(button => {
            button.addEventListener('click', function () {
                const modal = new bootstrap.Modal(document.getElementById('contactModal'));
                modal.show();
            });
        });
    });
</script>

</body>
</html>
