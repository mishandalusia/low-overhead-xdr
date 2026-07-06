const themeSwitch = document.getElementById("themeSwitch");

function toggleThemeSwitch() {
    if (themeSwitch.checked) {
        document.body.classList.add("dark");
        localStorage.setItem("theme", "dark");
    } else {
        document.body.classList.remove("dark");
        localStorage.setItem("theme", "light");
    }
}

window.onload = () => {
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark");

        if (themeSwitch) {
            themeSwitch.checked = true;
        }
    }
};
const notificationMenu = document.getElementById("notificationMenu");

function toggleNotificationMenu() {
    if (notificationMenu) {
        notificationMenu.classList.toggle("show");
    }
}

document.addEventListener("click", function (event) {
    const notificationWrapper = document.querySelector(".notification-wrapper");

    if (
        notificationWrapper &&
        notificationMenu &&
        !notificationWrapper.contains(event.target)
    ) {
        notificationMenu.classList.remove("show");
    }
});
window.addEventListener("load", () => {
    document.body.classList.add("dashboard-enter");

    setTimeout(() => {
        document.body.classList.remove("dashboard-enter");
    }, 1800);
});
const sidebar = document.getElementById("sidebar");

sidebar.addEventListener("mouseenter", () => {
    sidebar.classList.remove("collapsed");
});

sidebar.addEventListener("mouseleave", () => {
    sidebar.classList.add("collapsed");
});