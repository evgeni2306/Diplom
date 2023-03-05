<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href={{"/common/css/base.css"}}>
    <link rel="stylesheet" href={{"/Pages/AdminPanel/QuestionOfferList/styles.css"}}>
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
        <h1 class="register__title">Заявки на добавление вопросов</h1>
        <div class="grid">
            <div class="gridItem">Категория</div>
            <div class="gridItem">Вопрос</div>
            <div class="gridItem">Действия</div>
        </div>
        @foreach($offers as $item)
            <div class="grid">
                <div class="gridItem">{{$item->name}}</div>
                <div class="gridItem">{{$item->question}}</div>
                <div class="gridItem">
                    <a class="viewButton" href="{{route('admin.QuestionOfferView',$item->id)}}">См</a>
            </div>
        @endforeach

    </div>
</div>
</body>
</html>
