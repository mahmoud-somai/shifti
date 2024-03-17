// index.js

document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('fetch-golang-data-button').addEventListener('click', function (event) {
      event.preventDefault(); // Prevent the default form submission behavior

      // Make an AJAX call to fetch data from the Golang API
      fetchGolangData();
  });
});

function fetchGolangData() {
  // Make AJAX request to fetch data from the Golang API
  fetch(ajax_object.ajax_url, {
      method: 'POST',
      body: new FormData(document.getElementById('fetch-golang-data-form'))
  })
  .then(response => {
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      return response.text();
  })
  .then(data => {
      console.log('Data from Golang API:', data);
  })
  .catch(error => {
      console.error('Error fetching data:', error);
  });
}
