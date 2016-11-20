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
			'labels'             	=> $labels,
	        'description'        	=> __( 'Description.', 'movementmedia' ),
			'public'             	=> true,
			'publicly_queryable'	=> true,
			'show_ui'           	=> true,
			'show_in_menu'      	=> true,
			'query_var'         	=> true,
			'rewrite'           	=> array( 'slug' => 'videos' ),
			'capability_type'   	=> 'post',
			'has_archive'       	=> true,
			'hierarchical'      	=> false,
			'menu_position'     	=> 5,
			'menu_icon'				=> 'dashicons-format-video',
			'supports'           	=> array( 'title', 'editor', 'author', 		'thumbnail', 'excerpt', 'comments' ),
			'taxonomies'   			=> array( 'movementmedia_videos',  'post_tag', 'category' ),
		);

	register_post_type( 'movementmedia_videos', $args );
}

add_action('init', 'create_postTypes' );

function movementmedia_add_custom_types( $query ) {
    if( is_tag() && $query->is_main_query() ) {

        // this gets all post types:
        $post_types = get_post_types();

        // alternately, you can add just specific post types using this line instead of the above:
        // $post_types = array( 'post', 'your_custom_type' );

        $query->set( 'post_type', $post_types );
    }
}
add_filter( 'pre_get_posts', 'movementmedia_add_custom_types' );


/**
 * Flush rewrite rules to make custom ULRs active
 */
function movementmedia_rewrite_flush() {
    create_postTypes(); //
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'movementmedia_rewrite_flush' );

/* Custom Taxonomies */

function custom_taxonomies(){
	/* Client Name */
	$labels = array(
	'name'                       => _x( 'Clients', 'taxonomy general name', 'movementmedia' ),
	'singular_name'              => _x( 'Client', 'taxonomy singular name', 'movementmedia' ),
	'search_items'               => __( 'Search Clients', 'movementmedia' ),
	'popular_items'              => __( 'Popular Clients', 'movementmedia' ),
	'all_items'                  => __( 'All Clients', 'movementmedia' ),
	'parent_item'                => null,
	'parent_item_colon'          => null,
	'edit_item'                  => __( 'Edit Client', 'movementmedia' ),
	'update_item'                => __( 'Update Client', 'movementmedia' ),
	'add_new_item'               => __( 'Add New Client', 'movementmedia' ),
	'new_item_name'              => __( 'New Client Name', 'movementmedia' ),
	'separate_items_with_commas' => __( 'Separate Clients with commas', 'movementmedia' ),
	'add_or_remove_items'        => __( 'Add or remove Clients', 'movementmedia' ),
	'choose_from_most_used'      => __( 'Choose from the most used Clients', 'movementmedia' ),
	'not_found'                  => __( 'No Clients found.', 'movementmedia' ),
	'menu_name'                  => __( 'Clients', 'movementmedia' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'Client' ),
	);

	register_taxonomy(
		//name of taxonomy
		'client-name',
		//which post type it applies to:
		array('movementmedia_videos', 'post'),
		$args
		// array(
		// 	'label'			=> 'Client',
		// 	'rewrite'		=> array( 'slug' => 'client'),
		// 	'hierarchical'	=> true
		// )
	);
}

add_action( 'init', 'custom_taxonomies');



 ?>
