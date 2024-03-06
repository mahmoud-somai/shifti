<?php



function get_txs(){

    global $wpdb;
    $tax_classes           = WC_Tax::get_tax_classes();
    $tax_rates              = WC_Tax::get_rates();
    $tab_tax=[];
    $tab_rates=[];


    if ( ! empty( $tax_classes ) ) {
        foreach ( $tax_classes as $class ) {
            $taxes = WC_Tax::get_rates_for_tax_class( $class );
            $tax_rates_ids = array_column($taxes, 'tax_rate_id');
            array_push($tab_tax,$class);
            array_push($tab_rates,$taxes);

            echo "<h2>get rates ids :</h2>";
            echo $tax_rates_ids;
            echo "<br>";
        }
    }
    echo "<h2>get_tax_classes:</h2>";
    echo json_encode($tab_tax);
    echo "<br>";

    // if(!empty($tax_rates)){
    //     foreach ($tax_rates as $tax_rate) {

    //         array_push($tab_rates,$tax_rate);
    //     }
    // }

    echo "<h2>get taxes new tests rates:</h2>";
    echo json_encode($tab_rates);
    echo "<br>";
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