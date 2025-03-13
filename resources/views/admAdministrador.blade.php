<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Administradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
@include('header')
<body>
    <div class="container mt-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAdminModal">
            Criar Administrador
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
                @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        <button type="button" class="btn btn-info view-admin-btn" data-admin-id="{{ $admin->id }}">Visualizar</button>
                        <button type="button" class="btn btn-warning edit-admin-btn" data-admin-id="{{ $admin->id }}">Editar</button>
                        <button type="button" class="btn btn-danger delete-admin-btn" data-admin-id="{{ $admin->id }}">Deletar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach($admins as $admin)
    <!-- Modal de Visualização -->
    <div class="modal fade" id="showAdminModal{{ $admin->id }}" tabindex="-1" aria-labelledby="showAdminModalLabel{{ $admin->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Visualizar Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>ID: {{ $admin->id }}</p>
                    <p>Nome: {{ $admin->name }}</p>
                    <p>Email: {{ $admin->email }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div class="modal fade" id="editAdminModal{{ $admin->id }}" tabindex="-1" aria-labelledby="editAdminModalLabel{{ $admin->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admins.update', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name{{ $admin->id }}">Nome</label>
                            <input type="text" id="name{{ $admin->id }}" name="name" value="{{ $admin->name }}">
                        </div>
                        <div>
                            <label for="email{{ $admin->id }}">Email</label>
                            <input type="email" id="email{{ $admin->id }}" name="email" value="{{ $admin->email }}">
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
    <div class="modal fade" id="deleteAdminModal{{ $admin->id }}" tabindex="-1" aria-labelledby="deleteAdminModalLabel{{ $admin->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deletar Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja deletar o administrador <strong>{{ $admin->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admins.destroy', $admin->id) }}" method="POST">
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

    <!-- Modal de Criação -->
    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="createAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAdminModalLabel">Criar Administrador</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admins.store') }}" method="POST">
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
                        <div class="modal-footer">
                            <button type="button" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit">Criar Administrador</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.view-admin-btn').forEach(button => {
            button.addEventListener('click', function () {
                const adminId = this.getAttribute('data-admin-id');
                const modal = new bootstrap.Modal(document.getElementById(`showAdminModal${adminId}`));
                modal.show();
            });
        });

        document.querySelectorAll('.edit-admin-btn').forEach(button => {
            button.addEventListener('click', function () {
                const adminId = this.getAttribute('data-admin-id');
                const modal = new bootstrap.Modal(document.getElementById(`editAdminModal${adminId}`));
                modal.show();
            });
        });

        document.querySelectorAll('.delete-admin-btn').forEach(button => {
            button.addEventListener('click', function () {
                const adminId = this.getAttribute('data-admin-id');
                const modal = new bootstrap.Modal(document.getElementById(`deleteAdminModal${adminId}`));
                modal.show();
            });
        });
    });
</script>

</body>
</html>
