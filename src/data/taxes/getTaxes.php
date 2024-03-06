<?php

function get_txs(){

     global $wpdb;
     $tax_rates = WC_Tax::get_rates();

     // Check if there are tax rates
     if (!empty($tax_rates)) {
         echo "<h2>All Tax Rates:</h2>";
 
         // Loop through each tax rate
         foreach ($tax_rates as $tax_rate) {
             echo "<p>";
             echo "Tax Rate ID: " . $tax_rate->tax_rate_id . "<br>";
             echo "Country: " . $tax_rate->country . "<br>";
             echo "State: " . $tax_rate->state . "<br>";
             echo "Tax Rate: " . $tax_rate->tax_rate . "%<br>";
             echo "</p>";
         }
     } else {
         echo "No tax rates found.";
     }

}

?>