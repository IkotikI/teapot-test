<?php

global $db;

$id = '';
$name = '';
$slug = '';
$description = '';
$status = '';

if ( ! isset( $_POST['id'] ) ) {
	http_response_code(500);
	echo 'No ID given!';
	die;
} else {
	$id = filter_var( $_POST['id'], FILTER_SANITIZE_NUMBER_INT );
}

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

$query = "UPDATE `products` SET `product_name` = '{$name}', `product_slug` = '{$slug}', `product_description` = '{$description}', `product_status` = '{$status}' WHERE `ID` = {$id}";


$db->query( "UPDATE `products` SET `product_name` = '{$name}', `product_slug` = '{$slug}', `product_description` = '{$description}', `product_status` = '{$status}' WHERE `ID` = {$id}" );

ob_start();
get_template_part( 'product-list' );
$refreshed_contents = ob_get_clean();

header('Content-Type: application/json; charset=utf-8');
$data = array( 'query' => htmlentities( $query ), 'refreshed_contents' => $refreshed_contents );
// $data = array( 'query' => 'query', 'refreshed_contents' => 'refreshed_contents' );
echo json_encode( $data );

http_response_code(200);
die();
