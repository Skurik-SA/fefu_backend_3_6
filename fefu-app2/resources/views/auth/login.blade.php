<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход</title>
</head>
<body>
<h1>Вход</h1>
<form method="POST" action="{{route('login.post')}}">
    @csrf
    <div>
        <label>E-mail</label>
        <input type="email" name="email" value="{{old('email')}}" maxlength="255"/>
        @error('email')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>
    <div>
        <label>Пароль</label>
        <input type="password" name="password" value="{{old('password')}}" maxlength="2000"></textarea>
        @error('password')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>
    <div>
        <input type="submit"/>
    </div>
</form>
</body>
</html>