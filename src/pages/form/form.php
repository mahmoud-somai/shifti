<?php



function form_html(){
    echo '<link rel="stylesheet" href="' . plugins_url( 'shifti-import/src/styles/main.css') . '">';

    echo '<div class="stf-form" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin: 20px auto; background-color: white; width: 50%; text-align: center;">';
    echo '<div class="form-group" style="display: inline-block;">';
    echo '<label for="token" style="font-size: 16px; color: #333; display: inline-block; width: 30%;">Plugin Token:</label>';
    echo '<input type="text" name"plugin-token" id="token" style="padding: 8px; margin-left: 10px; border: 1px solid #ccc; border-radius: 4px; width: 70%; display: inline-block;">';
    echo '</div>';
    echo '<button class="button-sft" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Import Your Shop!</button>';
    echo '</div>';

    echo '<script src="' . plugins_url( 'shifti-import/src/scripts/index.js') . '"></script>';
}



