<div class="header">
    <div class="header__container">
        <div class="logo">
            <img
                className="logo__icon"
                src="/common/svg/logo.svg"
                alt="logo"
            />
            <span class="logo__name">JobInterview</span>
        </div>
        <nav class="header__menu menu">
            <ul class="menu__list">

                <li class="menu__item">
                    <a href={{route('interviewDirection')}}>
                        <div class="linkItem" >
                            Тренировочное собеседование
                        </div>
                    </a>
                </li>
                <li class="menu__item">
                    <a href={{route('getProfessionsForKnowledgeBase')}}>
                        <div class="linkItem" >
                            База знаний
                        </div>
                    </a>
                </li>
                <li class="menu__item">
                    <a href={{route('expansionContent')}}>
                        <div class="linkItem" >
                            СРК
                        </div>
                    </a>
                </li>

            </ul>
        </nav>
        <nav class="header__user">
{{--            {/*<img*/}--}}
{{--            {/*    className="header__user-img"*/}--}}
{{--            {/*    src="/img/user.png"*/}--}}
{{--            {/*    alt="user"*/}--}}
{{--            {/*/>*/}--}}
{{--            {/*<span className="header__user-arrow"></span>*/}--}}
        </nav>
    </div>
</div>
