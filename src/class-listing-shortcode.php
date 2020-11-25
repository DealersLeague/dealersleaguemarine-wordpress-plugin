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

		$conditions = [];

		if ( empty( $attr[ 'category' ] ) ) {
			$conditions[] = array(
				'key'     => 'listing_category',
				'value'   => $attr[ 'category' ],
				'compare' => '=',
			);
		}
		if ( empty( $attr[ 'manufacturer' ] ) ) {
			$conditions[] = array(
				'key'     => 'listing_manufacturer',
				'value'   => $attr[ 'manufacturer' ],
				'compare' => '=',
			);
		}
		if ( empty( $attr[ 'location' ] ) ) {
			$conditions[] = array(
				'key'     => 'listing_location',
				'value'   => $attr[ 'location' ],
				'compare' => '=',
			);
		}

		$args = array(
			'post_type'   => Boat_Post_Type::get_post_type_name(),
			'post_status' => 'publish',
		);

		if ( ! empty( $conditions ) && count( $conditions ) > 1 ) {
			$conditions['relation'] = 'AND';
			$args['meta_query']     = $conditions;
		}

		$listings = new \WP_Query( $args );

		return '';

	}


}