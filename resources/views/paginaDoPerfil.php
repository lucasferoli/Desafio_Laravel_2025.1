<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Perfil</title>
  <link rel="stylesheet" href="{{ asset('css/lista-posts.css') }}" />
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
    <h1>Editar Perfil</h1>

    <!-- Success Message -->
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    <!-- Error Message -->
    @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    <!-- Profile Update Form -->
    <form method="POST" action="{{ route('profile.update') }}">
      @csrf
      @method('PATCH')

      <!-- Name -->
      <div class="form-group">
        <label for="name">Nome</label>
        <input
          id="name"
          name="name"
          type="text"
          value="{{ old('name', $user->name) }}"
          required
          autofocus
        />
        @error('name')
          <span class="error">{{ $message }}</span>
        @enderror
      </div>

      <!-- Password -->
      <div class="form-group">
        <label for="password">Nova Senha</label>
        <input
          id="password"
          name="password"
          type="password"
          placeholder="Deixe em branco para manter a senha atual"
        />
        @error('password')
          <span class="error">{{ $message }}</span>
        @enderror
      </div>

      <!-- Address -->
      <div class="form-group">
        <label for="address">Endereço</label>
        <input
          id="address"
          name="address"
          type="text"
          value="{{ old('address', $user->address) }}"
        />
        @error('address')
          <span class="error">{{ $message }}</span>
        @enderror
      </div>

      <!-- Telephone -->
      <div class="form-group">
        <label for="telephone">Telefone</label>
        <input
          id="telephone"
          name="telephone"
          type="text"
          value="{{ old('telephone', $user->telephone) }}"
        />
        @error('telephone')
          <span class="error">{{ $message }}</span>
        @enderror
      </div>

      <!-- Photo -->
      <div class="form-group">
        <label for="photo">Foto (URL)</label>
        <input
          id="photo"
          name="photo"
          type="url"
          value="{{ old('photo', $user->photo) }}"
        />
        @error('photo')
          <span class="error">{{ $message }}</span>
        @enderror
      </div>

      <!-- Submit Button -->
      <div class="form-group">
        <button type="submit">Salvar Alterações</button>
      </div>
    </form>
  </div>
</body>

</html>