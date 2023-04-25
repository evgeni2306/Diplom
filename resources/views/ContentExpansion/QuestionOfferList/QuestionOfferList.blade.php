<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/ContentExpansion/QuestionOfferList/styles.css"}}"/>
    <title>Система расширения контента</title>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">
    <h1 class="container__title">Система расширения контента</h1>
    <p class="container-subtitle">
        <a href="{{route('questionOfferForm')}}" class="container-link">Предложить вопрос для добавления</a>
    </p>
    @if(count($offers)>0)
        @foreach($offers as $item)
            <div class="questionBlock">
                <div class="questionBlockTop">
                    <div class="categoryBlock">
                        <div class="category">{{$item->category->name}}</div>
                    </div>
                    <div class="questionStatusBlock">
                        <div class="status {{$item->status}} ">{{$item->statusName}}</div>
                    </div>
                    <div class="questionActionsBlock">
                        <div class="actions">
                            <a class="actionButton" href="{{route('questionOfferView',$item->id)}}"><img
                                    class="actionButton"
                                    src="{{"/Pages/ContentExpansion/QuestionOfferList/svg/openEye.svg"}}"
                                    alt=""></a>
                            @if($item->status == "Green")
                                <a class="actionButton" href="{{route('questionOfferVisible',$item->id)}}"><img
                                        src="{{"/Pages/ContentExpansion/QuestionOfferList/svg/closeEye.svg"}}"
                                        alt=""></a>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="questionBlockBody">
                    <div class="question flex-elem">{{$item->question}}</div>
                </div>
            </div>
        @endforeach
    @endif
    @if(count($offers)===0)

        <div class="voidMenu">
            <div class="voidTextMain">Тут будут отображаться предложенные вами вопросы</div>
            <div class="voidTextSecond">Но пока что тут пусто</div>
        </div>
    @endif
</div>
</body>
</html>
