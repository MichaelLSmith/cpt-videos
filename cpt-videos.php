<?php
/**
* Plugin Name: CPT-videos
* Description: A simple plugin that adds videos post type
* Version 0.1
* Author: Michael Laurence Smith
* License: GPL2
**/
/**
* CPT-videos is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.
* CPT-videos is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
**/

// Video Post-type function
function create_postTypes() {
	$labels = array(
		'name'               => _x( 'Videos', 'post type general name', 'movementmedia' ),
		'singular_name'      => _x( 'Video', 'post type singular name', 'movementmedia' ),
		'menu_name'          => _x( 'Videos', 'admin menu', 'movementmedia' ),
		'name_admin_bar'     => _x( 'Video', 'add new on admin bar', 'movementmedia' ),
		'add_new'            => _x( 'Add New', 'Video', 'movementmedia' ),
		'add_new_item'       => __( 'Add New Video', 'movementmedia' ),
		'new_item'           => __( 'New Video', 'movementmedia' ),
		'edit_item'          => __( 'Edit Video', 'movementmedia' ),
		'view_item'          => __( 'View Video', 'movementmedia' ),
		'all_items'          => __( 'All Videos', 'movementmedia' ),
		'search_items'       => __( 'Search Videos', 'movementmedia' ),
		'parent_item_colon'  => __( 'Parent Videos:', 'movementmedia' ),
		'not_found'          => __( 'No Videos found.', 'movementmedia' ),
		'not_found_in_trash' => __( 'No Videos found in Trash.', 'movementmedia' )
	);

	// CPT Options
	$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Description.', 'movementmedia' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'video' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);

	register_post_type( 'movementmedia_videos', $args );
}

add_action('init', 'create_postTypes' )


/**
 * Flush rewrite rules to make custom ULRs active
 */
function wpcampuscpt_rewrite_flush() {
    create_postTypes(); //
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'wpcampuscpt_rewrite_flush' );


 ?>
