document.addEventListener("DOMContentLoaded", function () {
    const profileBtn = document.querySelector(".profile-btn");
    const profileMenu = document.querySelector(".profile-dropdown .submenu");

    if (profileBtn && profileMenu) {
        profileBtn.addEventListener("click", function (event) {
            event.stopPropagation();
            profileMenu.classList.toggle("active");
        });

        document.addEventListener("click", function (event) {
            if (!profileBtn.contains(event.target) && !profileMenu.contains(event.target)) {
                profileMenu.classList.remove("active");
            }
        });
    }

    const requestItem = document.querySelector(".request-section > a");
    const requestMenu = document.querySelector(".request-section .submenu");

    if (requestItem && requestMenu) {
        requestItem.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();
            requestMenu.classList.toggle("active");
        });

        document.addEventListener("click", function (event) {
            if (!requestItem.contains(event.target) && !requestMenu.contains(event.target)) {
                requestMenu.classList.remove("active");
            }
        });
    }

    $(document).ready(function () {
        if ($.fn.DataTable.isDataTable("#manageUsersTable")) {
            $("#manageUsersTable").DataTable().destroy();
        }

        $("#manageUsersTable").DataTable({
            "dom": 't',
            "paging": false,
            "info": false,
            "searching": true,
            "lengthChange": false
        });

        $("#searchBox").on("keyup", function () {
            $("#manageUsersTable").DataTable().search($(this).val()).draw();
        });
    });

    const addUserModal = document.getElementById("addUserModal");
    const addUserBtn = document.getElementById("addUserBtn");
    const closeAddUserBtn = document.querySelector(".modal .close");

    if (addUserModal && addUserBtn && closeAddUserBtn) {
        addUserBtn.addEventListener("click", function () {
            addUserModal.style.display = "block";
        });

        closeAddUserBtn.addEventListener("click", function () {
            addUserModal.style.display = "none";
        });

        window.addEventListener("click", function (event) {
            if (event.target === addUserModal) {
                addUserModal.style.display = "none";
            }
        });
    }

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll(".alert");
    if (alerts.length > 0) {
        setTimeout(() => {
            alerts.forEach(alert => alert.style.display = "none");
        }, 5000);
    }

    // Edit User Modal
    const editModal = document.getElementById("editUserModal");
    const closeEditButton = document.querySelector("#editUserModal .close");

    window.openEditModal = function (id, name, email, username, isAdmin) {
        console.log("Opening Edit Modal for:", id, name, email, isAdmin);

        document.getElementById("edit_user_id").value = id;

        let nameParts = name.trim().split(" ");
        document.getElementById("edit_first_name").value = nameParts[0] || "";
        document.getElementById("edit_last_name").value = nameParts.slice(1).join(" ") || "";

        document.getElementById("edit_email").value = email;
        document.getElementById("edit_username").value = username;
        document.getElementById("edit_role").value = isAdmin == 1 ? "1" : "0";

        toggleLastNameRequirement();

        editModal.style.display = "block";
    };

    function closeEditModal() {
        editModal.style.display = "none";
    }

    if (closeEditButton) {
        closeEditButton.addEventListener("click", function () {
            closeEditModal();
        });

        window.addEventListener("click", function (event) {
            if (event.target === editModal) {
                closeEditModal();
            }
        });
    }

    const editRoleSelect = document.getElementById("edit_role");
    const lastNameInput = document.getElementById("edit_last_name");

    function toggleLastNameRequirement() {
        if (editRoleSelect.value === "1") {
            lastNameInput.removeAttribute("required");
        } else { 
            lastNameInput.setAttribute("required", "required");
        }
    }

    if (editRoleSelect && lastNameInput) {
        editRoleSelect.addEventListener("change", toggleLastNameRequirement);
        toggleLastNameRequirement();
    }

    const deleteModal = document.getElementById("deleteUserModal");
    const closeDeleteButton = document.querySelector("#deleteUserModal .close");

    window.openDeleteModal = function (id) {
        console.log("Opening Delete Modal for:", id);
    
        // Store the user ID in the hidden input field
        document.getElementById("delete_user_id").value = id;
    
        deleteModal.style.display = "block";
    };
    
    function closeDeleteModal() {
        deleteModal.style.display = "none";
    }
    
    if (closeDeleteButton) {
        closeDeleteButton.addEventListener("click", function () {
            closeDeleteModal();
        });
    
        window.addEventListener("click", function (event) {
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        });
    }

    // ------------------ Read More Functionality ------------------

    window.openReadMoreModal = function (reasonText) {
        document.getElementById("fullReasonText").innerText = reasonText;
        document.getElementById("readMoreModal").style.display = "block";
    };

    window.closeReadMoreModal = function () {
        document.getElementById("readMoreModal").style.display = "none";
    };

    window.onclick = function (event) {
        let modal = document.getElementById("readMoreModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

    // Attach Read More Button inside the Request View Modal
    window.openViewRequestModal = function (reason) {
        document.getElementById("view_reason").value = reason;
        let readMoreBtn = document.getElementById("readMoreBtn");

        if (reason.length > 40) {
            readMoreBtn.style.display = "inline-block";
            readMoreBtn.setAttribute("onclick", `openReadMoreModal("${reason.replace(/"/g, '&quot;')}")`);
        } else {
            readMoreBtn.style.display = "none";
        }
    };

});
