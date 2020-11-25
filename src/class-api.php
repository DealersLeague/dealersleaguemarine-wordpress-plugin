<?php

namespace dealersleague\marine\wordpress;

use dealersleague\marine\Client as Api_Client;

class Api {

	/** @var Api_Client */
	private $client;

	public function init(): void {
		try {
			$settings_page = new Settings_Page();
			$settings_page->refresh_options();
			$email   = $settings_page->get_option_val( 'dealers_league_marine_email' );
			$api_key = $settings_page->get_option_val( 'dealers_league_marine_api_key' );

			$this->client = new Api_Client( $email, $api_key );
			$this->client->setApiUrl( 'http://api.dlcrm.local/v1' );

		} catch ( \Exception $e ) {
			add_action( 'admin_notices', array( $this, 'error_api_notice', $e ) );
		}

	}

	/**
	 * @param \Exception $e
	 */
	public function error_api_notice( \Exception $e ) {
		?>
		<div class="notice error is-dismissible" >
			<p><?php echo $e->getMessage(); ?></p>
		</div>

		<?php
	}

	/**
	 * @return Api_Client
	 */
	public function get_client() {
		return $this->client;
	}

	/**
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function get_manufacturer_list() {
		try {
			$manufacturer_list = [];

			if ( ! empty( $this->client ) ) {
				$manufacturer_list = $this->client->getManufacturers();
			}

			return $manufacturer_list;
		}catch (\Exception $e ) {
			var_dump($e);die;
		}
	}

	/**
	 * @return array|mixed|string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function get_web_settings() {
		$settings = [];

		if ( ! empty( $this->client ) ) {
			$settings = $this->client->getSettings();
		}

		return $settings;
	}

	/**
	 * @param int $page
	 *
	 * @return array|mixed|string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function get_listings( $page = 0 ) {
		$listings = [];

		if ( ! empty( $this->client ) ) {
			$listings = $this->client->getListingsPage( $page );
		}

		return $listings;

	}
}

