<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Scraper</title>
</head>
<body>
    <h1>Web Scraper</h1>
    <form action="{{ route('scrape') }}" method="GET">
        <label for="url">Enter URL:</label>
        <input type="text" id="url" name="url" required>
        <label for="depth">Depth:</label>
        <input type="number" id="depth" name="depth" min="1" value="1">
        <button type="submit">Scrape</button>
    </form>

    @if(isset($links))
        <h2>Links Found:</h2>
        <ul>
            @foreach($links as $link)
                <li>{{ $link }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>

