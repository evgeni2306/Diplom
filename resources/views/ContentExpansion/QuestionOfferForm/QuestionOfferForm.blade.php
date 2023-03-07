<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href={{"style.css"}}/>
    <link rel="stylesheet" href={{"/common/css/base.css"}}>
    <link rel="stylesheet" href={{"/Pages/Components/Header/styles.css"}}/>
    <link rel="stylesheet" href={{"/Pages/ContentExpansion/QuestionOfferForm/styles.css"}}/>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">
    <div class="form__container">
        @if($questionOffer===null)
            Добавление вопроса
            <form class="form" action="{{route("questionOfferForm")}}" method="post">
                <input class="form__input" required="true" list="brow" name="category_id"
                       placeholder="Выберите категорию">
                <datalist id="brow">
                    @foreach($categories as $item)
                        <option value="{{$item->name}}">
                    @endforeach
                </datalist>
                <input class="form__input" required="true" type="text" name="question" placeholder="Вопрос">
                <input class="form__input" required="true" type="text" name="answer" placeholder="Ответ">

                <input type="submit" class="primary-button" value="Отправить">
                @csrf
            </form>
        @endif
        @if($questionOffer!==null)
            Изменение вопроса
            <form class="form" action="{{route("questionOfferUpdate",$questionOffer->id)}}" method="post">
                <input class="form__input" required="true" list="brow" value="{{$questionOffer->category->name}}" id="test"
                       name="category_id"
                       placeholder="Выберите категорию">
                <datalist id="brow">
                    @foreach($categories as $item)
                        <option value="{{$item->name}}">
                    @endforeach
                </datalist>
                <input class="form__input" required="true" value="{{$questionOffer->question}}" type="text"
                       name="question" placeholder="Вопрос">
                <input class="form__input" required="true" value="{{$questionOffer->answer}}" type="text" name="answer"
                       placeholder="Ответ">

                <input type="submit" class="primary-button" value="Отправить">
                @csrf
            </form>
        @endif
    </div>
</div>
</body>
</html>
