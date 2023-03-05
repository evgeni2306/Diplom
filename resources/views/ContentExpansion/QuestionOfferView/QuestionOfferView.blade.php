<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="/common/css/base.css">
    <link rel="stylesheet" href="/Pages/Components/Header/styles.css"/>
    <link rel="stylesheet" href="/Pages/ContentExpansion/QuestionOfferView/styles.css"/>
    <link rel="stylesheet" href="/Pages/ContentExpansion/common/styles.css"/>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">
    <div class="form__container">
        Система расширения контента
        <div class="grid">
            <div class="gridItem">{{$questionOffer->name}}</div>
            <div class="gridItem">{{$questionOffer->question}}</div>
            <div class="gridItem">{{$questionOffer->answer}}</div>
            <div class="gridItem {{$questionOffer->status}}">{{$questionOffer->statusName}}</div>
            <div class="gridItem">{{$questionOffer->comment}}</div>
        </div>
        @if($questionOffer->status !="Green")
            <a href="{{route('questionOfferDelete',$questionOffer->id)}}">Удалить вопрос</a>
            <a href="{{route('questionOfferUpdate',$questionOffer->id)}}">Изменить вопрос </a>
        @endif

        @if($questionOffer->status =="Green")
            <a href="{{route('questionOfferVisible',$questionOffer->id)}}">Скрыть вопрос </a>
        @endif
    </div>
</div>
</body>
</html>
