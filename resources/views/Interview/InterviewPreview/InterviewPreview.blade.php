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
                <h2 class="preview-card__subtitle">
                    Тренировочное собеседование
                </h2>
            </div>
            <div class="preview-card__main">
                <div class="preview-card__infoblock infoblock">
                    <div class="infoblock__icon">
                        <img
                            src="/Pages/Interview/InterviewPreview/svg/question.svg"
                            alt="question"
                        />
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
                        <img
                            src="/Pages/Interview/InterviewPreview/svg/cloud.svg"
                            alt="cloud"
                        />
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
                        <img
                            src="/Pages/Interview/InterviewPreview/svg/check.svg"
                            alt="check"
                        />
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
                        <img
                            src="/Pages/Interview/InterviewPreview/svg/favourites.svg"
                            alt="favourites"
                        />
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
                    <a class="primary-button"   href={{route('interviewStart',$previewPageInfo->id)}}>
                        <svg
                            width="13"
                            height="15"
                            viewBox="0 0 13 15"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M1.5 12.0439V2.07727C1.5 1.28701 2.37344 0.809004 3.03905 1.23499L11.3446 6.55052C11.9808 6.95771 11.9532 7.89622 11.2941 8.2653L2.9886 12.9164C2.32202 13.2897 1.5 12.8079 1.5 12.0439Z"
                                stroke="white"
                                strokeWidth="2"
                            />
                        </svg>
                        Начать собеседование
                    </a>
                </div>
            </div>
        </div>
{{--        <div class="preview-recomendation">--}}
{{--            <img src="/Pages/Interview/InterviewPreview/svg/book.svg" alt="book"/>--}}
{{--            <div class="preview-recomendation__text-cont">--}}
{{--                <div class="preview-recomendation__text">--}}
{{--                    Перед началом собеседования рекомендуем ознакомиться--}}
{{--                    с --}}
{{--                    <Link class="preview-recomendation__textlink">--}}
{{--                    гайдом по подготовке.--}}
{{--                    </Link>--}}
{{--                    В нем собрана информация о том, какие бывают этапы--}}
{{--                    отбора в различных компаниях, для чего они нужны,--}}
{{--                    с кем предстоит пообщаться, а также много--}}
{{--                    практических советов.--}}
{{--                </div>--}}
{{--                <Link class="preview-recomendation__link">--}}
{{--                Читать гайд--}}
{{--                <div class="preview-recomendation__link-arrow"></div>--}}
{{--                </Link>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
</body>
</html>
