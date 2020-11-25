<?php

namespace dealersleague\marine\wordpress;

class Listing_Shortcode {

	public function init(): void {

		add_shortcode( 'listing_archive', [ $this, 'shortcode_listing_archive' ] );

	}

	/**
	 * Usage: [listing_archive category="my category" manufacturer="my manufacturer" location="my location"]
	 *
	 * @param mixed $attr
	 *
	 * @return string
	 */
	public function shortcode_listing_archive( $attr ): string {

		if ( empty( $attr[ 'id' ] ) ) {
			return '';
		}

		$args = array(
			'post_type' => Boat_Post_Type::get_post_type_name(),
			'post_status'      => 'publish',
			'posts_per_page' => -1,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'Fabricante',
					'value' => 'Disney',
					'compare' => '=',
				),
				array(
					'key' => 'precio',
					'value' => array(50,100),
					'type' => 'numeric',
					'compare' => 'BETWEEN',
				),
			),
		);
		$query_jueguete = new WP_Query( $args );

		$args = [
			'numberposts'      => 1,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => Boat_Post_Type::get_post_type_name(),
			'post_status'      => 'publish',
			'name'             => $attr[ 'id' ],
			'suppress_filters' => true
		];

		$form_post = get_posts( $args );

		if ( empty( $form_post ) ) {
			return '';
		}

		$form_post = $form_post[ 0 ];

		$form_field_list = maybe_unserialize( get_post_meta( $form_post->ID, 'addcomm_form_field_list', true ) );
		$form_action_url = get_post_meta( $form_post->ID, 'addcomm_form_action_url', true );

		if ( empty( $form_action_url ) || count( $form_field_list ) === 0 ) {
			return '';
		}

		$addcomm_forms_obj = new AddCommForms();
		$form_obj          = $addcomm_forms_obj->get_form_obj_from_post( $form_post->ID, [] );

		return $form_obj->render_form();

	}


}