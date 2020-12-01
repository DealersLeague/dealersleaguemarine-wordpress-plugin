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

		$settings = new Settings_Page();
		$settings->refresh_options();

		$conditions = [];

		if ( ! empty( $attr[ 'category' ] ) ) {
			$conditions[] = array(
				'key'     => 'listing_category',
				'value'   => $attr[ 'category' ],
				'compare' => '=',
			);
		}
		if ( ! empty( $attr[ 'manufacturer' ] ) ) {
			$conditions[] = array(
				'key'     => 'listing_manufacturer',
				'value'   => $attr[ 'manufacturer' ],
				'compare' => '=',
			);
		}
		if ( ! empty( $attr[ 'location' ] ) ) {
			$conditions[] = array(
				'key'     => 'listing_location',
				'value'   => $attr[ 'location' ],
				'compare' => '=',
			);
		}

		$posts_per_page = $settings->get_web_settings_option_val( 'items_per_page' );
		$args = array(
			'post_type'      => Boat_Post_Type::get_post_type_name(),
			'post_status'    => 'publish',
			'posts_per_page' => empty( $posts_per_page ) ? 10 : $posts_per_page
		);

		if ( ! empty( $conditions ) ) {
			if ( count( $conditions ) > 1 ) {
				$conditions[ 'relation' ] = 'AND';
			}
			$args['meta_query'] = $conditions;
		}

		ob_start();
		// Get template file output
		$layout_type = strtolower( $settings->get_web_settings_option_val( 'listing_layout' ) );
		$listings    = new \WP_Query( $args );
		include plugin_dir_path( __FILE__ ) . '../templates/content-archive-listing.php';
		return ob_get_clean();

	}


}