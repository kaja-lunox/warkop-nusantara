const searchForm = document.getElementById("search-form");
document.getElementById("search-menu").addEventListener("click", function() {
    if (searchForm.classList.contains("hidden")) {
        searchForm.classList.remove("hidden");
    } else {
        searchForm.classList.add("hidden");
    }
});

const toggleButton = document.getElementById('menu-button');
const sideNav = document.getElementById('sidenav');
const closeMenu = document.getElementById("close-button");

toggleButton.addEventListener('click', () => {
    sideNav.classList.toggle('visible');
    toggleButton.classList.toggle('hidden');
    closeMenu.classList.toggle('hidden');
});

closeMenu.addEventListener('click', () => {
    sideNav.classList.toggle('visible');
    toggleButton.classList.toggle('hidden');
    closeMenu.classList.toggle('hidden');
});





