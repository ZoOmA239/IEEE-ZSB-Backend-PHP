@props(['title'=>'My Website'])


<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        nav {
            background-color: #f0f0f0;
            padding: 1rem;
        }

        nav a {
            margin-right: 1rem;
            text-decoration: none;
        }

        .max-width-400 {
            max-width: 400px;
            margin: 0 auto;
        }

        .card {
            background-color: black;
            padding: 1rem;
            text-align: center;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="text-primarya">
    <x-nav />
    <!-- <nav>
        <a href="/">Home</a>
        <a href="/about">About Us</a>
        <a href="/contact">Contact</a>
    </nav> -->

    <main class="max-w-3xl mx-auto mt-6">
        {{ $slot }}

    </main>
</body>

</html>