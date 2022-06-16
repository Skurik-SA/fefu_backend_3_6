<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
</head>
<body>
<h1>Profile</h1>
<form method="POST" action="{{route('logout')}}">
    @csrf
    <input type="submit" value="logout">
</form>
</body>
</html>
