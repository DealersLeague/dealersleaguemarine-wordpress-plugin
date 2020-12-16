<?php

namespace dealersleague\marine\wordpress;;

class Boat_Post_Type {

    private static $post_type_name = 'newboat';

    public function init(): void {
        add_action( 'init', array( $this, 'create_post_type' ) );
	    add_filter( 'enter_title_here', array( $this, 'custom_title_text' ) );
    }

    public static function get_post_type_name(): string {
        return self::$post_type_name;
    }

    public function create_post_type(): void {

        $labels = array(
            'name'               => _x( 'Boats', 'post type general name', 'dlmarine' ),
            'singular_name'      => _x( 'Boat', 'post type singular name', 'dlmarine' ),
            'menu_name'          => _x( 'Boats', 'admin menu', 'dlmarine' ),
            'name_admin_bar'     => _x( 'Form', 'add new on admin bar', 'dlmarine' ),
            'add_new'            => _x( 'Add New', self::$post_type_name, 'dlmarine' ),
            'add_new_item'       => __( 'Add New Boat', 'dlmarine' ),
            'new_item'           => __( 'New Boat', 'dlmarine' ),
            'edit_item'          => __( 'Edit Boat', 'dlmarine' ),
            'view_item'          => __( 'View Boat', 'dlmarine' ),
            'all_items'          => __( 'All Boats', 'dlmarine' ),
            'search_items'       => __( 'Search Boats', 'dlmarine' ),
            'parent_item_colon'  => __( 'Parent Boat:', 'dlmarine' ),
            'not_found'          => __( 'No boats found.', 'dlmarine' ),
            'not_found_in_trash' => __( 'No boats found in Trash.', 'dlmarine' )
        );

	    $args = array(
		    'labels'             => $labels,
		    'public'             => true,
		    'publicly_queryable' => true,
		    'show_ui'            => true,
		    'show_in_menu'       => false,
		    'query_var'          => true,
		    'rewrite'            => array( 'slug' => 'newboat' ),
		    'capability_type'    => 'post',
		    'has_archive'        => true,
		    'hierarchical'       => false,
		    'menu_position'      => null,
		    'supports'           => array( 'title' ),
		    'show_in_rest'       => true,
	    );

        register_post_type( self::$post_type_name, $args );
    }

	/**
	 * @param $title
	 *
	 * @return string
	 */
    public function custom_title_text( $title ): string {
        $screen = get_current_screen();

        if  ( null !== $screen && self::$post_type_name === $screen->post_type ) {
            $title = __( 'Enter the Boat name', 'dlmarine' );
        }

        return $title;
    }

}