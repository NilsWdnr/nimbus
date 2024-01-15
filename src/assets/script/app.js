'use strict';

(() => {

// === DOM & VARS ===
const DOM = {};
DOM.mobileMenuToggle = document.querySelector('#mobile-menu-toggle');
DOM.sidebar = document.querySelector('aside#sidebar');

let sidebarVisible = false;

// === INIT =========
const init = () => {
    DOM.mobileMenuToggle.addEventListener('click',toggleSidebar);
}

// === FUNCTIONS ====
const hide_sidebar = () => {
    DOM.sidebar.classList.remove('active');
    sidebarVisible = false;
}

const handleOutsideClick = (event) => {
    if (!DOM.sidebar.contains(event.target) && event.target !== DOM.mobileMenuToggle) {
        hide_sidebar();
    }
}

const toggleSidebar = () => {
    DOM.sidebar.classList.toggle('active');

    if(sidebarVisible){
        hide_sidebar();
    } else {
        document.addEventListener('click', handleOutsideClick);
    }

    sidebarVisible = !sidebarVisible;
}

init();

})();