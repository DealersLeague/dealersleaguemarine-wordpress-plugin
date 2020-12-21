<?php

namespace dealersleague\marine\wordpress;

class Listing_Carousel_Shortcode {

	public function init(): void {

		add_shortcode( 'listing_carousel', array( $this, 'shortcode_listing_carousel' ) );

	}

	/**
	 * Usage: [listing_carousel category="my category" manufacturer="my manufacturer" country="DE" condition="new|used" show_details="true|false"]
	 *
	 * @param mixed $attr
	 *
	 * @return string
	 */
	public function shortcode_listing_carousel( $attr ): string { 

		$settings = new Settings_Page();
		$settings->refresh_options();

		$conditions = [];

		$search_manufacturer = $attr[ 'manufacturer' ] ?? '';
		if ( ! empty( $search_manufacturer ) ) {
			$conditions[] = array(
				'key'     => 'listing_manufacturer',
				'value'   => strtolower( $search_manufacturer ),
				'compare' => '=',
			);
		}

		$search_category = $attr[ 'category' ] ?? '';
		if ( ! empty( $search_category ) ) {
			$conditions[] = array(
				'key'     => 'listing_category',
				'value'   => strtolower( $search_category ),
				'compare' => '=',
			);
		}

		$search_condition = $attr[ 'condition' ] ?? '';
		if ( ! empty( $search_condition ) ) {
			$conditions[] = array(
				'key'     => 'listing_sale_class',
				'value'   => strtolower( $search_condition ),
				'compare' => '=',
			);
		}

		$search_country = $attr[ 'country' ] ?? '';
		if ( ! empty( $search_country ) && $search_country != 'all' ) {
			$conditions[] = array(
				'key'     => 'listing_location_country',
				'value'   => strtolower( $search_country ),
				'compare' => '=',
			);
		} 
      
		$args = array(
			'post_type'      => Boat_Post_Type::get_post_type_name(),
			'post_status'    => 'publish', 
		);

		if ( ! empty( $conditions ) ) {
			if ( count( $conditions ) > 1 ) {
				$conditions[ 'relation' ] = 'AND';
			}
			$args['meta_query'] = $conditions;
		}

		 
		ob_start();
		// Get template file output 
		$show_details = ( empty( $attr[ 'show_details' ] ) ? false : $attr[ 'show_details' ] );
		$listings	  = new \WP_Query( $args );
		include plugin_dir_path( __FILE__ ) . '../templates/content-archive-carousel.php'; 
		return ob_get_clean();

	}
  
}