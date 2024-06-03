<?php

function get_some() {
    $properties = array();

    // Add the site language
    $properties['language'] = get_locale();

    // Add other properties as needed
    // $properties['some_other_property'] = some_function_to_get_property();

    echo json_encode($properties);

    return json_encode($properties);
}


?>