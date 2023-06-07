<?php 


function get_server_base_uri() {
	return 'http://' . $_SERVER['HTTP_HOST'];
}

function sanitize_input( $text ) {
	return htmlentities( trim( $text ) );
}

function parse_args( $args, $defaults = array() ) {
	if ( is_object( $args ) ) {
		$parsed_args = get_object_vars( $args );
	} elseif ( is_array( $args ) ) {
		$parsed_args =& $args;
	} else {
		wp_parse_str( $args, $parsed_args );
	}

	if ( is_array( $defaults ) && $defaults ) {
		return array_merge( $defaults, $parsed_args );
	}
	return $parsed_args;
}

function the_styles() {
	echo '<link rel="stylesheet" href="'. get_server_base_uri() .'/assets/css/style.css">';
}

function the_scripts() {
	echo '<script src="'. get_server_base_uri() .'/assets/js/jquery.min.js" id="jquery-js"></script>';
	echo '<script src="'. get_server_base_uri() .'/assets/js/ajax-edit.js" id="ajax-edit-js"></script>';	
}

function set_products_vars( $_product ) {
	$GLOBALS['product'] = $_product;
}

function get_status_options() {
	return array(
			'publish' => 'Publish',
			'private' => 'Private'
			);
}

function the_pagination( $per_page = 10 ) {
	global $db;
	$count_arr = $db->get_row( 'SELECT count(*) FROM `products`', ARRAY_N );
	$total_pages = ceil( $count_arr[0] / $per_page );
	$page = $_GET['page'] ?? 1;

	// print_r($count_arr);
	// echo($total_pages);

	echo '<div class="pagination">';
	if ( $total_pages > 1 ) {
		echo '<a href="' . get_server_base_uri() . '">1</a>';
		for ($i = 2; $i <= $total_pages; $i++) {
				echo '<a href="' . get_server_base_uri() . '?page=' . $i . '">' . $i . '</a>';
		}
	}
	echo '</div>';
}

function get_products( $args = array() ) {
	global $db;

	$defaults = array(
		'per_page' => 10,
		'page' => $_GET['page'] ?? 1,
		'status' => 'publish',
		'order_by' => 'ID',
		'order' => 'DESC',
		// '' => '',
	);

	$args = parse_args( $args, $defaults );

	$product_status = $args['status'] ?: 'publish';
	$product_status = ( ! $product_status == 'any' ) ? "`product_status` = '{$product_status}'" : '';

	$limit_from = $args['per_page'] * ( $args['page'] - 1 );
	$limit =  "LIMIT {$limit_from}, {$args['per_page']}";

	$order = "ORDER BY `{$args['order_by']}` {$args['order']}";

	$where_arr = array();
	if ($product_status) $where_arr[] = $product_status;

	$where = '';
	if ( ! empty( $where_arr ) ) {
		$where = implode( ' AND ', $where_arr );
		$where = 'WHERE ' . $where;
	}

	$results = $db->get_results( "SELECT * FROM `products` {$where} {$order} {$limit}", ARRAY_A );

//	print( "SELECT * FROM `products` WHERE {$where} {$limit}" );

	return $results;

}