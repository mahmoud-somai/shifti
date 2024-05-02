<?php

function get_workers(){

    global $wp_query;

    $args = array(
        'role' => 'customer',
    );
    $customer_users = get_users(); // Fetch customers with 'customer' role

    $workers = [];

    foreach ($customer_users as $user) {
        $role = !empty($user->roles) ? $user->roles[0] : null;
        echo $role;
        
        // Check if the user's role is not "customer"
        if ($role != 'customer') {
            $worker = [];
            $worker['id'] = $user->ID;
            $worker['date_created'] = $user->user_registered;
            $worker['email'] = $user->user_email;
            $worker['first_name'] = $user->first_name;
            $worker['last_name'] = $user->last_name;
            $worker['role'] = $role;
            $worker['username'] = $user->user_login;
            $worker['password'] = $user->user_pass;
            $worker['avatar_url'] = get_avatar_url($user->ID);

            // Billing information
            $billing = [];
            $billing['first_name'] = method_exists($user, 'get_billing_first_name') ? $user->get_billing_first_name() : null;
            $billing['last_name'] = method_exists($user, 'get_billing_last_name') ? $user->get_billing_last_name() : null;
            $billing['company'] = method_exists($user, 'get_billing_company') ? $user->get_billing_company() : null;
            $billing['address_1'] = method_exists($user, 'get_billing_address_1') ? $user->get_billing_address_1() : null;
            $billing['address_2'] = method_exists($user, 'get_billing_address_2') ? $user->get_billing_address_2() : null;
            $billing['city'] = method_exists($user, 'get_billing_city') ? $user->get_billing_city() : null;
            $billing['state'] = method_exists($user, 'get_billing_state') ? $user->get_billing_state() : null;
            $billing['postcode'] = method_exists($user, 'get_billing_postcode') ? $user->get_billing_postcode() : null;
            $billing['country'] = method_exists($user, 'get_billing_country') ? $user->get_billing_country() : null;
            $billing['email'] = method_exists($user, 'get_billing_email') ? $user->get_billing_email() : null;
            $billing['phone'] = method_exists($user, 'get_billing_phone') ? $user->get_billing_phone() : null;

            $worker['billing'] = $billing;

            // Add non-customer to the array
            $workers[] = $worker;
        }
    }

    return json_encode($workers);
}
?>