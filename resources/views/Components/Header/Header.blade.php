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
                        <div class="linkItem">
                            Тренировочное собеседование
                        </div>
                    </a>
                </li>
                <li class="menu__item">
                    <a href={{route('getProfessionsForKnowledgeBase')}}>
                        <div class="linkItem">
                            База знаний
                        </div>
                    </a>
                </li>
                <li class="menu__item">
                    <a href={{route('expansionContent')}}>
                        <div class="linkItem">
                            СРК
                        </div>
                    </a>
                </li>

            </ul>
        </nav>
        <nav class="user-menu">
            <ul class="user-menu__list">
                <li class="user-name">
                    <img class="avatar" src="{{"/Pages/Interview/InterviewPreview/svg/favourites.svg"}}" alt="user">
                    <a href="#" class="user-menu__link" tabindex="1"></a><span class="menu__arrow"></span>
                    <ul class="sub-menu__list">

                        <li><a href="" class="sub-menu__link">Мой профиль</a>
                        </li>
                        <li><a href="" class="sub-menu__link">Поиск</a>
                        </li>
                        <li><a href="" class="sub-menu__link">Настройки</a>
                        </li>
                        <li><a href="" class="sub-menu__link">Выйти</a></li>


                        {{--                        <li><a href="" class="sub-menu__link"><img src="/PageMap/img/user/01.svg" alt="">Мой профиль</a></li>--}}
                        {{--                        <li><a href="" class="sub-menu__link"><img src="/PageMap/img/icons/search-icon.svg" alt="">Поиск</a></li>--}}
                        {{--                        <li><a href="" class="sub-menu__link"><img src="/PageMap/img/user/02.svg" alt="">Настройки</a></li>--}}
                        {{--                        <li><a href="" class="sub-menu__link"><img src="/PageMap/img/user/03.svg" alt="">Выйти</a></li>--}}

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!--------------MENU-------------------->
<script src="{{"/Pages/Components/Header/header.js"}}"></script>
<!--------------MENU-------------------->
