<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href={{"/common/css/base.css"}}>
    <link rel="stylesheet" href={{"/Pages/AdminPanel/Login/styles.css"}}>
</head>
<body>
<div class="container">
    <div class="logo-register">
        <div class="logo-register__wrapper">
            <img class="logo-register__icon" src="{{"/common/svg/logo.svg"}}" alt="logo"/>
            <span class="logo-register__name">JobInterview</span>
        </div>
    </div>
    <div class="form__container">
        <h1 class="register__title">Админ-панель</h1>
        <form  class="form" action="{{route("admin.login")}}" method="post">
            <input class="form__input" type="text" name="login" placeholder="Логин">
            <input class="form__input" type="password" name="password" placeholder="Пароль">


            {{--            <InputError--}}
            {{--                message={errorMessage}--}}
            {{--                className="form__error"--}}
            {{--            />--}}

            {{--            <InputError--}}
            {{--                message={errors.password}--}}
            {{--                className="form__error"--}}
            {{--            />--}}
            <input type="submit"  class="primary-button" value="Войти">
            @csrf
        </form>

    </div>
</div>
</body>
</html>
