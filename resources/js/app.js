require('./bootstrap');
require('./Components/Feedback');


document.addEventListener('DOMContentLoaded', () => {
    const burger = document.getElementById('nav-burger')
    burger.addEventListener('click', () => {
        const menu = document.getElementById('nav-menu')
        menu.classList.toggle('hidden')
    })
})
