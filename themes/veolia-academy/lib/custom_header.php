<?php

// for adding custom hearder

function veolia_custom_header_setup() {
	$args = array(
		'default-image'      => esc_url(get_template_directory_uri() . '/assets/images/cover-001.webp'),
		'width'              => 1920,
		'height'             => 1080,
		'flex-width'         => true,
		'flex-height'        => true,
	);
	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'veolia_custom_header_setup' );


?>