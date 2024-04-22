jQuery(document).ready(function($) {
    $("#fetch-golang-data-form").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        // Get the URL from the form
        var url = "http://192.168.1.15:8080/api/ordersnote";
        
        // Log the endpoint called
        console.log("Endpoint called from WP : " + url);
    });
});

