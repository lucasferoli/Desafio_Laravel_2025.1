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
    <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
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
              <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
              <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>