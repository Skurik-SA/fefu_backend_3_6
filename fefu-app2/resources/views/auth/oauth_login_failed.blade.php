<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
</head>
<body>
<h1>OAuth login failed</h1>
<p>{{$provider}} auth failed:{{$error}}. Try other way to log in </p>
</body>
</html>
