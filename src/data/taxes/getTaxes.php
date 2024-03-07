<?php

function get_txs(){

    global $wpdb;
    $tax_classes = WC_Tax::get_tax_classes();
    $tax_rates = WC_Tax::get_rates();

    if (!empty($tax_classes)) {
        foreach ($tax_classes as $class) {
            // Get tax rates for the current tax class
            $taxes = WC_Tax::get_rates_for_tax_class($class);

            // Output the tax class and rates
            echo "<h2>Tax Class: $class</h2>";
            echo json_encode($taxes);
            echo "<br>";
            $tax_rate_ids=[];
            foreach ($taxes as $tax) {
                $tax_rate_ids[] = $tax;
            }

        }
    } else {
        echo "No tax classes found.";
    }

    echo "<h2>Tax Rates</h2>";
    echo json_encode($tax_rate_ids);
    echo "<br>";
}

?>
