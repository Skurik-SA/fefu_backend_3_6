<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $news->title }}</title>
</head>
<body>
<h1>{{ $news->title }}</h1>
<p>{{$news->published_at}}</p>
<p>{{ $news->text }}</p>
</body>
</html>
