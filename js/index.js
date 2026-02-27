const menuBut = document.querySelector('.js-nav-menu-but');
const darkModeBut = document.querySelector('.js-dark-mode-but');
const logoutBut = document.querySelector('.js-logout-but');

menuBut.addEventListener("click", () => {
    const blackScreen = document.querySelector('.blackScreen');
    const menu = document.querySelector('.menu');

    if (logoutBut) logoutBut.innerHTML = "Logout";

    toggleAnimation(blackScreen, 'off', 'on');
    toggleAnimation(menu, 'closed', 'open')
})

if (logoutBut) logoutBut.addEventListener("click", () => {
    if (logoutBut.innerHTML != "Are you sure?") logoutBut.innerHTML = "Are you sure?"
    else logOut(); 
});

const logOut = async () => {
    await fetch('./includes/logout.inc.php', {
        method: "POST"
    }).then(res => location.replace(res.url))
    .catch(error => console.log ('something went wrong: ', error))
}

const toggleAnimation = (element, currentState, newState) => {
    element.classList.toggle(currentState);
    element.classList.toggle(newState);
}