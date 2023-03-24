<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Statistic/StatisticList/styles.css"}}"/>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="info-card">
    @foreach($interviews as $interview)
<a href="{{route('StatisticGeneral',$interview->profId)}}" >
    <div class="info-card__container">
        <div class="info-card__name">{{$interview->name}}</div>
        <div>Пройдено: {{$interview->count}} симуляций</div>
    </div>
</a>
    @endforeach
</div>
</body>
<script>

</script>
</html>
