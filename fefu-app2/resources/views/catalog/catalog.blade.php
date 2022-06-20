<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Catalog</title>
</head>
<body>
<div>
    <a href="/catalog">Catalog</a>
    @include('catalog.catalog_list', ['categories', $categories])
</div>
</body>
</html>
