<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href={{"/common/css/base.css"}}>
    <link rel="stylesheet" href={{"/Pages/AdminPanel/QuestionOfferView/styles.css"}}>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="container">

    <div class="form__container">
        <h1 class="register__title">Просмотр вопроса</h1>
        <form class="form" action="{{route("admin.questionOfferForm")}}" method="post">
            <input type="text" hidden class="comment__id__edit" name='id' value="{{$questionOffer->id}}">
            <input readonly class="form__input" required="true" value="{{$questionOffer->category->name}}" list="brow"

                   name="category_id"
                   placeholder="Выберите категорию">
            <datalist id="brow">
                <option value="{{$questionOffer->name}}">
            </datalist>
            <input readonly id='questionInput' class="form__input" required="true" type="text"
                   value="{{$questionOffer->question}}" name="question" placeholder="Вопрос">
            <input readonly id='answerInput' class="form__input" required="true" type="text"
                   value="{{$questionOffer->answer}}"
                   name="answer" placeholder="Ответ">

            <input type="submit" class="" value="Принять">

            @csrf
        </form>

        Редактировать <input id="changeable" type="checkbox" onchange="change()">
        <button class="comment-edit">Отклонить</button>
        <button class="" onclick="checkSimiliar()">Проверить на дубликаты</button>
        <div id="similiar">

        </div>
        <div class="modal">
            <div class="edit-popup">
                <div class="edit-popup__close">
                    <button>Закрыть</button>
                </div>
                <div class="edit-popup__title title">Опишите причину, по которой вы решили отказать в добавлении
                    вопроса
                </div>
                <form method="post" action="{{route('admin.questionOfferRefuse')}}">
                    <div class="feedback__comment__subtitle block__subtitle">Комментарий</div>
                    <input type="text" hidden class="comment__id__edit" name='id' value="{{$questionOffer->id}}">
                    <textarea required class="comment__text-edit" contenteditable="true"
                              name="comment"></textarea> @csrf
                    <div class="edit-buttons">
                        <input type="submit" class="edit__save" value="Отправить">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    let modal = document.querySelector('.modal');
    let editPopup = document.querySelector('.edit-popup');
    let popupCloseButton = document.querySelector('.edit-popup__close');
    let editButton = document.querySelector('.comment-edit');
    let commentText = document.querySelector('.comment__text');
    let commentTextEdit = document.querySelector('.comment__text-edit');
    let commentId = document.querySelector('.comment__id');
    let commentIdEdit = document.querySelector('.comment__id__edit');
    let commentRating = document.querySelector('.comment__rating1');


    //передача данных коммента в инпут
    editButton.addEventListener('click', function () {
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
        commentTextEdit.value = commentText.textContent;
        commentIdEdit.value = commentId.value;


    });
    popupCloseButton.addEventListener('click', function () {
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
    });

    function change() {
        questionInput = document.getElementById('questionInput')
        answerInput = document.getElementById('answerInput')
        changeable = document.getElementById('changeable');
        if (changeable.checked === true) {
            questionInput.removeAttribute('readonly')
            answerInput.removeAttribute('readonly')
        } else {
            questionInput.setAttribute('readonly', 'readonly')
            answerInput.setAttribute('readonly', 'readonly')
        }
    }

    function checkSimiliar() {
        route = "{{route('admin.QuestionOfferSimiliar',$questionOffer->id)}}"
        vars = request(route)
        arr = []
        for (i = 0; i < vars.length; i++) {
            elem = '<div><h1>' + vars[i].name + '</h1><div>' + vars[i].question + '</div></div>';
            op = document.createElement('div')
            op.innerHTML = elem
            arr.push(op)
        }
        const div = document.getElementById('similiar')
        for (i = 0; i < arr.length; i++) {
            div.append(arr[i])
        }


        // html = $.parseHTML(elem);


        // $('#similiar').append(elem)


        console.log(vars)
    }

    function request(route) {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", route, false); // false for synchronous request
        xmlHttp.send(null);
        answer = JSON.parse(xmlHttp.responseText)
        return answer;
    }
</script>
</html>
