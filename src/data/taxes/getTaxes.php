<?php

function get_txs(){

    global $wpdb;
    $tax_classes           = WC_Tax::get_tax_classes();
    $tax_rates             = WC_Tax::get_rates();
    $tab_tax=[];
    $tab_rates=[];

    if ( ! empty( $tax_classes ) ) {
        // Get the first tax class
        $first_tax_class = reset($tax_classes);
        
        // Get tax rates for the first tax class
        $taxes = WC_Tax::get_rates_for_tax_class( $first_tax_class );
        
        // Store the tax class and rates
        $tab_tax[] = $first_tax_class;
        $tab_rates[] = $taxes;
    }

    // Output the tax class and rates
    echo "<h2>get_tax_classes:</h2>";
    echo json_encode($tab_tax);
    echo "<br>";

    echo "<h2>get taxes new tests rates for first tax class:</h2>";
    echo json_encode($tab_rates);
    echo "<br>";
}

?>
