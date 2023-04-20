<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Statistic/StatisticList/styles.css"}}"/>
    <title>Выбор статистики</title>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">
    <h1 class="container__title">Выберите профессию для просмотра статистики</h1>
    <div class="professions">
        @foreach($interviews as $interview)
            <div class="info-card">
                <a href="{{route('StatisticGeneral',$interview->profId)}}">
                    <div class="info-card__container">
                        <div class="info-card__name">{{$interview->name}}</div>
                        <div>Пройдено: {{$interview->count}} симуляций</div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
</body>
<script>

</script>
</html>
