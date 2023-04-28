<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Interview/InterviewResults/styles.css"}}"/>
    <title>Результаты симуляции</title>
</head>
<body onLoad="load()">
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->

<div class="container">
    <h1 class="containerTitle">Результат собеседования</h1>
    <div class="progressSector">
        <div class="progressSectorTop">
            <div class="progressSectorTopTitle">
                Правильные ответы
            </div>
            <div class="progressSectorTopCount">
                {{$results->countRight}}/{{$results->countRight + $results->countWrong}}
            </div>
        </div>
        <div class="progress">
            <div class="progressBar">
                {{$results->countRight / ($results->countRight + $results->countWrong) * 100}}%
            </div>
        </div>
    </div>
    <h2 class="containerTitle">
        Вам следует обратить внимание на эти вопросы
    </h2>

    <div class="questionSector">
        @for($i=0; $i<count($results->wrongQuestions); $i++)
                <? $item = $results->wrongQuestions[$i] ?>
            <div id="{{$i}}" name="number" class="questionBlock">
                <div id="isFavorite" class="hidden">{{$item->isFavorite}}</div>
                <div id="favoriteId" class="hidden">{{$item->favoriteId}}</div>
                <div id="questionId" class="hidden">{{$item->questionId}}</div>
                <div class="questionTop">
                    <div class="questionTag">
                        {{$item->category}}
                    </div>
                    <div id="nonFavorite" class="hidden">
                        <div class="questionFavorite">
                            <div class="questionFavoriteIcon">
                                <img src="{{"/common/svg/emptyFavourites.svg"}}"
                                     alt="favourites" width="16px" height="15px"/>
                            </div>
                            <button class="questionFavoriteButton"
                                    onclick="addFavorite('{{$i}}')">
                                Добавить в избранное
                            </button>
                        </div>
                    </div>
                    <div id="Favorite" class="hidden">
                        <div class="questionFavorite">
                            <div class="questionFavoriteIcon">
                                <img src="{{"/common/svg/fillFavourites.svg"}}"
                                     alt="favourites" width="16px" height="15px"/>
                            </div>
                            <button class="questionFavoriteButton"
                                    onclick="deleteFavorite('{{$i}}')">
                                Добавлено в избранное
                            </button>
                        </div>
                    </div>
                </div>
                <div class="questionBody">
                    {{$item->question}}
                </div>

            </div>

        @endfor

    </div>
    {{--                <div id ="wrongQuestions" hidden>{{$results->wrongQuestions}}</div>--}}
    <a href={{route("interviewPreview", $results->professionId)}}>
        <button class="primary-button">
            Попробовать еще раз
        </button>
    </a>

</div>

</body>
<script>

    function progressDiagram() {
        let points = {{$results->countRight / ($results->countRight + $results->countWrong) * 100}};
        const progress = document.querySelector('.progressBar');
        setTimeout(() => {
            progress.style.opacity = 1;
            progress.style.width = points + '%';
        })
    }

    function load() {
        progressDiagram()
        questions = <? echo $results->wrongQuestions ?>;
        const x = document.getElementsByName("number")
        for (i = 0; i < questions.length; i++) {
            const nonFavorite = x[i].querySelector("#nonFavorite")
            const Favorite = x[i].querySelector("#Favorite")
            if (questions[i].isFavorite === 0) {
                nonFavorite.classList.remove('hidden')
            }
            if (questions[i].isFavorite === 1) {
                Favorite.classList.remove('hidden')
            }
        }
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
