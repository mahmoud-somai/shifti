<?php

function get_txs(){

    global $wpdb;
    $tax_classes = WC_Tax::get_tax_classes();
    $tax_rates = WC_Tax::get_rates();

    if (!empty($tax_classes)) {
        foreach ($tax_classes as $class) {
            $taxes = WC_Tax::get_rates_for_tax_class($class);
            // Decode JSON string into an associative array
            $tax_rate_ids = array();

            echo "<h2>Tax Class: $class</h2>";
            echo json_encode($taxes);
            echo "<br>";

            if (is_object($taxes) && !empty((array)$taxes)) {
                foreach ($taxes as $tax) {
                    // Extract tax rate ID
                    $tax_rate_ids[] = $tax->tax_rate_id;
                }
                // Output tax rate IDs for the current tax class
                echo "<h3>Tax Rate IDs for $class</h3>";
                echo json_encode($tax_rate_ids);
                echo "<br>";
            } else {
                echo "No tax rates found for class: $class";
            }
        }
    } else {
        echo "No tax classes found.";
    }
}

?>
