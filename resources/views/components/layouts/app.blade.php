<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body>
    <div class="containt">
        {{$slot}}
    </div>
    @livewireScripts
    @vite('resources/js/app.js')
</body>
</html>