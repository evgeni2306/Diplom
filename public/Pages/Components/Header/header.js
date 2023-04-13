let menuArrows = document.querySelectorAll('.menu__arrow');
if (menuArrows.length > 0) {
    for (let i = 0; i < menuArrows.length; i++) {
        const menuArrow = menuArrows[i];
        document.querySelector('.user-name').addEventListener("click", function(e) {
            menuArrow.parentElement.classList.toggle('active__arrow');
        });
    }
}

const iconMenu = document.querySelector('.menu__icon');
if (iconMenu) {
    const userMenu = document.querySelector('.user-menu');
    const headerMenu = document.querySelector('.menu');
    iconMenu.addEventListener("click", function(e) {
        document.body.classList.toggle('_lock');
        iconMenu.classList.toggle('active__user-menu');
        userMenu.classList.toggle('active__user-menu');
        headerMenu.classList.toggle('hide');
    });
}

var menuLinks = document.querySelectorAll('.menu__link');
var lastClicked = menuLinks[0];
var viewOnly = false;
var addObject = false;

for (var i = 0; i < menuLinks.length; i++) {
    menuLinks[i].addEventListener('click', function () {
        lastClicked.classList.remove('active-menu');
        this.classList.add('active-menu');

        lastClicked = this;
    });
}



var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

if (isMobile.any()) {
    document.body.classList.add('_mobile');
} else {
    document.body.classList.add('_pc');
}
