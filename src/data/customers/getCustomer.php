<?php

function get_customers(){

    global $wp_query;

    $args = array(
        'role' => 'customer',
    );
    $customer_users = get_users($args); // Fetch customers with 'customer' role

    $customers = [];

    foreach ($customer_users as $user) {

        $customer = [];
        $customer['foreign_id'] = $user->ID;
        $customer['email'] = $user->user_email;
        $customer['first_name'] = $user->first_name;
        $customer['last_name'] = $user->last_name;


        
        // Add customer to the array
        $customers[] = $customer;
    }

    return json_encode($customers);
}






?>

