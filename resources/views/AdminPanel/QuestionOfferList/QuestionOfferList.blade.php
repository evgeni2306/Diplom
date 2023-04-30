<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/AdminPanel/QuestionOfferList/styles.css"}}">
    <title>Админ-панель</title>
</head>
<body>
<div class="container">
    <h1 class="container__title">Заявки на добавление вопросов</h1>
    <div class="form__container">
        @foreach($offers as $item)
            <div class="questionBlock">
                <div class="questionBlockTop">
                    <div class="categoryBlock">
                        <div class="category" id="category">{{$item->category->name}}</div>
                    </div>
                    <div class="questionActionsBlock">
                        <div class="actions">
                            <a class="actionButton" onclick="event.stopPropagation()"
                               href="{{route('admin.QuestionOfferView',$item->id)}}"><img
                                    src="{{"/Pages/ContentExpansion/QuestionOfferList/svg/openEye.svg"}}"
                                    alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="questionBlockBody">
                    <div class="question" id="question">{{$item->question}}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
