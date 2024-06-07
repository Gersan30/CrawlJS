<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JS Crawler</title>
</head>
<body>
    <h1>JavaScript Crawler</h1>
    <form action="{{ route('crawl') }}" method="GET">
        <label for="url">Enter URL:</label>
        <input type="text" id="url" name="url" required>
        <button type="submit">Crawl</button>
    </form>

    @if(isset($jsFiles))
        <h2>JavaScript Files Found:</h2>
        <ul>
            @foreach($jsFiles as $jsFile)
                <li>{{ $jsFile }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
