<?php

namespace dealersleague\marine\wordpress;

use WP_REST_Request;

class Webhook {

	/**
	 * Define the necessary custom endpoints
	 */
	public function init(): void {

		add_action( 'rest_api_init', function () {
			register_rest_route( 'dealers-league-marine/v1', '/update-listing/', array(
				'methods' => 'POST',
				'callback' => array( $this, 'update_listing' ),
			) );
		} );

		add_action( 'rest_api_init', function () {
			register_rest_route( 'dealers-league-marine/v1', '/update-web-settings/', array(
				'methods' => 'POST',
				'callback' => array( $this, 'update_qwb_settings' ),
			) );
		} );

		add_action( 'rest_api_init', function () {
			register_rest_route( 'dealers-league-marine/v1', '/update-integrations/', array(
				'methods' => 'POST',
				'callback' => array( $this, 'update_integrations' ),
			) );
		} );

	}

	/**
	 * @param $settings
	 *
	 * @return bool
	 */
	private function is_auth( $settings ) {

		$has_supplied_credentials = ! empty( $_SERVER[ 'PHP_AUTH_USER' ] ) && ! empty( $_SERVER[ 'PHP_AUTH_PW' ] );

		$settings->refresh_options();
		$api_url      = $settings->get_option_val( 'dealers_league_marine_api_url' );
		$api_url      = str_replace( 'api.', '', $api_url );
		$url_params   = parse_url( $api_url );
		$allowed_host = empty( $url_params[ 'host' ] ) ? '' : $url_params[ 'host' ];
		$host         = $url_params[ 'host' ]; //parse_url( $_SERVER['HTTP_REFERER'], PHP_URL_HOST );

		if ( substr( $host, 0 - strlen( $allowed_host ) ) == $allowed_host ) {

			$AUTH_PASS        = $settings->get_option_val( 'dealers_league_marine_api_key' );
			$is_authenticated = $has_supplied_credentials && $_SERVER[ 'PHP_AUTH_PW' ] == $AUTH_PASS;

		} else {
			$is_authenticated = false;
		}

		return $is_authenticated;

	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function update_listing( WP_REST_Request $request ) {

		try {

			$settings = new Settings_Page();
			$settings->refresh_options();

			$is_auth = $this->is_auth( $settings );

			if ( $is_auth ) {
				header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
				$listing_data = $request->get_params();
				Dealers_League_Marine::update_listing_data( $listing_data );
				$settings->save_search_form_options();
			} else {
				header( 'HTTP/1.1 401 Authorization Required' );
				header( 'WWW-Authenticate: Basic realm="Access denied"' );
				exit;
			}

			header( 'HTTP/1.1 200 OK' );
			exit;

		} catch ( \Exception $e ) {
			header( 'HTTP/1.1 404 Bad Request' );
			exit;
		}

	}

	/**
	 * @param WP_REST_Request $request
	 */
	public function update_web_settings( WP_REST_Request $request ) {

		try {

			$settings = new Settings_Page();
			$settings->refresh_options();

			$is_auth = $this->is_auth( $settings );

			if ( $is_auth ) {
				header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
				$web_settings = $request->get_params();
				$settings->save_web_settings_options( $web_settings );
			} else {
				header( 'HTTP/1.1 401 Authorization Required' );
				header( 'WWW-Authenticate: Basic realm="Access denied"' );
				exit;
			}

			header( 'HTTP/1.1 200 OK' );
			exit;

		} catch ( \Exception $e ) {
			header( 'HTTP/1.1 404 Bad Request' );
			exit;
		}

	}

	/**
	 * @param WP_REST_Request $request
	 */
	public function update_integrations( WP_REST_Request $request ) {

		try {

			$settings = new Settings_Page();
			$settings->refresh_options();

			$is_auth = $this->is_auth( $settings );

			if ( $is_auth ) {
				header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
				$integrations = $request->get_params();
				$settings->save_integrations_options( $integrations );
			} else {
				header( 'HTTP/1.1 401 Authorization Required' );
				header( 'WWW-Authenticate: Basic realm="Access denied"' );
				exit;
			}

			header( 'HTTP/1.1 200 OK' );
			exit;

		} catch ( \Exception $e ) {
			header( 'HTTP/1.1 404 Bad Request' );
			exit;
		}

	}

}