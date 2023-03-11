<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Interview Preview</title>
    <link rel="stylesheet" href="{{"/common/css/base.css"}}">
    <link rel="stylesheet" href="{{"/Pages/Components/Header/styles.css"}}"/>
    <link rel="stylesheet" href="{{"/Pages/Interview/InterviewPreview/styles.css"}}"/>

</head>
<body>
<!--------------HEADER-------------------->
@include('Components.Header.Header')
<!--------------/HEADER-------------------->
<div className="preview">
    <div class="preview__container">
        <div class="preview-card">
            <div class="preview-card__top">
                <h1 class="preview-card__title">
                    {{$previewPageInfo->name}}
                </h1>
                <h2 class="preview-card__main">
                    Тренировочное собеседование
                </h2>
            </div>
            <div class="preview-card__main">
                <div class="preview-card__infoblock infoblock">
                    <div class="infoblock__icon">
                        <img src="{{"/Pages/Interview/InterviewPreview/svg/question.svg"}}" alt="question"/>
                    </div>
                    <div class="infoblock__text">
                                <span class="infoblock__title">
                                    {{$previewPageInfo->count}} вопросов
                                </span>
                        <div class="infoblock__subtitle">
                            Тренировочное собеседование состоит из
                            вопросов персонального, ситуационного и
                            технического характера.
                        </div>
                    </div>
                </div>
                <div class="preview-card__infoblock infoblock">
                    <div class="infoblock__icon">
                        <img src="{{"/Pages/Interview/InterviewPreview/svg/cloud.svg"}}" alt="cloud"/>
                    </div>
                    <div class="infoblock__text">
                                <span class="infoblock__title">
                                    Продумывайте и проговаривайте ответы
                                </span>
                        <div class="infoblock__subtitle">
                            Рекомендуем практиковаться в ответах
                            на вопросы, произнося их вслух. Во время
                            решения задач также озвучивайте свои мысли
                            и ход решения.
                        </div>
                    </div>
                </div>
                <div class="preview-card__infoblock infoblock">
                    <div class="infoblock__icon">
                        <img src="{{"/Pages/Interview/InterviewPreview/svg/check.svg"}}" alt="check"/>
                    </div>
                    <div class="infoblock__text">
                                <span class="infoblock__title">
                                    Проверяйте себя
                                </span>
                        <div class="infoblock__subtitle">
                            Сравнивайте свой ответ с предложенным, нажав
                            на кнопку «Смотреть ответ».
                        </div>
                    </div>
                </div>
                <div class="preview-card__infoblock infoblock">
                    <div class="infoblock__icon">
                        <img src="{{"/Pages/Interview/InterviewPreview/svg/favourites.svg"}}" alt="favourites"/>
                    </div>
                    <div class="infoblock__text">
                                <span class="infoblock__title">
                                    Сохраняйте вопросы в избранное
                                </span>
                        <div class="infoblock__subtitle">
                            Сложные вопросы добавляйте в избранное,
                            чтобы вернуться к ним позже еще раз.
                        </div>
                    </div>
                </div>
                <div class="preview-card__start">
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
