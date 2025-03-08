<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Your existing inline styles */
        </style>
    @endif
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" />
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <head>
                    <meta charset="UTF-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <title>Pagina de Posts</title>
                    <link rel="stylesheet" href="../../../resources/css/pagina-de-produtos.css" />
                    <link rel="preconnect" href="https://fonts.googleapis.com" />
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
                    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet" />
                    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
                    <link rel="icon" href="../../../public/assets/favicon-logo-sem-nome.png" type="image/png">
                </head>
                <header>@include('header')</header>
                <body>
                    <h1 class="bg-red-500">Pagina de Produtos</h1>
                    <div class="flex space-x-4">
                        @for ($i = 0; $i < 5; $i++)
                            @php
                                // Fetch a random product for each iteration
                                $randomProduct = App\Models\Product::inRandomOrder()->first();
                            @endphp
                            <div class="flex-1">
                                <div class="outline outline-1 outline-gray-500">
                                    <!-- Pass the random product to the modal -->
                                    @include('modal-produto', ['randomProduct' => $randomProduct])
                                </div>
                            </div>
                        @endfor
                    </div>
                </body>
            </div>
        </div>
    </div>
</body>
</html>