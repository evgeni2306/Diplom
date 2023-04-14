<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Interview/InterviewPreview/styles.css"}}"/>
    <title>Interview Preview</title>
</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div className="container">
    <div class="preview">
        <div class="preview-card">
            <div class="preview-top">
                <h1 class="preview-title">
                    {{$previewPageInfo->name}}
                </h1>
                <h2 class="preview-title2">
                    Тренировочное собеседование
                </h2>
            </div>
            <div class="preview-body">
                <div class="infoblock">
                    <div class="infoblock-item">
                        <div class="infoblock-icon">
                            <img src="{{"/Pages/Interview/InterviewPreview/svg/question.svg"}}" alt="question"/>
                        </div>
                        <div class="infoblock-text">
                                <span class="infoblock-title">
                                    Количество вопросов: {{$previewPageInfo->count}}
                                </span>
                            <div class="infoblock-subtitle">
                                Тренировочное собеседование включает в себя вопросы по нескольким темам, в рамках
                                выбранной профессии
                            </div>
                        </div>
                    </div>
                    <div class="infoblock-item">
                        <div class="infoblock-icon">
                            <img src="{{"/Pages/Interview/InterviewPreview/svg/brain.svg"}}" alt="cloud"/>
                        </div>
                        <div class="infoblock-text">
                                <span class="infoblock-title">
                                    Продумывайте и проговаривайте ответы
                                </span>
                            <div class="infoblock-subtitle">
                                Проговаривайте свои ответы вслух, система распознает их и сохранит для дальнейшего
                                использования
                            </div>
                        </div>
                    </div>
                    <div class="infoblock-item">
                        <div class="infoblock-icon">
                            <img src="{{"/Pages/Interview/InterviewPreview/svg/checkbox.svg"}}" alt="check"/>
                        </div>
                        <div class="infoblock-text">
                                <span class="infoblock-title">
                                    Проверяйте себя
                                </span>
                            <div class="infoblock-subtitle">
                                Сравнивайте свой ответ с предложенным, нажав
                                на кнопку «Смотреть ответ».
                            </div>
                        </div>
                    </div>
                    <div class="infoblock-item">
                        <div class="infoblock-icon">
                            <img src="{{"/Pages/Interview/InterviewPreview/svg/favourite.svg"}}" alt="favourites"/>
                        </div>
                        <div class="infoblock-text">
                                <span class="infoblock-title">
                                    Сохраняйте вопросы в избранное
                                </span>
                            <div class="infoblock-subtitle">
                                Сложные вопросы добавляйте в избранное,
                                чтобы вернуться к ним позже еще раз.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="preview-start">
                    <a class="primary-button" href={{route('interviewStart',$previewPageInfo->id)}}>
                        <img src="{{"/Pages/Interview/InterviewPreview/svg/arrow.svg"}}" alt="favourites"/>
                        Начать собеседование
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
