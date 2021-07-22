<?php

namespace dealersleague\marine\wordpress;

use dealersleague\marine\Client as Api_Client;

class Api {

	/** @var Api_Client */
	private $client = null;

	/**
	 * @param Settings_Page|null $settings_page
	 */
	public function init( Settings_Page $settings_page = null ): void {
		try {
		    if ( null === $settings_page ) {
			    $settings_page = new Settings_Page();
		    }
			$settings_page->refresh_options();
			$email   = $settings_page->get_option_val( 'dealers_league_marine_email' );
			$api_key = $settings_page->get_option_val( 'dealers_league_marine_api_key' );
			$api_url = $settings_page->get_option_val( 'dealers_league_marine_api_url' );

			if ( ! empty( $email ) && ! empty( $api_key ) && ! empty( $api_url ) ) {
				$this->client = new Api_Client( $email, $api_key );
				$this->client->setApiUrl( $api_url );
			}

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
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function get_country_list() {
		try {
			$country_list = [];

			if ( ! empty( $this->client ) ) {
				$country_list = $this->client->getCountries();
			}

			return $country_list;
		}catch (\Exception $e ) {
			var_dump($e);die;
		}
	}

	/**
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function get_category_list() {
		try {
			$category_list = [];

			if ( ! empty( $this->client ) ) {
				$category_list = $this->client->getCategories();
			}

			return $category_list;
		}catch (\Exception $e ) {
			var_dump($e);die;
		}
	}

	/**
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function get_colour_tag_list() {
		try {
			$colour_list = [];

			if ( ! empty( $this->client ) ) {
				$colour_list = $this->client->getColourTags();
			}

			return $colour_list;
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
	 * @return array|mixed|string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function get_integration() {
		$integrations = [];

		if ( ! empty( $this->client ) ) {
			$integrations = $this->client->getIntegrations();
		}
		return $integrations;
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

	/**
	 * @param int $page
	 *
	 * @return array|mixed|string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function get_brokers( $page = 0 ) {
		$brokers = [];

		if ( ! empty( $this->client ) ) {
			$brokers = $this->client->getBrokersPage( $page );
		}
		return $brokers;

	}

	/**
	 * @param $listing_analytic_list
	 *
	 * @return array|mixed|string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function send_analytics( $listing_analytic_list ) {
		$response = [];
		if ( ! empty( $this->client ) ) {
			$response = $this->client->sendAnalytics( $listing_analytic_list );
			
		}
		return $response;
	}

	/**
	 * @param $id, $type
	 *
	 * @return array|mixed|string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */     
	public function send_listing_id($id, $type) {
		$response = [];
		if ( ! empty( $this->client ) ) {
			$response = $this->client->sendListingid( $id, $type );
		}
		return $response;
	}
}