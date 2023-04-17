<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Favorite/styles.css"}}"/>
    <title>Избранное</title>
</head>
<body onLoad="load()">
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">
    <h1 class="container-title">Избранное</h1>
    <p class="container-subtitle">
        Тут отображаются все отмеченные вами вопросы
    </p>

    <div class="favorite-section">
        <div class="favorite-section-questions" id="questionBox">

            @foreach($favorites as $item)
                <div class="question-wrapper" id="{{$item->favoriteId}}">
                    <div class="question-container"  onclick="openAnswerPopup()">
                        <div id="questionAnswer" class="hidden">{{$item->answer}}</div>
                        <div class="question-container-top">
                            <div class="question-category">
                                <div id="questionCategory" class="question-category-text">
                                    {{$item->category }}
                                </div>
                            </div>
                            <div class="question-favorite" id="question-favorite">
                                <div id="Favorite" class="question-favourites ">
                                    <button class="question-favourites-button"
                                            onclick="deleteFavorite({{$item->favoriteId}})">
                                        <div class="question-favourites-icon">
                                            <img src="{{"/common/svg/fillFavourites.svg"}}" alt="favourites"
                                                 width="16px"
                                                 height="15px"/>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="question-container-bottom">
                            <div class="question-text">
                                {{$item->question}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

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
    function load() {

    }

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

    function deleteFavorite(id) {
        const element = document.getElementById(id);
        let route = "{{route('questionFavoriteAdd',true)}}";
        element.remove();
        route = route.substring(0, route.length - 5) + "delete=" + id
        requestFavorite(route)

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
