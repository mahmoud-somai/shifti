jQuery(document).ready(function($) {
    $('#send-orders-notes-to-api-button').click(function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'send_orders_notes_to_api'
            },
            success: function(response) {
                // Handle the successful API call
                alert('Data sent to API successfully!');
            },
            error: function(xhr, status, error) {
                // Handle errors
                alert('Error sending data to API: ' + error);
            }
        });
    });
});
