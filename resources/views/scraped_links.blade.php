<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scraped Links</title>
</head>
<body>
    <h1>Enlaces encontrados en la página:</h1>
    <ul>
        @foreach ($links as $link)
            <li><a href="{{ $link }}">{{ $link }}</a></li>
        @endforeach
    </ul>
    <a href="/scrape-form">Volver</a>
</body>
</html>
