<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/AdminPanel/QuestionOfferView/styles.css"}}">
</head>
<body>
<div class="container">

    <div class="form__container">
        <h1 class="register__title">Просмотр вопроса</h1>
        <form class="form" action="{{route("admin.questionOfferForm")}}" method="post">
            <input type="text" hidden name='id' value="{{$questionOffer->id}}">
            <input readonly class="form__input" required value="{{$questionOffer->category->name}}" list="brow"

                   name="category_id"
                   placeholder="Выберите категорию">
            <datalist id="brow">
                <option value="{{$questionOffer->name}}">
            </datalist>
            <input readonly id='questionInput' class="form__input" required type="text"
                   value="{{$questionOffer->question}}" name="question" placeholder="Вопрос">
            <input readonly id='answerInput' class="form__input" required type="text"
                   value="{{$questionOffer->answer}}"
                   name="answer" placeholder="Ответ">

            <input type="submit" class="" value="Принять">

            @csrf
        </form>

        Редактировать <input id="changeable" type="checkbox" onchange="change()">
        <button class="comment-edit" onclick="openPopup()">Отклонить</button>
        <button class="" onclick="checkSimiliar()">Проверить на дубликаты</button>
        <div id="similiar">

        </div>
        <div class="modal">
            <div class="edit-popup">
                <div class="edit-popup__close">
                    <button onclick="closePopup()">Закрыть</button>
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

    function openPopup() {
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
    }

    function closePopup() {
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
    }


    function change() {
        const questionInput = document.getElementById('questionInput');
        const answerInput = document.getElementById('answerInput');
        const changeable = document.getElementById('changeable');
        if (changeable.checked === true) {
            questionInput.removeAttribute('readonly')
            answerInput.removeAttribute('readonly')
        } else {
            questionInput.setAttribute('readonly', 'readonly')
            answerInput.setAttribute('readonly', 'readonly')
        }
    }

    function checkSimiliar() {
        const route = "{{route('admin.QuestionOfferSimiliar',$questionOffer->id)}}";
        const vars = request(route);
        const arr = [];
        if (vars.length > 0) {
            let i;
            for (i = 0; i < vars.length; i++) {
                let elem = '<div><h1>' + vars[i].name + '</h1><div>' + vars[i].question + '</div></div>';
                op = document.createElement('div')
                op.innerHTML = elem
                arr.push(op)
            }
            const div = document.getElementById('similiar')
            for (i = 0; i < arr.length; i++) {
                div.append(arr[i])
            }
        }


    }

    function request(route) {
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", route, false); // false for synchronous request
        xmlHttp.send(null);
        return JSON.parse(xmlHttp.responseText)
    }
</script>
</html>
