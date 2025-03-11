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
    <h1>Administrar Usuarios</h1>
    
    <table class="table table-striped mt-4">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
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
        <!-- View Modal -->
        <div class="modal fade" id="showUserModal{{$user->id}}" tabindex="-1" aria-labelledby="showUserModalLabel{{$user->id}}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showUserModalLabel{{$user->id}}">Visualizar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>ID: {{ $user->id }}</p>
          <p>Name: {{ $user->name }}</p>
          <p>Email: {{ $user->email }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  <script src="{{ asset('js/app.js') }}"></script>
