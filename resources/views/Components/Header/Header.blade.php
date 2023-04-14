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
                    <img class="avatar" src="{{"/Pages/Components/Header/svg/avatarWhite.svg"}}" alt="user">
                    <a href="#" class="user-menu__link" tabindex="1">UserName</a><span class="menu__arrow"></span>
                    <div class="sub-menu__list">
                        <div class="sub-menu__link">
                            <a class="menuHref" href="{{route('expansionContent')}}"><img
                                    src="{{"/Pages/Components/Header/svg/contentExpansion.svg"}}" alt="">Система
                                расширения
                                контента</a>
                        </div>
                        <div class="sub-menu__link">
                            <a class="menuHref" href="{{route('StatisticList')}}"><img
                                    src="{{"/Pages/Components/Header/svg/statistic.svg"}}" alt="">Статистика</a>
                        </div>
                        <div class="sub-menu__link">
                            <a class="menuHref" href="{{route('logout')}}"><img
                                    src="{{"/Pages/Components/Header/svg/logout.svg"}}" alt="">Выйти</a>
                        </div>

                    </div>
                </li>
            </ul>
            <button class="user-menu-mobile-button" onclick="test()"><img
                    src="{{"/Pages/Components/Header/svg/threeBars.svg"}}" alt=""></button>
        </nav>

        <div class="user-menu-mobile">
            <div class="user-menu-mobile-popup">
                <div class="mobile-high-menu">
                    <div class="mobile-close-sector">
                        <button class="mobile-close-button" onclick="closeAnswerPopup()"><img
                                src="{{"/Pages/Components/Header/svg/cross.svg"}}" alt=""></button>
                    </div>
                    <div class="mobile-name-sector">
                        <div class="mobile-avatar">
                            <img class="avatar" src="{{"/Pages/Components/Header/svg/avatarBlack.svg"}}" alt="user">
                        </div>
                        <div class="mobile-name">userName</div>
                    </div>
                </div>
                <div class="mobile-low-menu">
                    <div class="mobile-sub-menu-list">
                        <div class="mobile-sub-menu-link">
                            <a class="menuHref" href="{{route('expansionContent')}}"><img
                                    src="{{"/Pages/Components/Header/svg/contentExpansion.svg"}}" alt="">Система
                                расширения
                                контента</a>
                        </div>
                        <div class="mobile-sub-menu-link">
                            <a class="menuHref" href="{{route('StatisticList')}}"><img
                                    src="{{"/Pages/Components/Header/svg/statistic.svg"}}" alt="">Статистика</a>
                        </div>
                        <div class="mobile-sub-menu-link">
                            <a class="menuHref" href="{{route('logout')}}"><img
                                    src="{{"/Pages/Components/Header/svg/logout.svg"}}" alt="">Выйти</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!--------------MENU-------------------->
<script src="{{"/Pages/Components/Header/header.js"}}"></script>
<!--------------MENU-------------------->
