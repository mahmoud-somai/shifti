<?php

function get_txs(){

     global $wpdb;
     $tax_rates = WC_Tax::get_rates();
     echo json_encode($tax_rates);

     // Check if there are tax rates
     if (!empty($tax_rates)) {
         echo "<h2>All Tax Rates:</h2>";
 
         // Loop through each tax rate
         foreach ($tax_rates as $tax_rate) {
             echo "<br>";
             echo json_encode($tax_rate);
             echo "<br>";
         }
     } else {
         echo "No tax rates found.";
     }

}

?>