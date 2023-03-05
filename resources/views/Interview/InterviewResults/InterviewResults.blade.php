<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Interview Results</title>
    <link rel="stylesheet" href={{"/common/css/base.css"}}>
    <link rel="stylesheet" href={{"/Pages/Components/Header/styles.css"}}/>
    <link rel="stylesheet" href={{"/Pages/Interview/InterviewResults/styles.css"}}/>
</head>
<body onLoad="load()">
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->

<div className="results-page">
    <h1 class="results-page__title">Результат собеседования</h1>
    <div class="results-page__container">
        <h1 class="results-page__title">Результат собеседования</h1>
        <div class="results-page__progress">
            <div class="results-page__progress-top">
                <div class="results-page__progress-top-name">
                    Правильные ответы
                </div>
                <div class="results-page__progress-top-count">
                    {{$results->countRight}}/{{$results->countRight + $results->countWrong}}
                </div>
            </div>
            <div class="results-page__progress-bar">
                <div class="results-page__progress-bar-done">
                    <div class="percent-count">
                    </div>
                </div>
            </div>
        </div>
        <h2 class="results-page__title-sec">
            Вам следует обратить внимание на эти вопросы
        </h2>

        <div class="results-page__questions">

            @for($i=0; $i<count($results->wrongQuestions); $i++)
                <?$item = $results->wrongQuestions[$i]?>
                <div id="{{$i}}" name="number" class="results-page__question">
                    <div id="isFavorite" class="hidden">{{$item->isFavorite}}</div>
                    <div id="favoriteId" class="hidden">{{$item->favoriteId}}</div>
                    <div id="questionId" class="hidden">{{$item->questionId}}</div>
                    <div class="results-page__question-top">
                        <div class="results-page__question-top-tag">
                            {{$item->category}}
                        </div>
                        <div id="nonFavorite" class="hidden">
                            <div class="results-page__question-top-favourites">
                                <div class="results-page__question-top-favourites__icon">
                                    <img src="{{"/Pages/Interview/InterviewResults/svg/emptyFavourites.svg"}}"
                                         alt="favourites" width="16px" height="15px"/>
                                </div>
                                <button class="results-page__question-top-favourites__btn"
                                        onclick="addFavorite('{{$i}}')">
                                    Добавить в избранное
                                </button>
                            </div>
                        </div>
                        <div id="Favorite" class="hidden">
                            <div class="results-page__question-top-favourites">
                                <div class="results-page__question-top-favourites__icon">
                                    <img src="{{"/Pages/Interview/InterviewResults/svg/fillFavourites.svg"}}"
                                         alt="favourites" width="16px" height="15px"/>
                                </div>
                                <button class="results-page__question-top-favourites__btn"
                                        onclick="deleteFavorite('{{$i}}')">
                                    Добавлено в избранное
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="results-page__question__body">
                        {{$item->question}}
                    </div>

                </div>

            @endfor

        </div>
        <a href={{route("interviewPreview", $results->professionId)}}>
            <button class="primary-button">
                Попробовать еще раз
            </button>
        </a>

    </div>
</div>
</body>
<script>


    function load() {
        x = document.getElementsByName("number")
        @for($i=0; $i<count($results->wrongQuestions);$i++)
            nonFavorite = x[{{$i}}].querySelector("#nonFavorite")
        Favorite = x[{{$i}}].querySelector("#Favorite")
        if ({{$results->wrongQuestions[$i]->isFavorite}}==0)
        {
            nonFavorite.classList.remove('hidden')
        }
        if ({{$results->wrongQuestions[$i]->isFavorite}}==1)
        {
            Favorite.classList.remove('hidden')
        }
        @endfor
    }

    function addFavorite(id) {
        element = document.getElementsByName("number")
        questionId = element[id].querySelector("#questionId").textContent
        let route = "{{route('questionFavoriteAdd',0)}}";
        route = route.substring(0, route.length - 1) + questionId;
        element[id].querySelector("#favoriteId").textContent = requestFavorite(route)
        element[id].querySelector("#isFavorite").textContent = 1
        element[id].querySelector("#nonFavorite").classList.add('hidden')
        element[id].querySelector("#Favorite").classList.remove('hidden')
    }

    function deleteFavorite(id) {
        element = document.getElementsByName("number")
        favoriteId = x[id].querySelector("#favoriteId").textContent
        let route = "{{route('questionFavoriteAdd',true)}}";
        route = route.substring(0, route.length - 5) + "delete=" + favoriteId
        requestFavorite(route)
        x[id].querySelector("#favoriteId").textContent=0
        x[id].querySelector("#isFavorite").textContent=0
        element[id].querySelector("#nonFavorite").classList.remove('hidden')
        element[id].querySelector("#Favorite").classList.add('hidden')
    }

    function requestFavorite(route) {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", route, false); // false for synchronous request
        xmlHttp.send(null);
        return xmlHttp.responseText;
    }
</script>
</html>
