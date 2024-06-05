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

        $customer['shop_id'] = 3; // Adding shop_id attribute with value 1
        $customer['tenant_id'] = '10875a8d-9a96-4a10-a0ae-8c96cb9da73f'; // Adding tenant_id attribute with value 'tenant_1234'


        
        // Add customer to the array
        $customers[] = $customer;
    }

    return json_encode($customers);
}






?>

