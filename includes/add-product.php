<?php

global $db;

$name = '';
$slug = '';
$description = '';
$status = 'publish';

if ( ! isset( $_POST['name'] ) || empty( trim( $_POST['name'] ) ) ) {
	$last_id = $db->get_row('SELECT `ID` FROM `products` ORDER BY `ID` DESC', ARRAY_A);
	$name = "Product-" . ( (int) $last_id['ID'] + 1 );
} else {
	$name = sanitize_input( $_POST['name'] );
}

if ( ! isset( $_POST['slug'] ) || empty( trim( $_POST['slug'] ) ) ) {
	$slug = strtolower( preg_replace('/\s+/', '-', $name) );
} else {
	$slug = strtolower( preg_replace('/\s+/', '-', sanitize_input( $_POST['slug'] ) ) );
}

$description = ( $_POST['description'] ) ?  sanitize_input( $_POST['description'] ) : '';

$status_options = array_keys( get_status_options() );
if ( isset( $_POST['status'] ) && in_array($_POST['status'], $status_options) ) {
	$status = $_POST['status'];
}

$query = "INSERT INTO `products` (`ID`, `product_name`, `product_slug`, `product_description`, `product_status`) VALUES (NULL, '{$name}', '{$slug}', '{$description}', '{$status}')";


$db->query( "INSERT INTO `products` (`ID`, `product_name`, `product_slug`, `product_description`, `product_status`) VALUES (NULL, '{$name}', '{$slug}', '{$description}', '{$status}')" );

ob_start();
get_template_part( 'product-list' );
$refreshed_contents = ob_get_clean();

header('Content-Type: application/json; charset=utf-8');
$data = array( 'query' => htmlentities( $query ), 'refreshed_contents' => $refreshed_contents );
// $data = array( 'query' => 'query', 'refreshed_contents' => 'refreshed_contents' );
echo json_encode( $data );

http_response_code(200);
die();
