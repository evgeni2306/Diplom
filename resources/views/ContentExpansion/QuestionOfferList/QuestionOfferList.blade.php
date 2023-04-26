<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/ContentExpansion/QuestionOfferList/styles.css"}}"/>
    <title>Система расширения контента</title>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div class="container">
    <h1 class="container__title">Система расширения контента</h1>
    <p class="container-subtitle">
        <a href="{{route('questionOfferForm')}}" class="container-link">Предложить вопрос для добавления</a>
    </p>
    @if(count($offers)>0)
        @for($i=0; $i<count($offers); $i++)
                <? $item = $offers[$i]; ?>
            <div class="questionBlock" onclick="openPopup({{$i}})" id="{{$i}}">
                <div class="questionBlockTop">
                    <div class="categoryBlock">
                        <div class="category" id="category">{{$item->category->name}}</div>
                    </div>
                    <div class="questionStatusBlock">
                        <div class="hidden" id="statusColor">{{$item->status}}</div>
                        <div id="status" class="status {{$item->status}} ">{{$item->statusName}}</div>
                    </div>
                    <div class="questionActionsBlock">
                        <div class="actions">
                            @if($item->status !="Green")
                            <a class="actionButton" onclick="event.stopPropagation()"
                               href="{{route('questionOfferDelete',$item->id)}}"><img
                                    src="{{"/Pages/ContentExpansion/QuestionOfferList/svg/delete.svg"}}"
                                    alt=""></a>
                            <a class="actionButton" onclick="event.stopPropagation()"
                               href="{{route('questionOfferUpdate',$item->id)}}"><img
                                    src="{{"/Pages/ContentExpansion/QuestionOfferList/svg/edit.svg"}}"
                                    alt=""></a>
                            @endif
                            @if($item->status == "Green")
                                <a class="actionButton" onclick="event.stopPropagation()"
                                   href="{{route('questionOfferVisible',$item->id)}}"><img
                                        src="{{"/Pages/ContentExpansion/QuestionOfferList/svg/closeEye.svg"}}"
                                        alt=""></a>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="questionBlockBody">
                    <div class="question" id="question">{{$item->question}}</div>
                    <div class="hidden" id="answer">{{$item->answer}}</div>
                    <div class="hidden" id="comment">{{$item->comment}}</div>
                </div>
            </div>
        @endfor
    @endif
    @if(count($offers)===0)

        <div class="voidMenu">
            <div class="voidTextMain">Тут будут отображаться предложенные вами вопросы</div>
            <div class="voidTextSecond">Но пока что тут пусто</div>
        </div>
    @endif
</div>
<div class="modal">
    <div class="edit-popup">
        <div class="edit-popup-close">
            <button class="modal-close-button" onclick="closePopup()"><img
                    src="{{"/Pages/KnowledgeBase/svg/cross.svg"}}" alt=""></button>
        </div>
        <div class="modal-question">
            <div class="modal-question-top">
                <div class="modal-question-category">
                    <div id="modalQuestionCategory" class="modal-question-category-text  ">
                        Категория
                    </div>
                </div>
                <div class="modal-question-status Green" id="modalQuestionStatus">
                    На рассмотрении
                </div>
            </div>

            <div class="modal-question-question">
                <div id="modalQuestionText" class="modal-question-question-text ">
                </div>
            </div>
            <div class="modal-question-answer">
                <div id="modalQuestionAnswer" class="modal-question-answer-text">
                </div>
            </div>
            <div class="hidden" id=modal-comment-block>
                <div class="modal-comment-title">
                    Комментарий:
                </div>
                <div class="modal-comment" id="modal-comment"></div>
            </div>
        </div>

    </div>
</div>
</body>
<script>
    let modal = document.querySelector('.modal');
    let editPopup = document.querySelector('.edit-popup');

    function closePopup() {
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
    }

    function openPopup(elementId) {
        const element = document.getElementById(elementId)
        const category = element.querySelector("#category").textContent
        const status = element.querySelector("#status").textContent
        const statusColor = element.querySelector("#statusColor").textContent
        const modalStatus = document.querySelector("#modalQuestionStatus");
        const question = element.querySelector("#question").textContent
        const comment = element.querySelector("#comment").textContent;
        const answer = element.querySelector("#answer").textContent
        const commentBlock = document.querySelector("#modal-comment-block")
        commentBlock.classList.add('hidden')
        if (statusColor === "Red") {
            commentBlock.classList.remove('hidden')
        }

        modalStatus.textContent = status
        modalStatus.classList.remove('Green', 'Red', 'Yellow')
        modalStatus.classList.add(statusColor)
        document.querySelector("#modal-comment").textContent = comment
        document.querySelector("#modalQuestionAnswer").textContent = answer
        document.querySelector("#modalQuestionText").textContent = question
        document.querySelector("#modalQuestionCategory").textContent = category
        modal.classList.toggle('is-open');
        editPopup.classList.toggle('is-open');
    }
</script>
</html>
