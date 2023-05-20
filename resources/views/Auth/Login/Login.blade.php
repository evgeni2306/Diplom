<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Auth/common/css/styles.css"}}">

    <title>Авторизация</title>
</head>
<body>
<div class="container">
    <div class="form__container">
        <h1 class="register__title">Войти в аккаунт</h1>
        <form class="form" action="{{route("login")}}" method="post">
            <input class="form__input" type="text" name="login" value="{{old('login')}}" placeholder="Логин">
            <input class="form__input" type="password" name="password" value="{{old('password')}}" placeholder="Пароль">
            @if ($errors->any())
                <div class="form__error">
                    <p class="">{{$errors->first()}}</p>
                </div>
            @endif
            <input type="submit" class="primary-button" value="Войти">
            @csrf
        </form>
        <div class="register__to-auth">
            Еще нет аккаунта?
            <a class="register__to-auth_link"
               href={{route("registration")}}> Зарегистрироваться</a>
        </div>
        <div class="divider">или</div>
        <a href={{route("vkontakte")}}>
            <a href={{route("vkontakte")}} class="form-button__vk"><img src="{{"/Pages/Auth/common/svg/VKLogo.svg"}}"
                                                                        alt="vk">Войти с
                помощью ВКонтакте</a>
        </a>
    </div>
</div>
</body>
</html>
