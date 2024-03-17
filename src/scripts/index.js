jQuery(document).ready(function($) {
  $('#fetch-golang-data-button').click(function() {
      $.ajax({
          url: ajax_object.ajax_url,
          type: 'POST',
          data: {
              action: 'fetch_golang_data'
          },
          success: function(response) {
              console.log('Data from Golang API:', response);
          },
          error: function(xhr, status, error) {
              console.error('Error fetching data:', error);
          }
      });
  });
});
