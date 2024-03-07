<?php

function get_txs(){

    global $wpdb;
    $tax_classes = WC_Tax::get_tax_classes();
    $tax_rates = WC_Tax::get_rates();
    $all_tax_rate_ids = array(); // Array to store all tax rate IDs with country

    if (!empty($tax_classes)) {
        foreach ($tax_classes as $class) {
            $taxes = WC_Tax::get_rates_for_tax_class($class);
            $tax_rate_info = array(); // Array to store tax rate info for current tax class

            echo "<h2>Tax Class: $class</h2>";
            echo json_encode($taxes);
            echo "<br>";

            if (!empty($taxes)) {
                foreach ($taxes as $tax) {
                    // Extract tax rate ID and country
                    $tax_rate_info[] = array(
                        "id" => $tax->tax_rate_id,
                        "country" => $tax->tax_rate_country,
                        "state" => $tax->tax_rate_state,
                       // "postcode" => $tax->tax_rate_postcode,
                        //"city" => $tax->tax_rate_city,
                        "rate" => $tax->tax_rate,
                        "name" => $tax->tax_rate_name,
                        "priority" => $tax->tax_rate_priority,
                        "compound" => $tax->tax_rate_compound,
                        "shipping" => $tax->tax_rate_shipping,
                        "order" => $tax->tax_rate_order,
                        "class" => $tax->tax_rate_class
                    );
                }
            } else {
                echo "No tax rates found for class: $class";
            }

            // Add tax rate info for the current tax class to the $all_tax_rate_ids array
            $all_tax_rate_ids[] = $tax_rate_info;
        }
    } 

    // Output all tax rate IDs with country in the desired format
    echo "<h2>All Tax Rate IDs with Country</h2>";
    echo json_encode($all_tax_rate_ids);
    echo "<br>";
}

?>
