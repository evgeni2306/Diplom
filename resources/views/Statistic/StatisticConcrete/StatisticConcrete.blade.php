<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Statistic/StatisticConcrete/styles.css"}}"/>
</head>
<body onLoad="load()">
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="progressSector">
    <div>Верно пройденных от общего количества вопросов</div>
    <div class="progressBlock">
        <span class="points">{{$progressData->countRight / $progressData->count * 100}}</span>
        <div class="progress">
            <div class="progressBar">
            </div>
        </div>
    </div>
</div>


<div class="categoryDiagramSector">
    <div>Прогресс по темам</div>
    <div class="categoryDiagramZone">
        @foreach($categoryData as $item)
            <button class="categoryBlock" onclick="test('{{$item->id}}')">
                <div class="categoryName">{{$item->name}}</div>
                <div class="categoryDiagramBlock">
                    <div class="categoryDiagram progress" data-percent={{$item->correctCount}}>
                        <div class="piece left"></div>
                        <div class="piece right"></div>
                        <div class="text">
                            <div>
                                <b>{{$item->count}}</b>
                                <span>Вопросов</span>
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

</body>
<script>
    function test(categoryId) {
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
        const element = '<div class="question" name="number">' +
            '<div class="question-top">' +
            '<div class="question-top-tag">' +
            question.category +
            '</div>' +
            '<div id="isFavorite" class="hidden">' + question.isFavorite + '</div>' +
            '<div id="favoriteId" class="hidden">' + question.favoriteId + '</div>' +
            '<div id="questionId" class="hidden">' + question.questionId + '</div>' +
            '<div> статус</div>' +
            '<div id="nonFavorite" class="question-top-favourites hidden">' +
            '<button class="question-top-favourites__btn" onclick="addFavorite(' + i + ')">' +
            '<div class="question-top-favourites__icon">' +
            '<img src="{{"/common/svg/emptyFavourites.svg"}}" alt="favourites" width="16px" height="15px"/>' +
            '</div>' +
            '</button>' +
            '</div>' +

            '<div id="Favorite" class="question-top-favourites hidden">' +
            '<button class="question-top-favourites__btn" onclick="deleteFavorite(' + i + ')">' +
            '<div class="question-top-favourites__icon">' +
            '<img src="{{"/common/svg/fillFavourites.svg"}}" alt="favourites" width="16px" height="15px"/>' +
            '</div>' +
            '</button>' +
            '</div>' +

            '</div>' +
            '<div class="question__body">' +
            question.question +
            '</div>' +
            '<div class="correctAnswer">' +
            question.correctAnswer +
            '</div>' +
            '<div class="answer">' +
            question.answer +
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
