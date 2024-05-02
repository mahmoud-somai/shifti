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
    echo '<button type="submit" id="export-button" class="button-sft" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 30%; display: inline-block; margin-left:25px;">Export Your Shop!</button>'; // Button initially disabled
    echo '</div>';
    echo '</div>';

    echo '</form>'; // End the form tag

    // Overlay HTML
    echo '<div id="progress-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; display: none;">';
    echo '    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 8px; width: 300px;">';
    echo '        <h3 style="margin-bottom: 10px;">Export Data</h3>'; // Title
    echo '        <div style="text-align: center;">';
    echo '            <progress id="progress-bar-1" style="width: 100%; height: 20px; margin-bottom: 10px;"></progress>'; // First progress bar
    echo '            <progress id="progress-bar-2" style="width: 100%; height: 20px;"></progress>'; // Second progress bar
    echo '        </div>';
    echo '    </div>';
    echo '</div>';

    echo '<script src="' . plugins_url( 'shifti-import/src/scripts/index.js') . '"></script>';
    echo '<script>';
    echo 'document.getElementById("export-form").addEventListener("submit", function(event) {';
    echo '    event.preventDefault();'; // Prevent form submission
    echo '    var progressOverlay = document.getElementById("progress-overlay");';
    echo '    progressOverlay.style.display = "block";'; // Show progress overlay
    echo '    simulateProgress();'; // Simulate progress
    echo '});';

    echo 'function simulateProgress() {';
    echo '    var progressBar1 = document.getElementById("progress-bar-1");';
    echo '    var progressBar2 = document.getElementById("progress-bar-2");';
    echo '    var interval = setInterval(function() {';
    echo '        if (progressBar1.value < 100) {';
    echo '            progressBar1.value += 5;'; // Increase the value of the first progress bar
    echo '        } else {';
    echo '            clearInterval(interval);'; // Stop the interval when the first progress bar reaches 100%
    echo '            var interval2 = setInterval(function() {';
    echo '                if (progressBar2.value < 100) {';
    echo '                    progressBar2.value += 25;'; // Increase the value of the second progress bar
    echo '                } else {';
    echo '                    clearInterval(interval2);'; // Stop the interval when the second progress bar reaches 100%
    echo '                    progressBar1.value = 0;'; // Reset the first progress bar value
    echo '                    simulateProgress();'; // Start the process again
    echo '                }';
    echo '            }, 1000);'; // Interval for the second progress bar
    echo '        }';
    echo '    }, 500);'; // Interval for the first progress bar
    echo '}';
    echo '</script>';
}







?>




