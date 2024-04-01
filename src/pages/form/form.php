<?php


function form_html(){
    echo '<link rel="stylesheet" href="' . plugins_url( 'shifti-import/src/styles/main.css') . '">';

    echo '<div class="stf-form" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin: 20px auto; background-color: white; width: 50%; text-align: center;">';
    echo '<div class="form-group" style="display: inline-block; width: 100%;">';
    echo '<span style="font-size: 16px; color: #333; width: 30%; text-align: left; display: inline-block;">Plugin:</span>';
    echo '<input type="text" name"plugin-token" id="token" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 30%; display: inline-block; margin-left: 5px;">';
    echo '<button class="button-sft" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 30%; display: inline-block; margin-left: 5px;">Export Your Shop!</button>';
    echo '</div>';
    echo '</div>';

    echo '<script src="' . plugins_url( 'shifti-import/src/scripts/index.js') . '"></script>';
}







