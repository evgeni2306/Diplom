<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Register</title>
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Auth/common/styles.css"}}">
</head>
<body>
<div class="container">
    <div class="logo-register">
        <div class="logo-register__wrapper">
            <img
                class="logo-register__icon"
                src="/common/svg/logo.svg"
                alt="logo"
            />
            <span class="logo-register__name">JobInterview</span>
        </div>
    </div>
    <div class="form__container">

        <h1 class="register__title">Регистрация</h1>
        <form class="form" action="{{route("registration")}}" method="post">

            <div class="form__names">
                <input class="form__input" type="text" name="name" value="{{old('name')}}" placeholder="Имя">
                <input class="form__input" type="text" name="surname" value="{{old('surname')}}" placeholder="Фамилия">
            </div>
            <input class="form__input" type="text" name="login" value="{{old('login')}}" placeholder="Логин">
            <input class="form__input" type="password" name="password" value="{{old('password')}}" placeholder="Пароль">
            @if ($errors->any())
                <div class="form__error">
                    <p class="">{{$errors->first()}}</p>
                </div>
            @endif
            <input type="submit" class="primary-button" value="Зарегистрироваться">
            @csrf
        </form>
        <div class="register__to-auth">
            Уже есть аккаунт?
            <a class="register__to-auth_link"
               href={{route("login")}}> Войти</a>
        </div>
        <a href={{route("vkontakte")}}>
            <div class="register__to-auth_link">
                Войти через VK
            </div>
        </a>
    </div>
</div>
</body>
</html>
