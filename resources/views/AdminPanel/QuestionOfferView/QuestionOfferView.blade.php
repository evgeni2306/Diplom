<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/AdminPanel/QuestionOfferView/styles.css"}}">
    <title>Админ панель</title>
</head>
<body>
<div class="container">
    <h1 class="container__title">Просмотр вопроса</h1>
    <div class="form__container">
        <form id="form" class="form" action="{{route("admin.questionOfferForm")}}" method="post">
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
            @csrf
        </form>

        <div class="actionsZone">
            <div class="solutionButtons">
                <input type="submit" form="form" class="acceptButton" value="Принять">
                <button class="refuseButton" onclick="openPopup();event.stopPropagation()">Отклонить</button>
            </div>
            <div>
                <div class="changeButton"> Редактировать</div>
                <input id="changeable" type="checkbox" class="changeField" onchange="change();event.stopPropagation()">
            </div>

            <button class="checkButton" onclick="checkSimiliar();event.stopPropagation()">Проверить на дубликаты
            </button>
        </div>

    </div>
    <div id="similiar" class="similiar">

    </div>

    <div class="modal">
        <div class="edit-popup">
            <div class="edit-popup-close">
                <button class="modal-close-button" onclick="closePopup()"><img
                        src="{{"/Pages/KnowledgeBase/svg/cross.svg"}}" alt=""></button>
            </div>
            <div class="edit-popup__title">Опишите причину, по которой вы решили отказать в добавлении
                вопроса
            </div>
            <form method="post" action="{{route('admin.questionOfferRefuse')}}">
                <div class="feedback__comment__subtitle block__subtitle">Комментарий</div>
                <input type="text" hidden class="comment__id__edit" name='id' value="{{$questionOffer->id}}">
                <textarea required class="comment__text-edit" contenteditable="true"
                          name="comment"></textarea> @csrf
                <div class="edit-buttons">
                    <input type="submit" class="refuseButton" value="Отправить">
                </div>
            </form>
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
        const similiarList = document.getElementById('similiar');
        while (similiarList.hasChildNodes()) {
            similiarList.removeChild(similiarList.lastChild)
        }
        const route = "{{route('admin.QuestionOfferSimiliar',$questionOffer->id)}}";
        const vars = request(route);
        const arr = [];
        if (vars.length > 0) {
            let i;
            for (i = 0; i < vars.length; i++) {
                op = document.createElement('div')
                op.innerHTML = divBuilder(vars[i])
                arr.push(op)

            }
            const div = document.getElementById('similiar')
            for (i = 0; i < arr.length; i++) {
                div.append(arr[i])
            }
        }


    }

    function divBuilder(object) {
        return '<div class="question">' +
            '<div class="questionTop">' +
            '<div class="questionCategory">' +
            object.name +
            '</div>' +
            '</div>' +
            '<div class="questionBody">' +
            '<div class="questionText">' +
            object.question +
            '</div>' +
            '</div>' +
            '</div>'
    }

    function request(route) {
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", route, false); // false for synchronous request
        xmlHttp.send(null);
        return JSON.parse(xmlHttp.responseText)
    }
</script>
</html>
