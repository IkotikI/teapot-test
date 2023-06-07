<?php

if ( ! defined( 'INCPATH' ) ) {
	define( 'INCPATH', __DIR__ );
}

if ( ! defined( 'PUBPATH' ) ) {
	define( 'PUBPATH', ABSPATH );
}

require_once ABSPATH . '/config.php';

function require_db() {
	global $db;

	require_once INCPATH . '/class-db.php';

	if ( isset( $db ) ) {
		return;
	}

	$dbuser     = defined( 'DB_USER' ) ? DB_USER : '';
	$dbpassword = defined( 'DB_PASSWORD' ) ? DB_PASSWORD : '';
	$dbname     = defined( 'DB_NAME' ) ? DB_NAME : '';
	$dbhost     = defined( 'DB_HOST' ) ? DB_HOST : '';

	$db = new db( $dbuser, $dbpassword, $dbname, $dbhost );
}

require_db();

require_once INCPATH . '/functions.php';
