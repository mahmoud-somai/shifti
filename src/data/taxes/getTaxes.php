<?php

function get_txs(){

    global $wpdb;
    $tax_classes           = WC_Tax::get_tax_classes();
    $tax_rates             = WC_Tax::get_rates();
    $tab_tax=[];
    $tab_rates=[];

    if ( ! empty( $tax_classes ) ) {
        // Check if there is at least a second tax class
        if (count($tax_classes) > 1) {
            // Get the second tax class
            $second_tax_class = $tax_classes[1];
            
            // Get tax rates for the second tax class
            $taxes = WC_Tax::get_rates_for_tax_class( $second_tax_class );
            
            // Store the tax class and rates
            $tab_tax[] = $second_tax_class;
            $tab_rates[] = $taxes;
        } else {
            // If there is no second tax class, return a message
            echo "There is no second tax class.";
            return;
        }
    }

    // Output the tax class and rates
    echo "<h2>get_tax_classes:</h2>";
    echo json_encode($tab_tax);
    echo "<br>";

    echo "<h2>get taxes new tests rates for second tax class:</h2>";
    echo json_encode($tab_rates);
    echo "<br>";
}

?>
