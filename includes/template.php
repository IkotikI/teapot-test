<?php

function load_template( $template_path, $required_once = false, $args = array() ) {


	if (!file_exists($template_path)) {
		throw new ErrorException("Template \"{$template_path}\" not found");
	}

	if ( $required_once ) {
		require_once $template_path;
	} else {
		require $template_path;
	}

}