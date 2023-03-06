<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Interview Question</title>
    <link rel="stylesheet" href={{"/common/css/base.css"}}>
    <link rel="stylesheet" href={{"/Pages/Components/Header/styles.css"}}/>
    <link rel="stylesheet" href={{"/Pages/Interview/InterviewQuestion/styles.css"}}/>
</head>
<body onLoad="load()">
<div className="question-page">
    <!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->

    <div class="question-page__header">
        <div class="question-page__header-title">
            {{$question->profName}}
        </div>
        <div class="question-page__header-progress"></div>
        <a href={{route('interviewInterrupt')}}>
            <div class="question-page__header-btn">
                <a href="{{route('interviewInterrupt')}}" class="secondary-button">
                    Завершить
                </a>
            </div>
        </a>

    </div>
    <div id="startQuestion">
        <div class="question-page__container">
            <div class="question-page__question-block question">
                <img class="question__avatar" src="{{"/Pages/Interview/InterviewQuestion/png/user.png"}}"
                     alt="interviewer"/>
                <div class="question__container">
                    <div class="question__top">
                        <div class="question__top-tags">
                            <div class="question__top-tag">
                                {{$question->category}}
                            </div>
                            {{{$question->current}}}/{{$question->amount}}
                        </div>

                        <div id="nonFavorite" class="hidden">
                            <div class="question__top-favourites">
                                <div class="question__top-favourites__icon">
                                    <img src="{{"/Pages/Interview/InterviewQuestion/svg/emptyFavourites.svg"}}" alt=""/>
                                </div>
                                <button class="question__top-favourites__btn" onclick="addFavorite()">
                                    Добавить в избранное
                                </button>
                            </div>
                        </div>
                        <div id="Favorite" class="hidden">
                            <div class="question__top-favourites">
                                <div class="question__top-favourites__icon">
                                    <img src="{{"/Pages/Interview/InterviewQuestion/svg/fillFavourites.svg"}}" alt=""/>
                                </div>
                                <button class="question__top-favourites__btn" onclick="deleteFavorite()">
                                    Добавлено в избранное
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="question__body" id="questionText">
                        {{$question->question}}
                    </div>
                </div>
            </div>
            <div class="question-page__answer-block answer">
                <div class="answer__container">
                    <button class="primary-button" onclick="watchAnswer()">

                        <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.257 6.962C20.731 7.582 20.731 8.419 20.257 9.038C18.764 10.987 15.182 15 11 15C6.81801 15 3.23601 10.987 1.74301 9.038C1.51239 8.74113 1.38721 8.37592 1.38721 8C1.38721 7.62408 1.51239 7.25887 1.74301 6.962C3.23601 5.013 6.81801 1 11 1C15.182 1 18.764 5.013 20.257 6.962V6.962Z"
                                stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            />
                            <path
                                d="M11 11C12.6569 11 14 9.65685 14 8C14 6.34315 12.6569 5 11 5C9.34315 5 8 6.34315 8 8C8 9.65685 9.34315 11 11 11Z"
                                stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            />
                        </svg>
                        Смотреть правильный ответ
                    </button>

                </div>
                <img class="answer__avatar" src="{{"/Pages/Interview/InterviewQuestion/png/user.png"}}"
                     alt="interviewer"/>
            </div>
        </div>
    </div>


    <div id="endQuestion" class='hidden'>
        <div class="question-page__container">
            <div class="show-answer">
                <div class="question__top">
                    <div class="question__top-tags">
                        <div class="question__top-tag">
                            {{$question->category}}
                        </div>
                        {{{$question->current}}}/{{$question->amount}}
                    </div>

                    <div id="nonFavorite2" class="hidden">
                        <div class="question__top-favourites">
                            <div class="question__top-favourites__icon">
                                <img src="{{"/Pages/Interview/InterviewQuestion/svg/emptyFavourites.svg"}}" alt=""/>
                            </div>
                            <button class="question__top-favourites__btn" onclick="addFavorite()">
                                Добавить в избранное
                            </button>
                        </div>
                    </div>
                    <div id="Favorite2" class="hidden">
                        <div class="question__top-favourites">
                            <div class="question__top-favourites__icon">
                                <img src="{{"/Pages/Interview/InterviewQuestion/svg/fillFavourites.svg"}}" alt=""/>
                            </div>
                            <button class="question__top-favourites__btn" onclick="deleteFavorite()">
                                Добавлено в избранное
                            </button>
                        </div>
                    </div>

                </div>
                <div class="question__body">
                    {{$question->question}}
                </div>
                <div class="show-answer__answer-text">
                    {{$question->answer}}
                </div>
                <div id="nextQuestion" class='hidden'>
                    <div class="show-answer__correct-block">
                        <div class="show-answer__correct-block__title">
                            Готовы к следующему вопросу?
                        </div>
                        <div class="show-answer__correct-block__buttons">
                            <a href={{route("interviewQuestion")}}>
                                <button class='primary-button'>
                                    <img src="{{"/Pages/Interview/InterviewQuestion/svg/arrow.svg"}}" alt=""/>
                                    Перейти далее
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <div id="answerQuestion">
                    <div class="show-answer__correct-block">
                        <div class="show-answer__correct-block__title">
                            Ваш ответ совпал?
                        </div>
                        <div class="show-answer__correct-block__buttons">
                            <button class="btn-answer" onclick="answerQuestion(false)">
                                <img src="{{"/Pages/Interview/InterviewQuestion/svg/answerNo.svg"}}" alt="sad"/>
                                <span class="btn-answer__text">Нет</span>
                            </button>
                            <button class="btn-answer" onclick="answerQuestion(true)">
                                <img src="{{"/Pages/Interview/InterviewQuestion/svg/answerYes.svg"}}" alt="sad"/>
                                <span class="btn-answer__text">Да</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>

<script>
    function speak() {
        setTimeout(function () {
            text = document.getElementById('questionText').textContent
            const message = new SpeechSynthesisUtterance();
            message.lang = "ru-RU";
            message.text = text;

            window.speechSynthesis.speak(message);
        }, 1500)

    }

    favoriteId = {{$question->favoriteId}}


        function load() {
            changeFavorite({{$question->isFavorite}})
            speak()
        }


    function addFavorite() {
        changeFavorite(1)
        let route = "{{route('questionFavoriteAdd',true)}}";
        route = route.substring(0, route.length - 1) + "{{$question->questionId}}"
        requestFavorite(route);
    }

    function deleteFavorite() {
        changeFavorite(0)
        let route = "{{route('questionFavoriteAdd',true)}}";
        route = route.substring(0, route.length - 5) + "delete=" + favoriteId
        requestFavorite(route)
    }

    function requestFavorite(route) {
        const request = new XMLHttpRequest();
        request.open("GET", route, true);
        request.onreadystatechange = function () {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    if (this.responseText != null) {
                        favoriteId = JSON.parse(this.responseText)
                    } else alert("Данные не получены");
                } else alert("Ошибка" + this.statusText)
            }
        }
        request.send(null)
    }

    function changeFavorite(favorite) {
        const nonFav = document.getElementById('nonFavorite');
        const fav = document.getElementById('Favorite');
        const nonFav2 = document.getElementById('nonFavorite2');
        const fav2 = document.getElementById('Favorite2');
        if (favorite === 0) {
            nonFav.classList.remove('hidden')
            fav.classList.add('hidden')
            nonFav2.classList.remove('hidden')
            fav2.classList.add('hidden')
        }
        if (favorite === 1) {
            fav.classList.remove('hidden')
            nonFav.classList.add('hidden')
            fav2.classList.remove('hidden')
            nonFav2.classList.add('hidden')
        }
    }

    function watchAnswer() {
        document.getElementById('startQuestion').classList.add('hidden');
        document.getElementById('endQuestion').classList.remove('hidden');
    }

    function answerQuestion(answer) {
        let route = "{{route('interviewQuestion')}}" + "/answer=" + answer;
        requestAnswer(route)
        nextQuestion()
    }

    function nextQuestion() {
        document.getElementById('answerQuestion').classList.add('hidden')
        document.getElementById("nextQuestion").classList.remove('hidden')
    }

    function requestAnswer(route) {
        const request = new XMLHttpRequest();
        request.open("GET", route, true);
        request.onreadystatechange = function () {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    if (this.responseText != null) {
                        // favoriteId = JSON.parse(this.responseText)
                    } else alert("Данные не получены");
                } else alert("Ошибка" + this.statusText)
            }
        }
        request.send(null)
    }


</script>
</html>
