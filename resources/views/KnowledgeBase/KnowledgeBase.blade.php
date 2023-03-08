<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Knowledge Base</title>
    <link rel="stylesheet" href={{"/common/css/base.css"}}>
    <link rel="stylesheet" href={{"/Pages/Components/Header/styles.css"}}/>
    <link rel="stylesheet" href={{"/Pages/KnowledgeBase/styles.css"}}/>
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
                <input class="" required="true" list="brow" value="" id="category"
                       placeholder="Выберите категорию" onchange="changeProf()">
                <datalist class="search-box" id="brow">
                    @foreach($professions as $item)
                        <option value="{{$item->name}}">
                    @endforeach
                </datalist>
            </div>
        </div>
        <div class="knowledge-base__questions" id = "questionBox">

            {{--            <div class="knowledge-base__question">--}}
            {{--                <div class="knowledge-base__question-top">--}}
            {{--                    <div class="knowledge-base__question-top-tag">--}}
            {{--                        {{$question.category}}--}}
            {{--                    </div>--}}
            {{--                    <div class="knowledge-base__question-top-favourites">--}}
            {{--                        <button class="knowledge-base__question-top-favourites__btn">--}}
            {{--                        <div class="knowledge-base__question-top-favourites__icon">--}}
            {{--                            <img src="{{"/common/svg/emptyFavourites.svg"}}" alt="favourites" width="16px" height="15px"/>--}}
            {{--                        </div>--}}
            {{--                        </button>--}}
            {{--                    </div>--}}
            {{--                    <div class="knowledge-base__question-top-favourites">--}}
            {{--                        <button class="knowledge-base__question-top-favourites__btn">--}}
            {{--                        <div class="knowledge-base__question-top-favourites__icon">--}}
            {{--                            <img src="{{"/common/svg/fillFavourites.svg"}}" alt="favourites" width="16px" height="15px"/>--}}
            {{--                        </div>--}}
            {{--                        </button>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="knowledge-base__question__body">--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>
</div>
</div>
</body>
<script>

    function changeProf() {

        category = document.getElementById('category').value;
        route = "{{route('getQuestionsForKnowledgeBase')}}"
        item = 'profName=' + category+'&_token='+"{{@csrf_token()}}"
        questions = request(route, category)
        viewQuestions(questions)

    }
    function viewQuestions(questions){
        questionBox = document.getElementById('questionBox')
        for(i =0;  i < questions.length; i++){
            elem = divBuilder(questions[i])
            op = document.createElement('div')
            op.className="knowledge-base__wrapper"
            op.innerHTML = elem
            questionBox.append(op)
        }
    }
    function divBuilder(question){
        element = '<div class="knowledge-base__question">'+
        '<div class="knowledge-base__question-top">'+
        '<div class="knowledge-base__question-top-tag">'+
        question.category +
        '</div>'+
        '</div>'+
        '<div class="knowledge-base__question__body">'+
            question.question
        '</div>'+
        '</div>'
        return element
    }

    function request(route, category) {
        item = 'profName=' + category+'&_token='+"{{@csrf_token()}}"
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST", route, false);
        xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xmlHttp.send(item)
        answer = JSON.parse(xmlHttp.responseText)
        return answer;
    }
</script>
</html>
