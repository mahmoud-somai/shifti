<?php

function get_txs() {
    // Get all tax classes
    $tax_classes = WC_Tax::get_tax_classes();

    // Add the standard tax class, which is represented by an empty string
    $tax_classes[] = '';

    $all_tax_rates = array(); // Array to store all tax rate info

    // Loop through each tax class
    foreach ($tax_classes as $class) {
        // Get tax rates for the current tax class
        $taxes = WC_Tax::get_rates_for_tax_class($class);

        // Loop through each tax rate in the current tax class
        foreach ($taxes as $tax) {
            // Extract tax rate ID, country, state, postcodes, and cities
            $postcodes = !empty($tax->postcode) ? explode(';', $tax->postcode) : array();
            $cities = !empty($tax->city) ? explode(';', $tax->city) : array();

            // Store tax rate information
            $tax_rate_info = array(
                "id" => $tax->tax_rate_id,
                "country" => $tax->tax_rate_country,
                "state" => $tax->tax_rate_state,
                "postcodes" => $postcodes,
                "cities" => $cities,
                "rate" => $tax->tax_rate,
                "name" => $tax->tax_rate_name,
                "priority" => $tax->tax_rate_priority,
                "compound" => $tax->tax_rate_compound,
                "shipping" => $tax->tax_rate_shipping,
                "order" => $tax->tax_rate_order,
                "class" => $tax->tax_rate_class
            );

            // Add tax rate info to the array
            $all_tax_rates[] = $tax_rate_info;
        }
    }

    // Return the tax rate info as a JSON encoded string
    return json_encode($all_tax_rates);
}

// Example usage: Echo the result of get_txs function
echo get_txs();

?>
