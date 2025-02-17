//nav toggle and color change on scroll
const nav = document.querySelector(".main-nav");
const toggleNav = () => {
    if (nav.dataset.state == "closed") {
        nav.dataset.state = "open";
    } else {
        nav.dataset.state = "closed";
    }
}

const navHeight = nav.getBoundingClientRect().height;
window.onscroll = function () {
    if (window.pageYOffset > navHeight) {
        nav.dataset.scrolled = "true";
    } else {
        nav.dataset.scrolled = "false";
    }
}
