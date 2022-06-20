<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
</head>
<body>
<h1>Profile</h1>
<div>
    <h3>OAuth info:</h3>
    <div>
        <h4>App:</h4>
        <label>
            <b>Last login date: </b>{{$user['app_logged_in_at'] ?? 'Never'}}<br/>
            <b>Registration date: </b>{{$user['app_registered_at'] ?? 'Never'}}
        </label>
    </div>
    <h4>GitHub:</h4>
    <label>
        <b>Last login date: </b>{{$user['github_logged_in_at'] ?? 'Never'}}<br/>
        <b>Registration date: </b>{{$user['github_registered_at'] ?? 'Never'}}
    </label>
</div>
<div>
    <h4>VK:</h4>
    <label>
        <b>Last login date: </b>{{$user['vkontakte_logged_in_at'] ?? 'Never'}}<br/>
        <b>Registration date: </b>{{$user['vkontakte_registered_at'] ?? 'Never'}}
    </label>
</div>
<div>
    <h4>Google:</h4>
    <label>
        <b>Last login date: </b>{{$user['google_logged_in_at'] ?? 'Never'}}<br/>
        <b>Registration date: </b>{{$user['google_registered_at'] ?? 'Never'}}
    </label>
</div>
<form method="POST" action="{{route('logout')}}">
    @csrf
    <input type="submit" value="logout">
</form>
</body>
</html>
