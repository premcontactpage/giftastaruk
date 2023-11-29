<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Default_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = 'Default_controller/admin';
$route['do-login'] = 'Default_controller/do_login';
$route['dashboard'] = 'Default_controller/dashboard';
$route['products'] = 'Default_controller/products';
$route['create-product'] = 'Default_controller/create_product';
$route['edit-product/(:any)'] = 'Default_controller/edit_product/$1';
$route['shipping-rates'] = 'Default_controller/shipping_rates';
$route['options'] = 'Default_controller/options';
$route['add-tags/(:any)'] = 'Default_controller/add_tags/$1';
$route['reviews'] = 'Default_controller/reviews';
$route['orders/(:any)'] = 'Default_controller/orders/$1';
$route['new-orders'] = 'Default_controller/new_orders';
$route['view/(:any)'] = 'Default_controller/view_order/$1';
$route['print/(:any)'] = 'Default_controller/print_order/$1';
$route['variants/(:any)'] = 'Default_controller/variants/$1';

$route['update-priority']  = 'Default_controller/update_priority';

$route['delete/(:any)'] = 'Default_controller/delete/$1';
$route['change-status/(:any)'] = 'Default_controller/change_status/$1';
$route['update-password'] = 'Default_controller/update_password';
$route['logout'] = 'Default_controller/logout';
$route['fetch-order-details-ajax'] = 'Default_controller/fetch_order_details_ajax';

/* website */
$route['listing']  = 'Default_controller/listing';
$route['checkouts'] = 'Default_controller/checkouts';
// $route['pay'] = 'Default_controller/pay_now';
$route['pay'] = 'Default_controller/payment';
$route['payment'] = 'Default_controller/payment';
$route['payment-success'] = 'Default_controller/paymentSuccess';
$route['payment-failed'] = 'Default_controller/paymentFailed';
$route['verify'] = 'Default_controller/verify';
$route['product/(:any)'] = 'Default_controller/product_view/$1';
$route['all-products'] = 'Default_controller/all_products';
$route['checkout'] = 'Default_controller/checkout';

$route['add-to-cart'] = 'Default_controller/add_to_cart';
$route['cart-data'] = 'Default_controller/cart_data';
$route['remove-cart'] = 'Default_controller/remove_from_cart';
$route['checkout_data'] = 'Default_controller/checkout_data';
$route['success'] = 'Default_controller/success';

$route['privacy-policy'] = 'Default_controller/privacy';
$route['terms-of-service'] = 'Default_controller/terms';
$route['refund-policy'] = 'Default_controller/refund';
$route['shipping-policy'] = 'Default_controller/shipping';
$route['contact-us'] = 'Default_controller/contact';
$route['check-cart'] = 'Default_controller/check_cart';
$route['find-your-star'] = 'Default_controller/find_star';
$route['review/(:any)'] = 'Default_controller/product_review/$1';
$route['fetch-review'] = 'Default_controller/fetch_review';


$route['test'] = 'Default_controller/test';
$route['apply'] = 'Default_controller/apply_coupon';