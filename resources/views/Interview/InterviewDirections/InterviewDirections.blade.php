<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Interview/InterviewDirections/styles.css"}}"/>
    <title>Interview Directions</title>

</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">
    <h1 class="container__title">Выберите направление разработки</h1>
    <div class="directions">
        @foreach($directions as $item)
            <div class="info-card">
                <a href={{route($item->url, $item->id)}} >
                    <div class="info-card__container">
                        <div class="info-card__name">{{$item->name}}</div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
