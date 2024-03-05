<?php

function get_customers(){

    global $wp_query;

    $args = array(
        'role' => 'customer',
    );
    $users = get_users();
    $customers = [];
    foreach ($users as $user) {

        $customer = [];
        $customer['id'] = $user->ID;
        $customer['date_created'] = $user->user_registered;
        $customer['email'] = $user->user_email;
        $customer['first_name'] = $user->first_name;
        $customer['last_name'] = $user->last_name;
        $customer['role'] = !empty($user->roles) ? $user->roles[0] : null;
        $customer['username'] = $user->user_login;
        $customer['password'] = $user->user_pass;
        $customer['avatar_url'] = get_avatar_url($user->ID);

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

        $customer['billing'] = $billing;

        // Add customer to the array
        $customers[] = $customer;
    }


    return json_encode($customers);
}

?>

