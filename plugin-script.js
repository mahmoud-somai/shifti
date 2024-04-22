jQuery(document).ready(function($) {
    $("#fetch-golang-data-form").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        $.ajax({
            url: "http://192.168.1.27:8080/api/ordersnote", // Specify HTTP explicitly
            method: "GET", 
            success: function(response) {
                // Log the endpoint called and response received
                $("#endpoint-called").text("Endpoint called: ", this.url);
                $("#response-received").text("Response received: " + response);
            },
            error: function(xhr, status, error) {
                // Log an error message to the console
                console.log("Error fetching: " + this.url);
               
            }
        });
    });
});
