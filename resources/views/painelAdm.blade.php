<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Posts</title>
    <link rel="stylesheet" href="../../../public/css/lista-posts.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Lobster&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
        rel="stylesheet" />
    <link rel="icon" href="../../../public/assets/favicon-logo-sem-nome.png" type="image/png">
    <style>
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<header>@include('header')</header>
<body>
<h1>Bem vindo, {{ auth()->guard('admin')->user()->name }}</h1>
</body>

<body>
<h1>painelAdm</h1>
<a href="{{ url('/admAdministrador') }}" class="btn">Controlar Administradores</a>
<a href="{{ url('/admUsuarios') }}" class="btn">Controlar Usuarios</a>
</body>
</html>