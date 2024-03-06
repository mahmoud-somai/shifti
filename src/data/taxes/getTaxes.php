<?php



function get_txs(){

    global $wpdb;
    $tax_classes           = WC_Tax::get_tax_classes();
    $tax_class_options     = array();
    $tax_class_options[''] = __( 'Standard', 'woocommerce' );

    if ( ! empty( $tax_classes ) ) {
        foreach ( $tax_classes as $class ) {
            $tax_class_options[ sanitize_title( $class ) ] = $class;
        }
    }
    echo json_encode($tax_class_options);


}

// function get_txs(){

//      global $wpdb;
//      $tax_rates = WC_Tax::get_rates();
//      echo "<h2>get_rates:</h2>";
//      echo json_encode($tax_rates);
//      echo "<br>";

//      // Check if there are tax rates
//      if (!empty($tax_rates)) {
//          echo "<h2>All Tax Rates:</h2>";
 
//          // Loop through each tax rate
//          foreach ($tax_rates as $tax_rate) {
//              echo "<br>";
//              echo json_encode($tax_rate);
//              echo "<br>";
//              $rate_id=$tax_rate->get_tax_rate();
//              echo "rate id ==> <br>";
//              echo $rate_id;
//              echo "<br>";

//          }
//      } else {
//          echo "No tax rates found.";
//      }

// }

?>