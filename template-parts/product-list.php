<?php
$products = get_products(array('status' => 'any'));
foreach ( $products as $product ) {
	set_products_vars( $product );
	get_template_part( 'product-exerpt-editable' );
}