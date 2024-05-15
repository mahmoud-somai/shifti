<?php

function get_customers_with_billing() {
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

        // Get billing information for this customer
        $billing_info = get_billing_info($user->ID);
        $customer['billing'] = $billing_info;

        // Add customer to the array
        $customers[] = $customer;
    }

    return json_encode($customers);
}

function get_billing_info($customer_id) {
    $args = array(
        'customer_id' => $customer_id,
    );
    $orders = wc_get_orders($args);

    $billing_info = [];

    foreach ($orders as $order) {
        $billing = [];
        $billing['first_name'] = $order->get_billing_first_name();
        $billing['last_name'] = $order->get_billing_last_name();
        $billing['company'] = $order->get_billing_company();
        $billing['address_1'] = $order->get_billing_address_1();
        $billing['address_2'] = $order->get_billing_address_2();
        $billing['city'] = $order->get_billing_city();
        $billing['woo_state'] = $order->get_billing_state();
        $billing['postcode'] = $order->get_billing_postcode();
        $billing['woo_country'] = $order->get_billing_country();
        $billing['phone'] = $order->get_billing_phone();

        // Add billing info to the array
        $billing_info[] = $billing;
    }

    return $billing_info;
}

?>
