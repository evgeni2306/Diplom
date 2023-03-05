<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Interview Directions</title>
    <link rel="stylesheet" href="/common/css/base.css">
    <link rel="stylesheet" href="/Pages/Components/Header/styles.css"/>
    <link rel="stylesheet" href="/Pages/Interview/InterviewDirections/styles.css"/>
    <link rel="stylesheet" href="/Pages/Interview/common/InfoCard.css"/>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="directions">
    <h1 class="directions__title">Выберите направление разработки</h1>
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

</body>
</html>
