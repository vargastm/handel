<?php 

function handel_custom_checkout($fields) {

  //$fields['billing']['billing_first_name']['label'] = 'Primeiro Nome';
  unset($fields['billing']['billing_company']);

  return $fields;
}
add_filter('woocommerce_checkout_fields', 'handel_custom_checkout');

?>