document.addEventListener("DOMContentLoaded", function() {
    const profileDropdown = document.querySelector(".profile-dropdown");
    const dropdownMenu = document.querySelector(".dropdown-menu");
    const dropdownIcon = document.querySelector(".dropdown-icon");

    profileDropdown?.addEventListener("click", function() {
        dropdownMenu.classList.toggle("show");
        dropdownIcon.style.transform = dropdownMenu.classList.contains("show") ? "rotate(180deg)" : "rotate(0deg)";
    });

    document.addEventListener("click", function(event) {
        if (!profileDropdown?.contains(event.target)) {
            dropdownMenu.classList.remove("show");
            dropdownIcon.style.transform = "rotate(0deg)";
        }
    });
});
