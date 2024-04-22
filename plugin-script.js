jQuery(document).ready(function($) {
    $("#fetch-golang-data-form").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        $.ajax({
            url: "http://192.168.1.27:8080/api/ordersnote",
            method: "GET",
            success: function(response) {
                // Display the response received on the page
                $("#response-received").text("Response received: " + response);
            },
            error: function(xhr, status, error) {
                // Log an error message to the console
                console.error("Error fetching: " + this.url);
            }
        });
    });
});
