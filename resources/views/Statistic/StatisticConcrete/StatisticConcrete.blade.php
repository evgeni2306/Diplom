<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Statistic/StatisticConcrete/styles.css"}}"/>
    <title>Статистика</title>
</head>
<body onLoad="load()">
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">
    <h1 class="container__title">Ваша статистика по профессии : </h1>
    <div class="generalSector">
        <div class="progressSector">
            <div class="progressBlock">
                <div class="progressBlock-string">
                    <div>Верно пройденных от общего количества вопросов</div>
                    <div hidden class="points">{{$progressData->countRight / $progressData->count * 100}}</div>
                </div>
                <div class="progress">
                    <div class="progressBar">
                        {{$progressData->countRight / $progressData->count * 100}}%
                    </div>
                </div>
            </div>
        </div>

        <div class="categoryDiagramSector">
            <div class="categoryTitle">Прогресс по темам</div>
            <div class="categoryDiagramZone">
                @foreach($categoryData as $item)
                    <button class="categoryBlock" onclick="getQuestions('{{$item->id}}')">
                        <div class="categoryName">{{$item->name}}</div>
                        <div class="categoryDiagramBlock">
                            <div class="categoryDiagram progress" data-percent={{$item->correctCount}}>
                                <div class="piece left"></div>
                                <div class="piece right"></div>
                                <div class="text">
                                    <div>
                                        <b>{{$item->count}}</b>
                                        <span>{{trans_choice('Вопрос|Вопроса|Вопросов',$item->count)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="questionSector" id="questionSector">


        </div>
    </div>

    <div class="modal">
        <div class="edit-popup">
            <div class="edit-popup-close">
                <button class="modal-close-button" onclick="closeAnswerPopup()"><img
                        src="{{"/Pages/KnowledgeBase/svg/cross.svg"}}" alt=""></button>
            </div>
            <div class="modal-question">
                <div class="modal-question-top">
                    <div class="modal-question-category">
                        <div id="modalQuestionCategory" class="modal-question-category-text ">
                        </div>
                    </div>
                    <div class="modal-question-status" id="modalQuestionStatus">
                    </div>
                </div>
                <div class="modal-question-body">
                    <div class="modal-question-text" id = "modalQuestion">

                    </div>
                    <div class="modal-answer" id="modalAnswer">

                    </div>
                    <span style="font-weight: 600">Ваш ответ:
                    <div class="modal-user-answer" id="modalUserAnswer">

                    </div>
                        </span>
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
        const questionStatus = element[elementId].querySelector("#questionStatus").textContent;
        const modalQuestionStatus = document.querySelector("#modalQuestionStatus")
        if (questionStatus === '0') {
            modalQuestionStatus.classList.add('statusPositive')
            modalQuestionStatus.classList.add('statusNegative')
            modalQuestionStatus.textContent = "Не правильно"
        }
        if (questionStatus === '1') {
            modalQuestionStatus.classList.add('statusPositive')
            modalQuestionStatus.classList.remove('statusNegative')
            modalQuestionStatus.textContent = "Правильно"
        }
        const questionCategory = element[elementId].querySelector("#questionCategory").textContent;
        const questionText = element[elementId].querySelector("#questionText").textContent;
        const questionAnswer = element[elementId].querySelector("#correctAnswer").textContent;
        const userAnswer = element[elementId].querySelector("#questionAnswer").textContent;
        document.querySelector("#modalAnswer").textContent = questionAnswer
        document.querySelector("#modalQuestion").textContent = questionText
        document.querySelector("#modalQuestionCategory").textContent = questionCategory
        document.querySelector("#modalUserAnswer").textContent = userAnswer
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
    }

    function getQuestions(categoryId) {
        const questionSector = document.getElementById('questionSector');
        while (questionSector.hasChildNodes()) {
            questionSector.removeChild(questionSector.lastChild)
        }
        const interviewId = {{$interviewId}};
        const route = '{{route('StatisticConcreteQuestions')}}';
        const data = 'interviewId=' + interviewId + '&categoryId=' + categoryId + '&_token=' + "{{@csrf_token()}}";
        const questions = postRequest(route, data);
        viewQuestions(questions)
    }

    function viewQuestions(questions) {
        for (i = 0; i < questions.length; i++) {
            op = document.createElement('div');
            op.className = "questionWrapper";
            op.innerHTML = divBuilder(questions[i], i);
            document.getElementById('questionSector').append(op);
        }
        cards = document.getElementsByName("number")
        for (i = 0; i < questions.length; i++) {
            questionStatus = cards[i].querySelector("#questionStatus").textContent
            questionStatusBlock = cards[i].querySelector("#questionStatusBlock")
            nonFavorite = cards[i].querySelector("#nonFavorite")
            Favorite = cards[i].querySelector("#Favorite")
            if (questions[i].isFavorite === 0) {
                nonFavorite.classList.remove('hidden')
            }
            if (questions[i].isFavorite === 1) {
                Favorite.classList.remove('hidden')
            }
            if (questionStatus === '0') {
                questionStatusBlock.classList.add('statusNegative')
                questionStatusBlock.textContent = 'Не правильно'
            }
            if (questionStatus === '1') {
                questionStatusBlock.classList.add('statusPositive')
                questionStatusBlock.textContent = 'Правильно'
            }
        }
    }

    function load() {
        progressDiagram()
        categoryProgressView();
    }

    function progressDiagram() {
        let points = document.querySelector('.points').textContent;
        const progress = document.querySelector('.progressBar');
        setTimeout(() => {
            progress.style.opacity = 1;
            progress.style.width = points + '%';
        })
    }


    function categoryProgressView() {
        let diagramBox = document.querySelectorAll('.categoryDiagram.progress');
        diagramBox.forEach((box) => {
            let deg = (360 * box.dataset.percent / 100) + 180;
            if (box.dataset.percent >= 50) {
                box.classList.add('over_50');
            } else {
                box.classList.remove('over_50');
            }
            box.querySelector('.piece.right').style.transform = 'rotate(' + deg + 'deg)';
        });
    }

    function postRequest(route, data) {
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST", route, false);
        xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xmlHttp.send(data)
        return JSON.parse(xmlHttp.responseText)
    }

    function divBuilder(question, i) {
        const element = '<div class="question" name="number" onclick="openAnswerPopup(' + i + ')">' +
            '<div class="question-top">' +
            '<div class="question-top-tag" id = "questionCategory">' +
            question.category +
            '</div>' +
            '<div id="isFavorite" class="hidden">' + question.isFavorite + '</div>' +
            '<div id="favoriteId" class="hidden">' + question.favoriteId + '</div>' +
            '<div id="questionId" class="hidden">' + question.questionId + '</div>' +
            '<div id="correctAnswer" class="hidden">' + question.correctAnswer + '</div>' +
            '<div id="questionAnswer" class="hidden">' + question.answer + '</div>' +
            '<div id="questionStatus" class="hidden">' + question.status + '</div>' +

            '<div class="questionStatusBlock" id="questionStatusBlock"></div>' +

            '<div class="question-favorite" id = "question-favorite">' +

            '<div id="nonFavorite" class="question-top-favourites hidden">' +
            '<button class="question-top-favourites__btn" onclick="addFavorite(' + i + ');event.stopPropagation()">' +
            '<div class="question-top-favourites__icon">' +
            '<img src="{{"/common/svg/emptyFavourites.svg"}}" alt="favourites" width="16px" height="15px"/>' +
            '</div>' +
            '</button>' +
            '</div>' +

            '<div id="Favorite" class="question-top-favourites hidden">' +
            '<button class="question-top-favourites__btn" onclick="deleteFavorite(' + i + ');event.stopPropagation()">' +
            '<div class="question-top-favourites__icon">' +
            '<img src="{{"/common/svg/fillFavourites.svg"}}" alt="favourites" width="16px" height="15px"/>' +
            '</div>' +
            '</button>' +
            '</div>' +

            '</div>' +
            '</div>' +
            '<div class="question__body" id="questionText">' +
            question.question +
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


</script>
</html>
