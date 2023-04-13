let menuArrows = document.querySelectorAll('.menu__arrow');
if (menuArrows.length > 0) {
    for (let i = 0; i < menuArrows.length; i++) {
        const menuArrow = menuArrows[i];
        document.querySelector('.user-name').addEventListener("click", function (e) {
            menuArrow.parentElement.classList.toggle('active__arrow');
        });
    }
}

let userMenuMobile = document.querySelector('.user-menu-mobile');
let userMenuMobilePopup = document.querySelector('.user-menu-mobile-popup');

function closeAnswerPopup() {
    userMenuMobile.classList.toggle('user-menu-mobile-open');
    userMenuMobilePopup.classList.toggle('user-menu-mobile-open');
}

function openAnswerPopup() {
    userMenuMobile.classList.toggle('user-menu-mobile-open');
    userMenuMobilePopup.classList.toggle('user-menu-mobile-open');
}

function test() {
    openAnswerPopup()
}
