<?php

namespace dealersleague\marine\wordpress;

class Dealers_League_Marine {

	private $api_object;

	public function load(): void {
		(new Settings_Page())->init();
		(new Boat_Post_Type())->init();
		$this->api_object = new Api();
		$this->api_object->init();

        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'public_scripts' ) );

		add_action( 'wp_ajax_dealers-league-marine_refresh_listings', array( $this, 'refresh_listings' ) );
		add_action( 'wp_ajax_nopriv_dealers-league-marine_refresh_listings', array( $this, 'refresh_listings' ) );

		//add_filter( 'single_template', array( $this, 'load_single_template' ) );
		//add_filter( 'singular_template', array( $this, 'load_single_template' ) );

		add_filter( 'the_content', array( $this, 'listing_content' ), -1 );

	}

	public function admin_scripts(): void {
		wp_register_style( 'dealers-league-marine-admin-css', plugins_url( 'css/dealers-league-marine-admin.css', __DIR__ ), false, '1.0.1' );
		wp_enqueue_style( 'dealers-league-marine-admin-css' );
		wp_enqueue_script( 'dealers-league-marine-admin-js', plugins_url( 'js/dealers-league-marine-admin.js', __DIR__ ), array( 'jquery' ), false, true );
	}

	public function public_scripts(): void {

		wp_register_style(
			'dealers-league-marine-css',
			plugins_url('css/dealers-league-marine.css' , __DIR__ ),
			false,
			'1.0.0'
		);
		wp_enqueue_style( 'dealers-league-marine-css' );
		wp_register_script(
			'jquery-validation',
			plugins_url( 'js/jquery-validation-1-19-1/jquery.validate.min.js' , __DIR__ ),
			array( 'jquery' ),
			false,
			true
		);
		wp_register_script(
			'dealers-league-marine-js',
			plugins_url( 'js/dealers-league-marine-public.js', __DIR__ ),
			array( 'jquery', 'jquery-validation' ),
			false,
			true
		);
		wp_localize_script(
			'dealers-league-marine-js',
			'dealers_league_marine_params',
			array(
				'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
			)
		);
		wp_enqueue_script( 'dealers-league-marine-js' );

	}

	/*
	public function load_single_template( $template ) {
		global $post;

		if ( Boat_Post_Type::get_post_type_name() === $post->post_type && locate_template( array( 'single-' . Boat_Post_Type::get_post_type_name() . '.php' ) ) !== $template ) {
			return plugin_dir_path( __FILE__ ) . '../templates/single-listing.php';
		}

		return $template;
	}
	*/

	public function listing_content( $content ) {
		global $post;

		// Check if we're in the right post type and single post
		if ( $post->post_type === Boat_Post_Type::get_post_type_name() && is_singular() ) {
			return 'MY LISTING CONTENT';
		}

		return $content;
	}

	/**
	 * Ajax handler for refreshing listings from the settings page
	 */
	public function refresh_listings() {

		try {
			$result = array( 'status' => 'NOK', 'message' => '' );
			$added_posts = [];

			$listings = $this->api_object->get_listings( -1 );

			if ( is_array( $listings['listings'] ) && $listings['totalCount'] > 0 ) {

				foreach ( $listings['listings'] as $listing_data ) {

					$args = array(
						'posts_per_page' => 1,
						'post_type'      => Boat_Post_Type::get_post_type_name(),
						'meta_key'       => 'listing_external_id',
						'meta_value'     => $listing_data[ 'id' ],
					);
					$boat_posts = get_posts( $args );

					$boat_data = array(
						'post_title'   => $listing_data[ 'name' ],
						'post_content' => '',
						'post_status'  => 'publish',
						'post_type'    => Boat_Post_Type::get_post_type_name()
					);

					if ( ! empty( $boat_posts ) ) {
						$boat_data['ID'] = $boat_posts[0]->ID;
						$post_id = wp_update_post( $boat_data );
					} else {
						$post_id = wp_insert_post( $boat_data );
					}

					$json_data = json_decode( $listing_data['json_data'], true );
					update_post_meta( $post_id, 'listing_external_id', $listing_data[ 'id' ] );
					update_post_meta( $post_id, 'listing_json_data', maybe_serialize( $json_data ) );

					if ( isset( $json_data['listing']['listing_meta']['advert']['advert_type'] ) ) {
						$boat_type = $json_data['listing']['listing_meta']['advert']['advert_type'];
						update_post_meta( $post_id, 'listing_boat_type', $boat_type );
					} else {
						delete_post_meta( $post_id, 'listing_boat_type' );
					}
					if ( isset( $json_data['listing']['boat_details']['boat_types']['boat_types'][0] ) ) {
						$category = $json_data['listing']['boat_details']['boat_types']['boat_types'][0];
						update_post_meta( $post_id, 'listing_category', $category );
					} else {
						delete_post_meta( $post_id, 'listing_category' );
					}
					if ( isset( $json_data['listing']['boat_details']['sales_details']['construction_details']['dimension']['loa']['number'] ) ) {
						$loa = $json_data['listing']['boat_details']['sales_details']['construction_details']['dimension']['loa']['number'];
						update_post_meta( $post_id, 'listing_loa', $loa );
					} else {
						delete_post_meta( $post_id, 'listing_loa' );
					}
					if ( isset( $json_data['listing']['boat_details']['sales_details']['construction_details']['dimension']['beam']['number'] ) ) {
						$beam = $json_data['listing']['boat_details']['sales_details']['construction_details']['dimension']['beam']['number'];
						update_post_meta( $post_id, 'listing_beam', $beam );
					} else {
						delete_post_meta( $post_id, 'listing_beam' );
					}
					if ( isset( $json_data['listing']['boat_details']['sales_details']['construction_details']['dimension']['draught']['number'] ) ) {
						$draught = $json_data['listing']['boat_details']['sales_details']['construction_details']['dimension']['draught']['number'];
						update_post_meta( $post_id, 'listing_draught', $draught );
					} else {
						delete_post_meta( $post_id, 'listing_draught' );
					}
					if ( isset( $json_data['listing']['boat_details']['construction_details']['model'] ) ) {
						$model = $json_data['listing']['boat_details']['construction_details']['model'];
						update_post_meta( $post_id, 'listing_model', $model );
					} else {
						delete_post_meta( $post_id, 'listing_model' );
					}
					if ( isset( $json_data['listing']['boat_details']['construction_details']['manufacturer']['name'][0] ) ) {
						$manufacturer = $json_data['listing']['boat_details']['construction_details']['manufacturer']['name'][0];
						update_post_meta( $post_id, 'listing_manufacturer', $manufacturer );
					} else {
						delete_post_meta( $post_id, 'listing_manufacturer' );
					}
					if ( isset( $json_data['listing']['listing_details']['sales_details']['sale_status'] ) ) {
						$sale_status = $json_data[ 'listing' ][ 'listing_details' ][ 'sales_details' ]['sale_status'];
						update_post_meta( $post_id, 'listing_sale_status', $sale_status );
					} else {
						delete_post_meta( $post_id, 'listing_sale_status' );
					}
					if ( isset( $json_data['listing']['listing_details']['sales_details']['vat']['status'][0] ) ) {
						$vat_status = $json_data[ 'listing' ][ 'listing_details' ][ 'sales_details' ]['vat']['status'][0];
						update_post_meta( $post_id, 'listing_vat_status', $vat_status );
					} else {
						delete_post_meta( $post_id, 'listing_vat_status' );
					}
					if ( isset( $json_data['listing']['listing_details']['sales_details']['location']['country'][0] ) ) {
						$country = $json_data[ 'listing' ][ 'listing_details' ][ 'sales_details' ]['location']['country'][0];
						update_post_meta( $post_id, 'listing_location_country', $country );
					} else {
						delete_post_meta( $post_id, 'listing_location_country' );
					}
					if ( isset( $json_data['listing']['listing_details']['sales_details']['location']['city'][0] ) ) {
						$city = $json_data[ 'listing' ][ 'listing_details' ][ 'sales_details' ]['location']['city'][0];
						update_post_meta( $post_id, 'listing_location_city', $city );
					} else {
						delete_post_meta( $post_id, 'listing_location_country' );
					}
					if ( isset( $json_data['listing']['listing_details']['sales_details']['condition'] ) ) {
						$condition = $json_data[ 'listing' ][ 'listing_details' ][ 'sales_details' ][ 'condition' ];
						update_post_meta( $post_id, 'listing_condition', $condition );
					} else {
						delete_post_meta( $post_id, 'listing_condition' );
					}
					if ( isset( $json_data['listing']['listing_details']['sales_details']['price']['price'][0] ) ) {
						$price = $json_data[ 'listing' ][ 'listing_details' ][ 'sales_details' ][ 'price' ][ 'price' ][ 0 ];
						update_post_meta( $post_id, 'listing_price', $price );
					} else {
						delete_post_meta( $post_id, 'listing_price' );
					}
					if ( isset( $json_data['listing']['listing_details']['sales_details']['price']['currency'][0] ) ) {
						$currency = $json_data[ 'listing' ][ 'listing_details' ][ 'sales_details' ][ 'price' ][ 'currency' ][ 0 ];
						update_post_meta( $post_id, 'listing_currency', $currency );
					} else {
						delete_post_meta( $post_id, 'listing_currency' );
					}
					// Get first image as cover image
					if ( !empty($json_data[ 'fileuploader-list-listing_images' ] ) ) {

						$image_list = json_decode( $json_data[ 'fileuploader-list-listing_images' ], true );

						if ( isset( $image_list[ 0 ][ 'file' ] ) ) {
							update_post_meta( $post_id, 'listing_featured_image', $image_list[ 0 ][ 'file' ] );
						} else {
							delete_post_meta( $post_id, 'listing_featured_image' );
						}

					}

					$added_posts[] = $post_id;
				}
				$result['status'] = 'OK';
				$result['listings'] = $listings['listings'];
				$result['html'] = '<span class="refresh-result" style="margin-left: 5px;color:#058305;">' . $listings['totalCount'] . ' ' . __( 'listings', 'dlcrm' ) . '</span>';
			} else {
				$result['message'] = 'No listings found';
			}
		} catch ( \Exception $e ) {
			$result['message'] = $e->getMessage();
			wp_send_json( $result );
			wp_die($e->getMessage());
		}
		wp_send_json( $result );
	}



}
