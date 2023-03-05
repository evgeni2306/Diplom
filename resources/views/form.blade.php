<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<form method="post" action = "{{route('login')}}">
{{--    <input type="text" name="name"></br>--}}
{{--    <input  type="text" name="surname"></br>--}}
    <input  type="text" name="login"></br>
    <input type="password" name="password"> </br>
    @csrf
    <input type = "submit"></br>
</form>
</body>
</html>
