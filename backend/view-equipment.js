function viewRequest(id, name, address, itemType, reason, requestDate, status) {
    document.getElementById('view_name').value = name;
    document.getElementById('view_address').value = address;
    document.getElementById('view_item_type').value = itemType;
    document.getElementById('view_reason').value = reason;
    document.getElementById('view_request_date').value = requestDate;
    document.getElementById('view_status').value = status;

    document.getElementById('viewRequestModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('viewRequestModal').style.display = 'none';
}

function updateStatus(id, status) {
    $.ajax({
        url: '../admin-backend/update-status-equipment.php',
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