<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/KnowledgeBase/styles.css"}}"/>
    <title>База знаний</title>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">
    <h1 class="container-title">База знаний</h1>
    <p class="container-subtitle">
        Знаете вопрос, который могут задать на собеседовании, но его нет в базе?
        <a href="{{route('expansionContent')}}" class="container-link">Пополнить базу знаний</a>
    </p>


    <div class="knowledge-base">
        <div class="choose-profession-block">
            <input class="choose-profession" required list="brow" value="" id="profession"
                   placeholder="Выберите профессию" onchange="changeProf()">
            <datalist class="search-box" id="brow">
                @foreach($professions as $item)
                    <option value="{{$item->name}}">
                @endforeach
            </datalist>
        </div>
        <div class="knowledge-base-questions" id="questionBox">
        </div>
    </div>
    <div class="modal">
        <div class="edit-popup">
            <div class="edit-popup-close">
                <button class="modal-close-button" onclick="closeAnswerPopup()"><img
                        src="{{"/Pages/KnowledgeBase/svg/cross.svg"}}" alt=""></button>
            </div>
            <div class="modal-question">
                <div class="modal-question-category">
                    <div id="modalQuestionCategory" class="modal-question-category-text modal-question-text ">
                    </div>
                </div>
                <div class="modal-question-question">
                    <div id="modalQuestionText" class="modal-question-question-text modal-question-text">
                    </div>
                </div>
                <div class="modal-question-answer">
                    <div id="modalQuestionAnswer" class="modal-question-answer-text">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
<script>
    let modal = document.querySelector('.modal');
    let editPopup = document.querySelector('.edit-popup');

    function closeAnswerPopup() {
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
    }

    function openAnswerPopup(elementId) {
        const element = document.getElementsByName("number");
        const questionAnswer = element[elementId].querySelector("#questionAnswer").textContent;
        const questionText = element[elementId].querySelector("#questionText").textContent;
        const questionCategory = element[elementId].querySelector("#questionCategory").textContent;
        document.querySelector("#modalQuestionAnswer").textContent = questionAnswer
        document.querySelector("#modalQuestionText").textContent = questionText
        document.querySelector("#modalQuestionCategory").textContent = questionCategory
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
    }

    function changeProf() {
        const questionBox = document.getElementById('questionBox');
        while (questionBox.hasChildNodes()) {
            questionBox.removeChild(questionBox.lastChild)
        }
        const category = document.getElementById('profession').value;
        const route = "{{route('getQuestionsForKnowledgeBase')}}";
        const questions = request(route, category);
        viewQuestions(questions)
    }

    function viewQuestions(questions) {
        for (var i = 0; i < questions.length; i++) {
            op = document.createElement('div')
            op.className = "question-wrapper"
            op.innerHTML = divBuilder(questions[i], i)
            document.getElementById('questionBox').append(op)
        }
        cards = document.getElementsByName("number")
        for (i = 0; i < questions.length; i++) {
            nonFavorite = cards[i].querySelector("#question-favorite").querySelector("#nonFavorite")
            Favorite = cards[i].querySelector("#question-favorite").querySelector("#Favorite")

            if (questions[i].isFavorite === 0) {
                nonFavorite.classList.remove('hidden')
            }
            if (questions[i].isFavorite === 1) {
                Favorite.classList.remove('hidden')
            }
        }
    }

    function divBuilder(question, i) {
        return '<div class="question-container" name="number" onclick="openAnswerPopup(' + i + ') ">' +

            '<div id="isFavorite" class="hidden">' + question.isFavorite + '</div>' +
            '<div id="favoriteId" class="hidden">' + question.favoriteId + '</div>' +
            '<div id="questionId" class="hidden">' + question.questionId + '</div>' +
            '<div id="questionAnswer" class="hidden">' + question.answer + '</div>' +

            '<div class="question-container-top">' +
            '<div class="question-category">' +
            '<div id="questionCategory" class="question-category-text">' +
            question.category +
            '</div>' +
            '</div>' +

            '<div class="question-favorite" id = "question-favorite">' +
            '<div id="Favorite" class="question-favourites hidden">' +
            '<button class="question-favourites-button" onclick="deleteFavorite(' + i + ');event.stopPropagation()">' +
            '<div class="question-favourites-icon">' +
            '<img src="{{"/common/svg/fillFavourites.svg"}}" alt="favourites" width="16px" height="15px"/>' +
            '</div>' +
            '</button>' +
            '</div>' +

            '<div id="nonFavorite" class="question-favourites hidden">' +
            '<button class="question-favourites-button" onclick="addFavorite(' + i + ');event.stopPropagation()">' +
            '<div class="question-favourites-icon">' +
            '<img src="{{"/common/svg/emptyFavourites.svg"}}" alt="favourites" width="16px" height="15px"/>' +
            '</div>' +
            '</button>' +
            '</div>' +

            ' </div>' +
            '</div>' +
            '<div class="question-container-bottom">' +
            '<div id="questionText" class="question-text">' +
            question.question +
            '</div>' +
            '</div>' +
            '</div>'
    }

    function addFavorite(id) {
        const element = document.getElementsByName("number");
        const questionId = element[id].querySelector("#questionId").textContent;
        let route = "{{route('questionFavoriteAdd',0)}}";
        route = route.substring(0, route.length - 1) + questionId;
        element[id].querySelector("#favoriteId").textContent = requestFavorite(route)
        element[id].querySelector("#isFavorite").textContent = 1
        element[id].querySelector("#nonFavorite").classList.add('hidden')
        element[id].querySelector("#Favorite").classList.remove('hidden')
    }

    function deleteFavorite(id) {
        const element = document.getElementsByName("number");
        const favoriteId = element[id].querySelector("#favoriteId").textContent;
        let route = "{{route('questionFavoriteAdd',true)}}";
        route = route.substring(0, route.length - 5) + "delete=" + favoriteId
        requestFavorite(route)
        element[id].querySelector("#favoriteId").textContent = 0
        element[id].querySelector("#isFavorite").textContent = 0
        element[id].querySelector("#nonFavorite").classList.remove('hidden')
        element[id].querySelector("#Favorite").classList.add('hidden')
    }

    function requestFavorite(route) {
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", route, false); // false for synchronous request
        xmlHttp.send(null);
        return xmlHttp.responseText;
    }

    function request(route, category) {
        const item = 'profName=' + category + '&_token=' + "{{@csrf_token()}}";
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST", route, false);
        xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xmlHttp.send(item)
        return JSON.parse(xmlHttp.responseText)
    }
</script>
</html>
