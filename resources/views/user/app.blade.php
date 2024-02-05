<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> GrinWell Clinic </title>

    @vite('resources/css/app.css')

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-cloak x-data="{darkMode: $persist(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)}" :class="{'dark': darkMode === true }" class="antialiased">
    @include('layouts/user/navbar')
    <div class="flex flex-row-reverse">
        <main class="flex-1 p-4 dark:bg-gray-800">
            @yield('content')
        </main>
        @include('layouts/user/sidebar')
    </div>
</body>

</html>