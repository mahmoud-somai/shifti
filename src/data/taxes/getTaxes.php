<?php

function get_txs(){

    global $wpdb;
    $tax_classes           = WC_Tax::get_tax_classes();
    $tax_rates             = WC_Tax::get_rates();
    $tab_tax=[];
    $tab_rates=[];

    if ( ! empty( $tax_classes ) ) {
        // Check if there is at least a third tax class
        if (count($tax_classes) > 2) {
            // Get the third tax class
            $third_tax_class = $tax_classes[2];
            
            // Get tax rates for the third tax class
            $taxes = WC_Tax::get_rates_for_tax_class( $third_tax_class );
            
            // Store the tax class and rates
            $tab_tax[] = $third_tax_class;
            $tab_rates[] = $taxes;
        } else {
            // If there is no third tax class, return a message
            echo "There is no third tax class.";
            return;
        }
    }

    // Output the tax class and rates
    echo "<h2>get_tax_classes:</h2>";
    echo json_encode($tab_tax);
    echo "<br>";

    echo "<h2>get taxes new tests rates for third tax class:</h2>";
    echo json_encode($tab_rates);
    echo "<br>";
}

?>
