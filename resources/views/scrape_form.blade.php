<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Scraper</title>
</head>
<body>
    <h1>Ingrese la URL de la página web</h1>
    <form action="/scrape-links" method="POST">
        @csrf
        <label for="url">URL:</label>
        <input type="text" id="url" name="url" required>
        <button type="submit">Scrapear</button>
    </form>
</body>
</html>