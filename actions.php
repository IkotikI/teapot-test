<?php


require_once __DIR__ . '/load-app.php';

if ( isset( $_POST['action'] ) ) {
	switch ( $_POST['action'] ) {
		case 'add-product':
			require INCPATH . '/add-product.php';
		break;
		case 'update-product':
			require INCPATH . '/update-product.php';
		break;
		case 'delete-product':
			require INCPATH . '/delete-product.php';
		break;
	}
}