<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/ContentExpansion/QuestionOfferList/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/ContentExpansion/common/styles.css"}}"/>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">
    <div class="form__container">
        Система расширения контента
        <div class="grid">
            <div class="gridItem">Категория</div>
            <div class="gridItem">Вопрос</div>
            <div class="gridItem">Статус</div>
            <div class="gridItem">Действия</div>
        </div>
        @foreach($offers as $item)
            <div class="grid">
                <div class="gridItem">{{$item->category->name}}</div>
                <div class="gridItem">{{$item->question}}</div>
                <div class="gridItem {{$item->status}}">{{$item->statusName}}</div>
                <div class="gridItem">
                    <a class="viewButton" href="{{route('questionOfferView',$item->id)}}">См</a>
                    @if($item->status == "Green")
                        <a class="hideButton" href="{{route('questionOfferVisible',$item->id)}}">Скр</a></div>
                    @endif
            </div>
        @endforeach
        <a href="{{route('questionOfferForm')}}">Добавить вопрос</a>
    </div>
</div>
</body>
</html>
