function myFunction() {
  // Your JavaScript code here
  alert("Hello! This is a JavaScript function.");
};

// index.js

// Define a function to fetch data from the Go API
function getalldata() {
  jQuery.ajax({
      url: 'http://192.168.1.18:8080/api/ordersnote', // Replace with your API endpoint
      type: 'GET',
      success: function(response) {
          // Handle the successful response
          console.log('Data from Go API:', response);
          // You can process the data further here
      },
      error: function(xhr, status, error) {
          // Handle errors
          console.error('Error fetching data from Go API:', error);
      }
  });
}

