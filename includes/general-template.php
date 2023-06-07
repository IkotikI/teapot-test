<?php

$GLOBALS['template_dirs'] = array(
								PUBPATH . '/templates',
								PUBPATH . '/template-parts'
							);

function get_header( $slug = '' ) {
	global $template_dirs;

	foreach ($template_dirs as $dir) {
		$file = $dir . "/header-{$slug}.php";
		// echo 'potentioal template: ' . $file . "\n";
		if ( file_exists( $file ) ) {
			load_template( $file );		
			return;
		}
	}

	$file = PUBPATH . '/templates/header.php';
	load_template($file);

}

function get_footer( $slug = '') {
	global $template_dirs;

	foreach ($template_dirs as $dir) {
		$file = $dir . "/footer-{$slug}.php";
		// echo 'potentioal template: ' . $file . "\n";
		if ( file_exists( $file ) ) {
			load_template( $file );		
			return;
		}
	}

	$file = PUBPATH . '/templates/footer.php';
	load_template($file);
	
}

function get_template_part( $slug, $args = array() ) {
	global $template_dirs;

	foreach ($template_dirs as $dir) {
		$file = $dir . "/{$slug}.php";
		// echo 'potentioal template: ' . $file . "\n";
		if ( file_exists( $file ) ) {
			load_template( $file, false, $args );		
			return;
		}
	}

	echo "Tempalte {$slug} not found";

}