<?php

function get_txs() {
    // Ensure WooCommerce functions are loaded
    if ( ! class_exists( 'WC_Tax' ) ) {
        return json_encode([]);
    }

    // Get all tax classes
    $tax_classes = WC_Tax::get_tax_classes();
    $tax_classes[] = ''; // Add the standard tax class

    $all_tax_rate_info = array(); // Array to store all tax rate info

    // Loop through each tax class
    foreach ($tax_classes as $class) {
        // Get tax rates for the current tax class
        $taxes = WC_Tax::get_rates_for_tax_class($class);

        // Loop through each tax rate in the current tax class
        foreach ($taxes as $tax) {
            // Store only the required tax rate information
            $tax_rate_info = array(
                "foreign_id" =>(int) $tax->tax_rate_id,
                "name" => $tax->tax_rate_name,
                "rate" => $tax->tax_rate,
                "woo_class" => $tax->tax_rate_class,
                "active"=>1,
                "deleted"=>0,
                "lang_id"=>1,
                "tenant_id"=>"tn_123",
                "shop_id"=>1

            );

            // Add tax rate info to the array
            $all_tax_rate_info[] = $tax_rate_info;
        }
    }

    // Return the tax rate info as a JSON encoded string
    return json_encode($all_tax_rate_info);
}

// Example usage: Echo the result of get_txs function


?>
