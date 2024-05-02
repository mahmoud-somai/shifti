<?php


// function form_html(){
//     echo '<link rel="stylesheet" href="' . plugins_url( 'shifti-import/src/styles/main.css') . '">';

//     echo '<div class="stf-form" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin: 20px auto; background-color: white; width: 50%; text-align: center;">';
//     echo '<h2 style="width: 100%; margin-bottom: 20px;">Link Shop</h2>'; 
//     echo '<div class="form-group" style="display: inline-block; width: 100%;">';
//     echo '<span style="font-size: 16px; color: #333; width: 20%; text-align: left; display: inline-block;">Plugin Token : </span>';
//     echo '<input type="text" name"plugin-token" id="token" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 40%; height:35px; display: inline-block;">';
//     echo '<button class="button-sft" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 30%; display: inline-block; margin-left:25px;">Export Your Shop!</button>';
//     echo '</div>';
//     echo '</div>';

//     echo '<script src="' . plugins_url( 'shifti-import/src/scripts/index.js') . '"></script>';
// }




function form_html(){
    echo '<link rel="stylesheet" href="' . plugins_url( 'shifti-import/src/styles/main.css') . '">';

    echo '<form id="export-form" method="post" action="' . admin_url('admin-ajax.php') . '">'; // Start the form tag

    echo '<div class="stf-form" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin: 20px auto; background-color: white; width: 50%; text-align: center;">';
    echo '<h2 style="width: 100%; margin-bottom: 10px;">Link Shop</h2>'; 
    echo '<div class="form-group" style="display: inline-block; width: 100%;">';
    echo '<span style="font-size: 16px; color: #333; width: 20%; text-align: left; display: inline-block;">Plugin Token : </span>';
    echo '<input type="text" name="plugin-token" id="token" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 40%; height:35px; display: inline-block;">';
   
    echo '<input type="hidden" name="action" value="download_orders_notes_json">';
    echo '<button type="submit" id="export-button" class="button-sft" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 30%; display: inline-block; margin-left:25px;" disabled>Export Your Shop!</button>'; // Button initially disabled
    echo '</div>';
    echo '<div id="progress-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.7); z-index: 9999; display: none;">';
    echo '    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">';
    echo '        <progress id="progress-bar" style="width: 200px; height: 20px;"></progress>';
    echo '    </div>';
    echo '</div>';
    echo '</div>';

    echo '</form>'; // End the form tag

    echo '<script src="' . plugins_url( 'shifti-import/src/scripts/index.js') . '"></script>';
    echo '<script>';
    echo 'document.getElementById("token").addEventListener("input", function() {'; // Listen for input changes
    echo '    var tokenInput = this.value;';
    echo '    var exportButton = document.getElementById("export-button");';
    echo '    if (tokenInput.trim() === "hello123") {';
    echo '        exportButton.disabled = false;'; // Enable button if input matches "hello123"
    echo '    } else {';
    echo '        exportButton.disabled = true;'; // Disable button if input doesn't match "hello123"
    echo '    }';
    echo '});';
    echo '</script>';
}



?>




