<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Interview Question</title>
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Interview/InterviewQuestion/styles.css"}}"/>
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
            <div class="question__container">
                <div class="question__top">
                    <div class="question__top-tags">
                        <div class="question__top-tag">
                            {{$question->category}}
                        </div>
                    </div>
                    <div>
                        {{{$question->current}}}/{{$question->amount}}
                        <div id="nonFavorite" class="hidden">
                            <div class="question__top-favourites">
                                <div class="question__top-favourites__icon">
                                    <img src="{{"/common/svg/emptyFavourites.svg"}}" alt="">
                                </div>
                                <button class="question__top-favourites__btn" onclick="addFavorite()">
                                    Добавить в избранное
                                </button>
                            </div>
                        </div>
                        <div id="Favorite" class="hidden">
                            <div class="question__top-favourites">
                                <div class="question__top-favourites__icon">
                                    <img src="{{"/common/svg/fillFavourites.svg"}}" alt="">
                                </div>
                                <button class="question__top-favourites__btn" onclick="deleteFavorite()">
                                    Добавлено в избранное
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="question__body" id="questionText">
                    {{$question->question}}
                </div>
                <div>
                    <button class="recordAnswer" id="startRecording" onclick="startRecording()">Ответить</button>
                    <button class="recordAnswer hidden" id="stopRecording" onclick="stopRecording()">Смотреть ответ
                    </button>
                </div>
                <div class="userAnswerField__block hidden">
                    <textarea class="userAnswerField" id="userAnswerField" value=" " readonly></textarea>
                </div>
                <div id='showRightAnswer' class="hidden">
                    <div class="rightAnswer">
                        {{$question->answer}}
                    </div>
                    <div class="nextQuestionButton">
                        <button class='primary-button' onclick="openAnswerPopup()">
                            <img src="{{"/Pages/Interview/InterviewQuestion/svg/arrow.svg"}}" alt=""/>
                            Перейти далее
                        </button>
                    </div>
                </div>

            </div>


            <div class="modal">
                <div class="edit-popup">
                    <div class="edit-popup__close">
                        <button onclick="closeAnswerPopup()">Закрыть</button>
                    </div>
                    Совпал ли ваш ответ?
                    <div class="show-answer__correct-block__buttons">
                        <a href={{route("interviewAnswerTask","false")}}>
                            <button class="btn-answer">
                                <img src="{{"/Pages/Interview/InterviewQuestion/svg/answerNo.svg"}}" alt="sad"/>
                                <span class="btn-answer__text">Нет</span>
                            </button>
                        </a>
                        <a href={{route("interviewAnswerTask","true")}}>
                            <button class="btn-answer">
                                <img src="{{"/Pages/Interview/InterviewQuestion/svg/answerYes.svg"}}" alt="sad"/>
                                <span class="btn-answer__text">Да</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    favoriteId = {{$question->favoriteId}}
        function speak() {
            setTimeout(function () {
                text = document.getElementById('questionText').textContent
                const message = new SpeechSynthesisUtterance();
                message.lang = "ru-RU";
                message.text = text;
                window.speechSynthesis.speak(message);
            }, 1500)

        }

    const speechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition
    const recognition = new speechRecognition()
    recognition.continuous = true;
    recognition.interimResults = true;
    recognition.lang = 'ru-RU';

    recognition.onerror = ({error}) => {
        recognition.abort()
        recognition.start()
    }
    recognition.onresult = (e) => {
        let i = e.results.length - 1
        if (e.results[i].isFinal) {
            let last_text = e.results[i][0].transcript.trim()
            document.getElementById('userAnswerField').value = last_text;
        }

    }

    function startRecording() {
        document.getElementById('startRecording').classList.add('hidden')
        document.getElementById('stopRecording').classList.remove('hidden')
        document.querySelector('.userAnswerField__block').classList.remove('hidden')
        recognition.start()
    }

    function stopRecording() {
        document.getElementById('showRightAnswer').classList.remove('hidden')
        document.getElementById('stopRecording').classList.add('hidden')
        recognition.stop()
        saveAnswer()
    }

    function saveAnswer() {
        answer = document.getElementById('userAnswerField').value
        route="{{route('recordAnswer')}}"
        data = 'answer=' + answer + '&_token=' + "{{@csrf_token()}}"

        req = requestSaveAnswer(route,data)
        console.log(req)
    }


    function load() {
        changeFavorite({{$question->isFavorite}})
        speak()
    }


    function addFavorite() {
        changeFavorite(1)
        let route = "{{route('questionFavoriteAdd',true)}}";
        route = route.substring(0, route.length - 1) + "{{$question->questionId}}"
        favoriteId = requestFavorite(route)
    }

    function deleteFavorite() {
        changeFavorite(0)
        let route = "{{route('questionFavoriteAdd',true)}}";
        route = route.substring(0, route.length - 5) + "delete=" + favoriteId
        favoriteId = requestFavorite(route)
    }

    function requestSaveAnswer(route,data)
    {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST", route, false);
        xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xmlHttp.send(data)
        result = JSON.parse(xmlHttp.responseText)
        return result;
    }

    function requestFavorite(route) {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", route, false); // false for synchronous request
        xmlHttp.send(null);
        answer = JSON.parse(xmlHttp.responseText)
        return answer;
    }

    function changeFavorite(favorite) {
        const nonFav = document.getElementById('nonFavorite');
        const fav = document.getElementById('Favorite');
        if (favorite === 0) {
            nonFav.classList.remove('hidden')
            fav.classList.add('hidden')
        }
        if (favorite === 1) {
            fav.classList.remove('hidden')
            nonFav.classList.add('hidden')
        }
    }


    let modal = document.querySelector('.modal');
    let editPopup = document.querySelector('.edit-popup');

    function closeAnswerPopup() {
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
    }

    function openAnswerPopup() {
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
    }


    // function watchAnswer() {
    //     document.getElementById('startQuestion').classList.add('hidden');
    //     document.getElementById('endQuestion').classList.remove('hidden');
    // }

    {{--function answerQuestion(answer) {--}}
    {{--    let route = "{{route('interviewQuestion')}}" + "/answer=" + answer;--}}
    {{--    requestAnswer(route)--}}
    {{--    nextQuestion()--}}
    {{--}--}}

    // function nextQuestion() {
    //     document.getElementById('answerQuestion').classList.add('hidden')
    //     document.getElementById("nextQuestion").classList.remove('hidden')
    // }

    // function requestAnswer(route) {
    //     const request = new XMLHttpRequest();
    //     request.open("GET", route, true);
    //     request.onreadystatechange = function () {
    //         if (this.readyState === 4) {
    //             if (this.status === 200) {
    //                 if (this.responseText != null) {
    //                     // favoriteId = JSON.parse(this.responseText)
    //                 } else alert("Данные не получены");
    //             } else alert("Ошибка" + this.statusText)
    //         }
    //     }
    //     request.send(null)
    // }


</script>
</html>
