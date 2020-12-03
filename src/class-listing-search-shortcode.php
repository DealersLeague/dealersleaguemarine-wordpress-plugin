<?php

namespace dealersleague\marine\wordpress;

class Listing_Search_Shortcode {

	public function init(): void {

		add_shortcode( 'listing_search', array( $this, 'shortcode_listing_search' ) );

	}

	/**
	 * Usage: [listing_search result_page="http://results.com"]
	 * If result_page is not defined or empty, we stay in the same page the shortcode is placed
	 *
	 * @param mixed $attr
	 *
	 * @return string
	 */
	public function shortcode_listing_search( $attr ): string {

		$settings = new Settings_Page();
		$settings->refresh_options();

		// Prefill form fields with the search items
		if ( ! empty( $_GET['manufacturer'] ) ) {
			$search_manufacturer = $_GET['manufacturer'];
		}
		if ( ! empty( $_GET['category'] ) ) {
			$search_category = $_GET['category'];
		}
		if ( ! empty( $_GET['price'] ) ) {
			$search_price = $_GET['price'];
		}
		if ( ! empty( $_GET['age'] ) ) {
			$search_age = $_GET['age'];
		}
		if ( ! empty( $_GET['fuel'] ) ) {
			$search_fuel = $_GET['fuel'];
		}
		if ( ! empty( $_GET['country'] ) ) {
			$search_country = $_GET['country'];
		}
		if ( ! empty( $_GET['colour'] ) ) {
			$search_colour = $_GET['colour'];
		}

		ob_start();
		$action_url = empty( $attr[ 'result_page' ] ) ? '' : $attr[ 'result_page' ];
		// Get template file output
		include plugin_dir_path( __FILE__ ) . '../templates/content-archive-search.php';
		return ob_get_clean();

	}

}