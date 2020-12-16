<?php

namespace dealersleague\marine\wordpress;

class Cron_Task {

	public function init(): void {
		add_action( 'init', array( $this, 'init_analytics' ) );
		add_action( 'dealers_league_send_analytics_daily', array( $this, 'send_analytics' ) );
	}

	/**
	 * Schedule an action with the hook 'dealers_league_send_analytics_daily' to run at midnight each day
	 * so that our callback is run then.
	 */
	public function init_analytics() {

		if ( ! wp_next_scheduled( 'dealers_league_send_analytics_daily' ) ) {
			wp_schedule_event( strtotime( 'midnight tonight' ), 'daily', 'dealers_league_send_analytics_daily' );
		}

	}

	/**
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function send_analytics() {

		// Get all listings with visits
		$args = array(
			'posts_per_page' => - 1,
			'post_type'      => Boat_Post_Type::get_post_type_name(),
			'meta_query'     => array(
				'key'     => 'listing_visits',
				'value'   => 0,
				'compare' => '>',
			)
		);
		$boat_posts = get_posts( $args );

		$listing_analytic_list = [];

		foreach ( $boat_posts as $listing ) {

			$listing_id = get_post_meta( $listing->ID, 'listing_external_id', true );

			if ( ! empty( $listing_id ) ) {

				$visits                = get_post_meta( $listing->ID, 'listing_visits', true );
				$enquiries             = get_post_meta( $listing->ID, 'listing_enquiries', true );
				$last_export_visits    = get_post_meta( $listing->ID, 'listing_last_export_visits', true );
				$last_export_enquiries = get_post_meta( $listing->ID, 'listing_last_export_enquiries', true );

				$listing_analytic_list[ $listing_id ] = [
					'total_visits'    => $visits,
					'today_visits'    => empty( $last_export_visits ) ? $visits : $visits - $last_export_visits,
					'total_enquiries' => $enquiries,
					'today_enquiries' => empty( $last_export_enquiries ) ? $enquiries : $enquiries - $last_export_enquiries,
				];

				update_post_meta( $listing->ID, 'listing_last_export_visits', $visits );
				update_post_meta( $listing->ID, 'listing_last_export_enquiries', $enquiries );

			}
		}

		if ( ! empty( $listing_analytic_list ) ) {

			// Getting options from API
			$api_object = new Api();
			$api_object->init();


			$api_object->send_analytics( $listing_analytic_list );
		}

	}

}