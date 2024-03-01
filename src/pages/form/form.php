<?php





function form_html(){

   
        echo '<link rel="stylesheet" href="' . plugins_url( 'shifti-import/src/styles/main.css') . '">';

    echo '<div class="stf-form">';
        echo '<div class=" ">';
            echo '<label for="token">plugin token</label>';
            echo '<input type="text" name"plugin-token" id="token">';
        echo '</div>';
        echo '<button class="button-sft" onclick="myFunction()">Import your shop!</button> <button class="button-sft" onclick="myfct()">Export Data JSON </button>';

    echo '</div>';
    

    echo '<script src="' . plugins_url( 'shifti-import/src/scripts/index.js') . '"></script>';
   

    
    
}