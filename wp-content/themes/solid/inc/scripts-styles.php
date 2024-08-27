<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	function solid_scripts() {
		wp_enqueue_style( 'solid-style', get_stylesheet_uri(), array(), _S_VERSION );
		wp_enqueue_style( 'solid-style-main', get_template_directory_uri() . '/assets/css/style.min.css', array(), _S_VERSION );
		wp_style_add_data( 'solid-style', 'rtl', 'replace' );

		wp_enqueue_script( 'solid-script-main', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), _S_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'solid_scripts' );