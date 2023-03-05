<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Register</title>
    <link rel="stylesheet" href="/common/css/base.css">
    <link rel="stylesheet" href="/Pages/Auth/Common/styles.css">
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
                <input class="form__input" type="text" name="name" placeholder="Имя">
                <input class="form__input" type="text" name="surname" placeholder="Фамилия">
            </div>
            <input class="form__input" type="text" name="login" placeholder="Логин">
            <input class="form__input" type="password" name="password" placeholder="Пароль">
            {{--                <TextInput--}}
            {{--                    type="text"--}}
            {{--                    name="name"--}}
            {{--                    value={data.name}--}}
            {{--                    placeholder="Имя"--}}
            {{--                    className="form__input name"--}}
            {{--                    autoComplete="name"--}}
            {{--                    isFocused={true}--}}
            {{--                    handleChange={onHandleChange}--}}
            {{--                    required--}}
            {{--                />--}}

            {{--                <InputError--}}
            {{--                    className="form__error"--}}
            {{--                    message={errors.name}--}}
            {{--                />--}}

            {{--                <TextInput--}}
            {{--                    type="text"--}}
            {{--                    name="surname"--}}
            {{--                    value={data.surname}--}}
            {{--                    placeholder="Фамилия"--}}
            {{--                    className="form__input surname"--}}
            {{--                    handleChange={onHandleChange}--}}
            {{--                    required--}}
            {{--                />--}}

            {{--                <InputError--}}
            {{--                    className="form__error"--}}
            {{--                    message={errors.surname}--}}
            {{--                />--}}
            {{--            </div>--}}

            {{--            <TextInput--}}
            {{--                type="text"--}}
            {{--                name="login"--}}
            {{--                value={data.login}--}}
            {{--                placeholder="Логин"--}}
            {{--                className="form__input"--}}
            {{--                handleChange={onHandleChange}--}}
            {{--                required--}}
            {{--            />--}}

            {{--            <InputError--}}
            {{--                className="form__error"--}}
            {{--                message={errorMessage}--}}
            {{--            />--}}

            {{--            <PasswordShowHide--}}
            {{--                setData={setData}--}}
            {{--                password={data.password}--}}
            {{--            />--}}

            {{--            <InputError--}}
            {{--                className="form__error"--}}
            {{--                message={errors.password}--}}
            {{--            />--}}
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
