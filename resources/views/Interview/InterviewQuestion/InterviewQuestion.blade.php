<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Interview/InterviewQuestion/styles.css"}}"/>
    <title> {{$question->question}}</title>
</head>
<body onLoad="load()">
<div className="question-page">
    <!--------------HEADER-------------------->
    @include('Components.Header.Header')
    <!--------------/HEADER-------------------->
    <div class="container">
        <div class="questionHeader">
            <div class="questionHeaderTitle">
                {{$question->profName}}
            </div>
                <a href="{{route('interviewInterrupt')}}" class="interruptButton">
                    Завершить
                </a>
        </div>
        <div class="questionContainer">
            <div class="questionTop">
                <div class="questionTopTag">
                    <div class="questionTag">
                        {{$question->category}}
                    </div>
                </div>
                <div class="questionTopNumber">
                    <div class="questionNumber">
                        {{{$question->current}}}/{{$question->amount}}
                    </div>

                </div>
                <div class="questionFavoriteZone">
                    <div id="nonFavorite" class="hidden">
                        <div class="questionFavorite">
                            <div class="questionFavoriteIcon">
                                <img src="{{"/common/svg/emptyFavourites.svg"}}" alt="">
                            </div>
                            <button class="questionFavoriteButton" onclick="addFavorite()">
                                Добавить в избранное
                            </button>
                        </div>
                    </div>
                    <div id="Favorite" class="hidden">
                        <div class="questionFavorite">
                            <div class="questionFavoriteIcon">
                                <img src="{{"/common/svg/fillFavourites.svg"}}" alt="">
                            </div>
                            <button class="questionFavoriteButton" onclick="deleteFavorite()">
                                Добавлено в избранное
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="questionBody">
                <div class="questionText" id="questionText">
                    {{$question->question}}
                </div>
                <div class="questionAnswerButtons">
                    <button class="recordAnswer" id="startRecording" onclick="startRecording()">Ответить</button>
                    <button class="recordAnswer hidden" id="stopRecording" onclick="stopRecording()">Смотреть ответ
                    </button>
                </div>
                <div class="questionUserAnswerField hidden" id="questionUserAnswerField" >
                    <textarea class="userAnswerField" id="userAnswerField" readonly></textarea>
                </div>

                <div id='showRightAnswer' class="hidden">
                    <div class="questionAnswerField">
                        {{$question->answer}}
                    </div>
                    <button class='nextQuestionButton' onclick="openAnswerPopup()">
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
</body>

<script>
    favoriteId = {{$question->favoriteId}};

    function load() {
        changeFavorite({{$question->isFavorite}})
        speak()
    }

    function speak() {
        setTimeout(function () {
            const text = document.getElementById('questionText').textContent;
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
            document.getElementById('userAnswerField').value = e.results[i][0].transcript.trim();
        }

    }

    function startRecording() {
        document.getElementById('startRecording').classList.add('hidden')
        document.getElementById('stopRecording').classList.remove('hidden')
        document.querySelector('#questionUserAnswerField').classList.remove('hidden')
        recognition.start()
    }

    function stopRecording() {
        document.getElementById('showRightAnswer').classList.remove('hidden')
        document.getElementById('stopRecording').classList.add('hidden')
        recognition.stop()
        saveAnswer()
    }

    function saveAnswer() {
        const answer = document.getElementById('userAnswerField').value;
        const route = "{{route('recordAnswer')}}";
        const data = 'answer=' + answer + '&_token=' + "{{@csrf_token()}}";
        requestSaveAnswer(route, data);
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

    function requestSaveAnswer(route, data) {
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST", route, false);
        xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xmlHttp.send(data)
        return JSON.parse(xmlHttp.responseText)
    }

    function requestFavorite(route) {
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", route, false); // false for synchronous request
        xmlHttp.send(null);
        return JSON.parse(xmlHttp.responseText)
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

</script>
</html>
