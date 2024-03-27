<?php



function form_html(){
    echo '<link rel="stylesheet" href="' . plugins_url( 'shifti-import/src/styles/main.css') . '">';

    echo '<div class="stf-form" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin: 20px; background-color: white;">';
    echo '<div class="form-group">';
    echo '<label for="token" style="font-size: 16px; color: #333; padding-bottom: 5px;">Plugin Token:</label>';
    echo '<input type="text" name"plugin-token" id="token" style="padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; width: 100%;">';
    echo '</div>';
    echo '<button class="button-sft" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px;" onclick="myFunction()">Import Your Shop!</button>';
    echo '</div>';

    echo '<script src="' . plugins_url( 'shifti-import/src/scripts/index.js') . '"></script>';
}

