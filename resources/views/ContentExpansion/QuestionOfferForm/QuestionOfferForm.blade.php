<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/ContentExpansion/QuestionOfferForm/styles.css"}}"/>
    @if($questionOffer===null)
        <title>Добавление вопроса</title>
    @endif
    @if($questionOffer!==null)
        <title>Изменение вопроса</title>
    @endif
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">

    @if($questionOffer===null)
        <h1 class="container__title">Добавление вопроса</h1>
        <div class="form__container">
            <form class="form" action="{{route("questionOfferForm")}}" method="post">
                <input class="form__input" required list="brow" name="category_id"
                       placeholder="Выберите категорию">
                <datalist id="brow">
                    @foreach($categories as $item)
                        <option value="{{$item->name}}">
                    @endforeach
                </datalist>
                <input class="form__input" required type="text" name="question" placeholder="Вопрос">
                <input class="form__input" required type="text" name="answer" placeholder="Ответ">

                <input type="submit" class="primary-button" value="Отправить">
                @csrf
            </form>
        </div>
    @endif


    @if($questionOffer!==null)
        <h1 class="container__title">Изменение вопроса</h1>
        <div class="form__container">
            <form class="form" action="{{route("questionOfferUpdate",$questionOffer->id)}}" method="post">
                <input class="form__input" required list="brow" value="{{$questionOffer->category->name}}" id="test"
                       name="category_id"
                       placeholder="Выберите категорию">
                <datalist id="brow">
                    @foreach($categories as $item)
                        <option value="{{$item->name}}">
                    @endforeach
                </datalist>
                <input class="form__input" required value="{{$questionOffer->question}}" type="text"
                       name="question" placeholder="Вопрос">
                <input class="form__input" required value="{{$questionOffer->answer}}" type="text" name="answer"
                       placeholder="Ответ">

                <input type="submit" class="primary-button" value="Отправить">
                @csrf
            </form>
        </div>
    @endif

</div>
</body>
</html>
