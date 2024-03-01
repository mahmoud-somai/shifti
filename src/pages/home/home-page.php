

<?php

require_once dirname(__FILE__) . '/../form/form.php';



function header_html(){


 
    echo '<link rel="stylesheet" href="' . plugins_url( 'shifti-import/src/styles/main.css') . '">';

    echo '<div style="text-align: center; padding: 20px; background-color: #f0f0f0;">';
        echo '<img src="' . plugins_url( 'shifti-import/src/img/logo.png') . '" alt="Logo" style="width: 150px; height: 100px;">';
        echo '<h1 style="font-size: 24px; margin-top: 20px;">Welcome to Shifti WordPress Plugin</h1>';
        echo '<p style="font-size: 16px; margin-top: 10px;">Here you can import the data of your shop</p>';
        echo '<p style="font-size: 16px;">By entering your plugin shop secret key and pressing import, you can import your WooCommerce data to your shop!</p>';
        echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
        echo '<input type="hidden" name="action" value="download_json">';
        echo '<button type="submit">Download JSON</button>';
        form_html();
    echo '</div>';
    
   
}