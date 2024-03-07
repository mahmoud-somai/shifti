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
                    $tax_rate_ids[] = array("id" => $tax->tax_rate_id);
                }
            } else {
                echo "No tax rates found for class: $class";
            }

            $all_tax_rate_ids[] = $tax_rate_ids;
        }
    } else {
        echo "No tax classes found.";
    }

    // Flatten the array to get only the tax rate IDs
    $flat_tax_rate_ids = array_reduce($all_tax_rate_ids, 'array_merge', []);
    
    // Output all tax rate IDs in the desired format
    echo json_encode($flat_tax_rate_ids);
    echo "<br>";
}

?>
