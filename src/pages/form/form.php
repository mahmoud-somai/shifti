<?php




function form_html(){
    echo '<link rel="stylesheet" href="' . plugins_url( 'shifti-import/src/styles/main.css') . '">';

    echo '<div class="stf-form">';
    echo '<div class="form-group">';
    echo '<label for="token" style="font-size: 16px; color: #333;">Plugin Token:</label>';
    echo '<input type="text" name"plugin-token" id="token" style="padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">';
    echo '</div>';
    echo '<button class="button-sft" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px;" onclick="myFunction()">Import Your Shop!</button>';
    echo '</div>';

    echo '<script src="' . plugins_url( 'shifti-import/src/scripts/index.js') . '"></script>';
}
