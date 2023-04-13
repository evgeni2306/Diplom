<div class="header">
    <div class="header__container">
        <nav class="header__menu">
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
                    <a href={{route('getProfessionsForKnowledgeBase')}}>
                        <div class="linkItem">
                            Избранное
                        </div>
                    </a>
                </li>

                <li class="menu__item_mobile">
                    <a href={{route('interviewDirection')}}>
                        <img class="sectionIcon" src="{{"/Pages/Components/Header/svg/simulation.svg"}}" alt="prjevt">
                    </a>
                </li>
                <li class="menu__item_mobile">
                    <a href={{route('getProfessionsForKnowledgeBase')}}>
                        <img class="sectionIcon" src="{{"/Pages/Components/Header/svg/knowledgeBase.svg"}}"
                             alt="prjevt">
                    </a>
                </li>
                <li class="menu__item_mobile">
                    <a href={{route('getProfessionsForKnowledgeBase')}}>
                        <img class="sectionIcon" src="{{"/Pages/Components/Header/svg/favourite.svg"}}" alt="prjevt">
                    </a>
                </li>
            </ul>
        </nav>

        <nav class="user-menu">
            <ul class="user-menu__list">

                <li class="user-name">
                    <img class="avatar" src="{{"/Pages/Components/Header/svg/avatar.svg"}}" alt="user">
                    <a href="#" class="user-menu__link" tabindex="1">UserName</a><span class="menu__arrow"></span>
                    <div class="sub-menu__list">

                        <div class="sub-menu__link">
                            <a class="menuHref" href="{{route('expansionContent')}}"><img
                                    src="{{"/Pages/Components/Header/svg/contentExpansion.svg"}}">Система расширения
                                контента</a>
                        </div>
                        <div class="sub-menu__link">
                            <a class="menuHref" href="{{route('StatisticList')}}"><img
                                    src="{{"/Pages/Components/Header/svg/statistic.svg"}}">Статистика</a>
                        </div>
                        <div class="sub-menu__link">
                            <a class="menuHref" href="{{route('logout')}}"><img
                                    src="{{"/Pages/Components/Header/svg/logout.svg"}}">Выйти</a>
                        </div>

                    </div>
                </li>
            </ul>
                <button class="user-menu-mobile-button" onclick="test()"><img
                        src="{{"/Pages/Components/Header/svg/threeBars.svg"}}"></img></button>
        </nav>

        <div class="user-menu-mobile">
            <div class="user-menu-mobile-popup">
                <div class="user-menu-mobile-close">
                    <button onclick="closeAnswerPopup()">Закрыть</button>
                </div>
                prjvet
                <ul class="sub-menu__list">
                    <li><a href="{{route('expansionContent')}}" class="sub-menu__link">СРК</a></li>
                    <li><a href="{{route('StatisticList')}}" class="sub-menu__link">Статистика</a></li>
                    <li><a href="{{route('logout')}}" class="sub-menu__link">Выйти</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--------------MENU-------------------->
<script src="{{"/Pages/Components/Header/header.js"}}"></script>
<!--------------MENU-------------------->
