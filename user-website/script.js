document.addEventListener("DOMContentLoaded", function () {
    // Profile dropdown toggle
    const profileBtn = document.querySelector(".profile-btn");
    const profileMenu = document.querySelector(".profile-dropdown .submenu");

    if (profileBtn && profileMenu) {
        profileBtn.addEventListener("click", function (event) {
            event.stopPropagation(); // Prevents immediate closing
            profileMenu.classList.toggle("active");
        });

        document.addEventListener("click", function (event) {
            if (!profileBtn.contains(event.target) && !profileMenu.contains(event.target)) {
                profileMenu.classList.remove("active");
            }
        });
    }

    // Request dropdown toggle
    const requestItem = document.querySelector(".request-item > a");
    const requestMenu = document.querySelector(".request-item .submenu");

    if (requestItem && requestMenu) {
        requestItem.addEventListener("click", function (event) {
            event.preventDefault(); // Prevents default link behavior
            event.stopPropagation();
            requestMenu.classList.toggle("active");
        });

        document.addEventListener("click", function (event) {
            if (!requestItem.contains(event.target) && !requestMenu.contains(event.target)) {
                requestMenu.classList.remove("active");
            }
        });
    }
});
