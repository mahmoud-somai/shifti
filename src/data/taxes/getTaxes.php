<?php

function get_txs(){

    global $wpdb;
    $tax_classes = WC_Tax::get_tax_classes();
    $tax_rates = WC_Tax::get_rates();
    $all_tax_rate_ids = array(); // Array to store all tax rate IDs

    if (!empty($tax_classes)) {
        foreach ($tax_classes as $class) {
            $taxes = WC_Tax::get_rates_for_tax_class($class);
            $tax_rate_ids = array(); // Array to store tax rate IDs for current tax class

            echo "<h2>Tax Class: $class</h2>";
            echo json_encode($taxes);
            echo "<br>";

            if (!empty($taxes)) {
                foreach ($taxes as $tax) {
                    // Extract tax rate ID
                    $tax_rate_ids[] = $tax->tax_rate_id;
                }
            } else {
                echo "No tax rates found for class: $class";
            }
            $all_tax_rate_ids[$"id"] = $tax_rate_ids;
        }
    } else {
        echo "No tax classes found.";
    }

    // Output all tax rate IDs
    echo "<h3>All Tax Rate IDs</h3>";
    echo json_encode($all_tax_rate_ids);
    echo "<br>";
}

?>
