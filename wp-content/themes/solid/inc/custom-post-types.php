<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	/**
	 * Register a teachers post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 *
	 * @since solid 1.0
	 */

	function teachers_post_type() {

		$labels = array(
			'name'               => _x( 'Викладачі', 'post type general name', 'solid' ),
			'singular_name'      => _x( 'Викладачі', 'post type singular name', 'solid' ),
			'menu_name'          => _x( 'Викладачі', 'admin menu', 'solid' ),
			'name_admin_bar'     => _x( 'Викладачі', 'add new on admin bar', 'solid' ),
			'add_new'            => _x( 'Додати нового викладача', 'actions', 'solid' ),
			'add_new_item'       => __( 'Додати нового викладача', 'solid' ),
			'new_item'           => __( 'Новий викладач', 'solid' ),
			'edit_item'          => __( 'Редагувати викладача', 'solid' ),
			'view_item'          => __( 'Переглянути викладача', 'solid' ),
			'all_items'          => __( 'Всі викладачі', 'solid' ),
			'search_items'       => __( 'Шукати викладача', 'solid' ),
			'parent_item_colon'  => __( 'Батько викладача:', 'solid' ),
			'not_found'          => __( 'Викладача не знайдено.', 'solid' ),
			'not_found_in_trash' => __( 'У кошику викладача не знайдено.', 'solid' )
		);

		$args = array(
			'labels'             => $labels,
			'taxonomies'         => [],
			'description'        => __( 'Описание.', 'solid' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'teachers' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => 4,
			'menu_icon'          => 'dashicons-groups',
			'supports'           => array( 'title', 'thumbnail',)
		);

		register_post_type( 'teachers', $args );
	}

	add_action( 'init', 'teachers_post_type' );

	/**
	 * Register a reviews post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 *
	 * @since solid 1.0
	 */

	function reviews_post_type() {

		$labels = array(
			'name'               => _x( 'Відгуки', 'post type general name', 'solid' ),
			'singular_name'      => _x( 'Відгуки', 'post type singular name', 'solid' ),
			'menu_name'          => _x( 'Відгуки', 'admin menu', 'solid' ),
			'name_admin_bar'     => _x( 'Відгуки', 'add new on admin bar', 'solid' ),
			'add_new'            => _x( 'Додати новий відгук', 'actions', 'solid' ),
			'add_new_item'       => __( 'Додати новий відгук', 'solid' ),
			'new_item'           => __( 'Новий відгук', 'solid' ),
			'edit_item'          => __( 'Редагувати відгук', 'solid' ),
			'view_item'          => __( 'Переглянути відгук', 'solid' ),
			'all_items'          => __( 'Всі відгуки', 'solid' ),
			'search_items'       => __( 'Шукати відгук', 'solid' ),
			'parent_item_colon'  => __( 'Батько відгуку:', 'solid' ),
			'not_found'          => __( 'Відгук не знайдено.', 'solid' ),
			'not_found_in_trash' => __( 'У кошику відгук не знайдено.', 'solid' )
		);

		$args = array(
			'labels'             => $labels,
			'taxonomies'         => [],
			'description'        => __( 'Описание.', 'solid' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'reviews' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => 5,
			'menu_icon'          => 'dashicons-format-status',
			'supports'           => array( 'title', 'thumbnail',)
		);

		register_post_type( 'reviews', $args );
	}

	add_action( 'init', 'reviews_post_type' );