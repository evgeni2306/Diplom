<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Knowledge Base</title>
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/KnowledgeBase/styles.css"}}"/>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="knowledge-base">

    <h1 class="knowledge-base__title">База знаний</h1>
    <p class="knowledge-base__subtitle">
        Знаете вопрос, который могут задать на собеседовании, но его нет в базе?
        <span class="knowledge-base__link">Пополнить базу знаний</span>
    </p>
    <div class="knowledge-base__container">
        <div class="knowledge-base__professions">
            <div class="knowledge-base__professions-found">
                <input class="" required list="brow" value="" id="profession"
                       placeholder="Выберите профессию" onchange="changeProf()">
                <datalist class="search-box" id="brow">
                    @foreach($professions as $item)
                        <option value="{{$item->name}}">
                    @endforeach
                </datalist>
            </div>
        </div>
        <div class="knowledge-base__questions" id="questionBox">
        </div>
    </div>
</div>
</body>
<script>

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
        for (i = 0; i < questions.length; i++) {
            op = document.createElement('div')
            op.className = "knowledge-base__wrapper"
            op.innerHTML = divBuilder(questions[i], i)
            document.getElementById('questionBox').append(op)
        }
        cards = document.getElementsByName("number")
        for (i = 0; i < questions.length; i++) {
            nonFavorite = cards[i].querySelector("#nonFavorite")
            Favorite = cards[i].querySelector("#Favorite")
            if (questions[i].isFavorite === 0) {
                nonFavorite.classList.remove('hidden')
            }
            if (questions[i].isFavorite === 1) {
                Favorite.classList.remove('hidden')
            }
        }
    }

    function divBuilder(question, i) {
        const element = '<div class="knowledge-base__question" name="number">' +
            '<div class="knowledge-base__question-top">' +
            '<div class="knowledge-base__question-top-tag">' +
            question.category +
            '</div>' +
            '<div id="isFavorite" class="hidden">' + question.isFavorite + '</div>' +
            '<div id="favoriteId" class="hidden">' + question.favoriteId + '</div>' +
            '<div id="questionId" class="hidden">' + question.questionId + '</div>' +

            '<div id="nonFavorite" class="knowledge-base__question-top-favourites hidden">' +
            '<button class="knowledge-base__question-top-favourites__btn" onclick="addFavorite(' + i + ')">' +
            '<div class="knowledge-base__question-top-favourites__icon">' +
            '<img src="{{"/common/svg/emptyFavourites.svg"}}" alt="favourites" width="16px" height="15px"/>' +
            '</div>' +
            '</button>' +
            '</div>' +

            '<div id="Favorite" class="knowledge-base__question-top-favourites hidden">' +
            '<button class="knowledge-base__question-top-favourites__btn" onclick="deleteFavorite(' + i + ')">' +
            '<div class="knowledge-base__question-top-favourites__icon">' +
            '<img src="{{"/common/svg/fillFavourites.svg"}}" alt="favourites" width="16px" height="15px"/>' +
            '</div>' +
            '</button>' +
            '</div>' +

            '</div>' +
            '<div class="knowledge-base__question__body">' +
            question.question;
        '</div>' +
        '</div>'
        return element
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
