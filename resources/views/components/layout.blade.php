<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PDF Planet - Konverter PDF' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-blue-50/50 text-gray-800 font-sans min-h-screen">

    {{ $slot }}

</body>

</html>