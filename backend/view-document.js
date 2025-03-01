function viewRequest(id, name, address, documentType, reason, requestDate, status) {
    document.getElementById('view_name').value = name;
    document.getElementById('view_address').value = address;
    document.getElementById('view_document_type').value = documentType;
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
        url: '../admin-backend/update-status-document.php',
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