function myFunction() {
    // Your JavaScript code here
    alert("Hello! This is a JavaScript function.");
  };
  
  
// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
  // Select the "Show Taxes" button
  const showTaxesButton = document.getElementById('show-taxes-button');
  const taxesContainer = document.getElementById('taxes-container');

  if (showTaxesButton) {
      showTaxesButton.addEventListener('click', function () {
          // Show a loading message while fetching data
          taxesContainer.innerHTML = '<p>Loading tax data...</p>';

          // Make an AJAX request to fetch tax data
          jQuery.ajax({
              url: ajaxurl, // WordPress-provided global for admin-ajax.php
              method: 'POST',
              data: { action: 'get_tax_data' }, // Action to trigger the get_tax_data function
              success: function (response) {
                  if (response.success) {
                      const taxes = JSON.parse(response.data); // Parse the JSON data
                      
                      // Generate a table to display the tax data
                      let tableHtml = '<table border="1" style="width: 100%; border-collapse: collapse;">';
                      tableHtml += '<thead>';
                      tableHtml += '<tr>';
                      tableHtml += '<th>Foreign ID</th><th>Name</th><th>Rate</th><th>Woo Class</th><th>Active</th>';
                      tableHtml += '</tr>';
                      tableHtml += '</thead>';
                      tableHtml += '<tbody>';

                      taxes.forEach(tax => {
                          tableHtml += `
                              <tr>
                                  <td>${tax.foreign_id}</td>
                                  <td>${tax.name}</td>
                                  <td>${tax.rate}</td>
                                  <td>${tax.woo_class}</td>
                                  <td>${tax.active}</td>
                              </tr>
                          `;
                      });

                      tableHtml += '</tbody>';
                      tableHtml += '</table>';

                      // Replace the loading message with the table
                      taxesContainer.innerHTML = tableHtml;
                  } else {
                      taxesContainer.innerHTML = '<p>Failed to fetch tax data.</p>';
                  }
              },
              error: function () {
                  taxesContainer.innerHTML = '<p>An error occurred while fetching tax data.</p>';
              }
          });
      });
  }
});