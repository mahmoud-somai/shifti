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
        $customer['first_name'] = $user->first_name ?: null;
        $customer['last_name'] = $user->last_name ?: null;

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
        // Get billing information attributes
        $billing['first_name'] = $order->get_billing_first_name() ?: null;
        $billing['last_name'] = $order->get_billing_last_name() ?: null;
        $billing['company'] = $order->get_billing_company() ?: null;
        $billing['address_1'] = $order->get_billing_address_1() ?: null;
        $billing['address_2'] = $order->get_billing_address_2() ?: null;
        $billing['city'] = $order->get_billing_city() ?: null;
        $billing['woo_state'] = $order->get_billing_state() ?: null;
        $billing['postcode'] = $order->get_billing_postcode() ?: null;
        $billing['woo_country'] = $order->get_billing_country() ?: null;
        $billing['phone'] = $order->get_billing_phone() ?: null;

        // Add billing info to the array
        $billing_info[] = $billing;
    }

    return $billing_info;
}

?>
