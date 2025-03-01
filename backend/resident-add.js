function updateStatus(id, status) {
    $.ajax({
        url: '../admin-backend/update-status-resident.php',
        type: 'POST',
        data: { request_id: id, status: status },
        success: function(response) {
            location.reload();
        },
        error: function() {
            alert("Failed to update status");
        }
    });
}

$(document).ready(function() {
    $("#addUserBtn").on("click", function() {
        $("#addResidentModal").fadeIn();
    });

    $(".close").on("click", function() {
        $("#addResidentModal").fadeOut();
    });

    $(window).on("click", function(event) {
        if ($(event.target).is("#addResidentModal")) {
            $("#addResidentModal").fadeOut();
        }
    });
});