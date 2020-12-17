<?php

namespace dealersleague\marine\wordpress;

class Dealers_League_Marine {

	private $api_object;

	public function load(): void {
		(new Settings_Page())->init();
		(new Boat_Post_Type())->init();
		(new Listing_Search_Shortcode())->init();
		(new Listing_Shortcode())->init();
		(new Webhook())->init();
		(new Cron_Task())->init();
		$this->api_object = new Api();
		$this->api_object->init();

        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'public_scripts' ) );

		add_action( 'wp_ajax_dealers-league-marine_refresh_listings', array( $this, 'refresh_listings' ) );
		add_action( 'wp_ajax_nopriv_dealers-league-marine_refresh_listings', array( $this, 'refresh_listings' ) );
		add_action( 'wp_ajax_dealers-league-marine_send_enquiry', array( $this, 'send_enquiry' ) );
		add_action( 'wp_ajax_nopriv_dealers-league-marine_send_enquiry', array( $this, 'send_enquiry' ) );

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
			'dealers-league-marine-google-fonts',
			'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Varela+Round',
			false,
			'1.0.0'
		);
		wp_enqueue_style( 'dealers-league-marine-google-fonts' );

		wp_register_style(
			'dealers-league-marine-bootstrap-css',
			plugins_url('css/bootstrap/bootstrap.css' , __DIR__ ),
			false,
			'1.0.0'
		);
		wp_enqueue_style( 'dealers-league-marine-bootstrap-css' );

		wp_register_style(
			'dealers-league-marine-font-awesome',
			plugins_url('fonts/font-awesome.css' , __DIR__ ),
			false,
			'1.0.0'
		);
		wp_enqueue_style( 'dealers-league-marine-font-awesome' );

		wp_register_style(
			'dealers-league-marine-selectize-css',
			plugins_url('css/selectize.css' , __DIR__ ),
			false,
			'1.0.0'
		);
		wp_enqueue_style( 'dealers-league-marine-selectize-css' );

		wp_register_style(
			'dealers-league-marine-owl-css',
			plugins_url('css/owl.carousel.min.css' , __DIR__ ),
			false,
			'1.0.0'
		);
		wp_enqueue_style( 'dealers-league-marine-owl-css' );

		wp_register_style(
			'dealers-league-marine-featherlight-css',
			plugins_url('css/featherlight.min.css' , __DIR__ ),
			false,
			'1.0.0'
		);
		wp_enqueue_style( 'dealers-league-marine-featherlight-css' );

		wp_register_style(
			'dealers-league-marine-panorama',
			plugins_url('css/panorama.css' , __DIR__ ),
			false,
			'1.0.0'
		);
		wp_enqueue_style( 'dealers-league-marine-panorama' );

		wp_register_style(
			'dealers-league-marine-craigs-css',
			plugins_url('css/craigs.css' , __DIR__ ),
			false,
			'1.0.0'
		);
		wp_enqueue_style( 'dealers-league-marine-craigs-css' );
 
		wp_register_style(
			'dealers-league-marine-css',
			plugins_url('css/dealers-league-marine.css' , __DIR__ ),
			false,
			'1.0.0'
		);
		wp_enqueue_style( 'dealers-league-marine-css' );


		wp_register_script(
			'dealers-league-marine-popper-js',
			plugins_url( 'js/popper.min.js' , __DIR__ ),
			array(),
			false,
			true
		);
		wp_enqueue_script( 'dealers-league-marine-popper-js' );

		wp_register_script(
			'dealers-league-marine-bootstrap-js',
			plugins_url( 'js/bootstrap/bootstrap.min.js' , __DIR__ ),
			array( 'jquery' ),
			false,
			true
		);
		wp_enqueue_script( 'dealers-league-marine-bootstrap-js' );

		wp_register_script(
			'dealers-league-marine-featherlight-js',
			plugins_url( 'js/featherlight.min.js' , __DIR__ ),
			array( 'jquery' ),
			false,
			true
		);
		wp_enqueue_script( 'dealers-league-marine-featherlight-js' );

		wp_register_script(
			'dealers-league-marine-selectize-js',
			plugins_url( 'js/selectize.min.js' , __DIR__ ),
			array( 'jquery' ),
			false,
			true
		);
		wp_enqueue_script( 'dealers-league-marine-selectize-js' );

		wp_register_script(
			'dealers-league-marine-icheck-js',
			plugins_url( 'js/icheck.min.js' , __DIR__ ),
			array( 'jquery' ),
			false,
			true
		);
		wp_enqueue_script( 'dealers-league-marine-icheck-js' );

		wp_register_script(
			'dealers-league-marine-owl-js',
			plugins_url( 'js/owl.carousel.min.js' , __DIR__ ),
			array( 'jquery' ),
			false,
			true
		);
		wp_enqueue_script( 'dealers-league-marine-owl-js' ); 


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
			array( 
				'jquery', 
				'jquery-validation',
				'dealers-league-marine-popper-js',
				'dealers-league-marine-bootstrap-js',
				'dealers-league-marine-selectize-js',
				'dealers-league-marine-icheck-js',
				'dealers-league-marine-owl-js'
			),
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


	public function load_single_template( $template ) {
		global $post;

		if ( Boat_Post_Type::get_post_type_name() === $post->post_type && locate_template( array( 'single-' . Boat_Post_Type::get_post_type_name() . '.php' ) ) !== $template ) {
			return plugin_dir_path( __FILE__ ) . '../templates/single-listing.php';
		}

		return $template;
	}


	public function listing_content( $content ) {
		global $post;

		// Check if we're in the right post type and single post
		if ( $post->post_type === Boat_Post_Type::get_post_type_name() && is_singular() ) {

			remove_filter('the_content', 'wpautop');
			remove_filter('the_excerpt', 'wpautop');
			ob_start();
			// Get template file output
			$listing_json_data = maybe_unserialize( get_post_meta( $post->ID, 'listing_json_data', true ) );
			$transformed_data = $this->transform_listing_data( $listing_json_data['listing'] );
			include plugin_dir_path( __FILE__ ) . '../templates/content-single-listing.php';
			return ob_get_clean();
		} 

		return $content;
	}

	/**
	 * @param $listing_data
	 *
	 * @return array
	 */
	public function transform_listing_data( $listing_data ) {

		$exclude_field_name = [ 'number', 'power', 'name', 'speed', 'currency', 'city', 'country', 'type', 'consumption' ];
		$transformed_fields = [];

		foreach ( $listing_data as $tab ) {

			foreach ( $tab as $section_name => $section ) {

				$remove_section = true;

				$transformed_fields[ $section_name ] = [];
				foreach ( $section as $field_name => $field_value ) {

					if ( is_array( $field_value ) ) {
						$subfield_text = '';
						foreach ( $field_value as $subfield_name => $subfield_value ) {
							if ( ! empty( $subfield_value ) ) {
								if ( is_array( $subfield_value ) ) {

									if ( $subfield_name != 'checked' && $subfield_name != $field_name && ! empty( $subfield_value[0] ) && ! in_array( $subfield_name, $exclude_field_name ) ) {
										$subfield_name = str_replace( '_', ' ', $subfield_name );
										$subfield_text .= '<strong>' . __( $subfield_name, 'dlmarine' ) . ( $subfield_value[0] == 'on' ? '</strong>' :  ':</strong>');
									}

									foreach ( $subfield_value as $index => $sv ) {
										$sv = str_replace( array('-', '_'), array(' ' ,' ' ), $sv );
										if ( ! empty( $sv ) ) {
											if ( $subfield_name != 'checked' && $subfield_name != $field_name && ! is_numeric( $index ) ) {
												$separator = $sv != 'on' ?  ': ' : '';
												$subfield_text .= ' ' . $index . $separator . __( $sv, 'dlmarine' ) . ( $field_name == 'boat_types' ? '' : '<br>' );
											} else {
												switch( $subfield_name ) {
													case 'boat_types':
														$subfield_text .= Utils::get_boat_type_name( $sv ) . '<br>';
														break;
													case 'currency':
														$subfield_text .= Utils::get_currency_symbol( $sv );
														break;
													case 'price':
														$currency = $listing_data[ 'listing_details' ][ 'sales_details' ][ 'price' ][ 'currency' ][ 0 ];
														$subfield_text .= Utils::format_price( $sv, $currency );
														break;
													case 'city':
														$subfield_text .= $sv  . (isset( $field_value['country'][0] ) ?  ', ' . Utils::get_country_name( $field_value['country'][0] ) : '' );
														break;
													case 'country':
														$subfield_text .= '';//Utils::get_country_name( $sv );
														break;
													default:
														$sv = str_replace( array('-','_'), array(' ',' '),$sv );
														$unit = Utils::get_unity( $subfield_name );
														$unit = empty( $unit ) ? Utils::get_unity( $field_name ) : $unit;
														$subfield_text .= ' ' . ucwords( $sv ) . $unit .'<br>';
												}
											}
										}
									}

								} elseif ( $subfield_name != 'checked' && $subfield_name != $field_name && ! in_array( $subfield_name, $exclude_field_name ) && ! is_numeric( $subfield_name ))  {
									$subfield_value = str_replace( array('-','_'), array(' ',' '), ' ', $subfield_value );
									$subfield_name = str_replace( array('-','_'), array(' ',' '), ' ', $subfield_name );
									$unit = Utils::get_unity( $subfield_name );
									$subfield_text .= '<strong>' . __( $subfield_name, 'dlmarine' ) . '</strong>' . ' ' . __( $subfield_value, 'dlmarine' ) . $unit . ' ';
								} elseif ( $field_name =='boat_types' ) {
									$subfield_text .= Utils::get_boat_type_name( $subfield_value ) . '<br>';
								} else {
									$subfield_value = str_replace( array('-','_'), array(' ',' '), ' ', $subfield_value );
									$subfield_name = str_replace( array('-','_'), array(' ',' '), ' ', $subfield_name );
									$unit = Utils::get_unity( $subfield_name );
									$subfield_text .= ucwords( __( $subfield_value, 'dlmarine' ) ) . $unit . '<br>';
								}
								$subfield_text = str_replace(
									['<br>On', 'On<br>'],
									['', ''],
									$subfield_text
								);
								$remove_section = empty( $subfield_text );
							}

						}
						if ( ! empty( $subfield_text ) ) {
							$transformed_fields[ $section_name ][ $field_name ] = ltrim( $subfield_text, '0');
						}

					} elseif (! empty( $field_value ) ) {
						$field_value = Utils::get_country_name( $field_value );
						$unit = Utils::get_unity( $field_name );
						$field_name = $field_name == 'n_engines' ? 'engines' : $field_name;
						$transformed_fields[ $section_name ][ $field_name ] = ucwords( __( $field_value, 'dlmarine' ) ) . $unit;
						$remove_section = false;
					}

					if (
						isset( $transformed_fields[ $section_name ][ $field_name ] ) &&
						( strpos( $transformed_fields[ $section_name ][ $field_name ], 'on<br>' ) !== false ||
						  strpos( $transformed_fields[ $section_name ][ $field_name ], '<br>on' ) !== false
						) ) {
						$transformed_fields[ $section_name ][ $field_name ] = str_replace(
							['<br>On', 'On<br>'],
							['', ''],
							$transformed_fields[ $section_name ][ $field_name ]
						);
					} elseif ( ! empty( $transformed_fields[ $section_name ][ $field_name ] ) && $transformed_fields[ $section_name ][ $field_name ] == 'on' ) {
						$transformed_fields[ $section_name ][ $field_name ] = '';
					}

				}
				if ( $remove_section ) {
					unset( $transformed_fields[ $section_name ] );
				}

			}
		}

		return $transformed_fields;
	}

	/**
	 * Ajax handler for refreshing listings from the settings page
	 *
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function refresh_listings() {

		try {

			$settings = new Settings_Page();
			$settings->save_search_form_options();

			$result = array( 'status' => 'NOK', 'message' => '' );

			// page -1 means all listings
			$listings      = $this->api_object->get_listings( - 1 );

			if ( is_array( $listings['listings'] ) && $listings['totalCount'] > 0 ) {

				foreach ( $listings['listings'] as $listing_data ) {

					self::update_listing_data( $listing_data );

				}
				$result['status'] = 'OK';
				$result['listings'] = $listings['listings'];
				$result['html'] = '<span class="refresh-result" style="margin-left: 5px;color:#058305;">' . $listings['totalCount'] . ' ' . __( 'listings', 'dlmarine' ) . '</span>';
			} else {
				$result['message'] = __( 'No listings found', 'dlmarine' );
			}
		} catch ( \Exception $e ) {
			$result['message'] = $e->getMessage();
			wp_send_json( $result );
			wp_die($e->getMessage());
		}
		wp_send_json( $result );
	}

	public static function update_listing_data( $listing_data ) {

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

		if ( isset( $listing_data['panorama'] ) ) {
			update_post_meta( $post_id, 'listing_panorama', maybe_serialize( $listing_data['panorama'] ) );
		} else {
			delete_post_meta( $post_id, 'listing_panorama' );
		}

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

		if ( !empty( $json_data['listing']['boat_details']['dimensions']['loa']['number'][0] ) ) {
			$loa = $json_data['listing']['boat_details']['dimensions']['loa']['number'][0];
			update_post_meta( $post_id, 'listing_loa', $loa );
		} else {
			delete_post_meta( $post_id, 'listing_loa' );
		}

		if ( isset( $json_data['listing']['boat_details']['dimensions']['beam']['number'][0] ) ) {
			$beam = $json_data['listing']['boat_details']['dimensions']['beam']['number'][0];
			update_post_meta( $post_id, 'listing_beam', $beam );
		} else {
			delete_post_meta( $post_id, 'listing_beam' );
		}

		if ( isset( $json_data['listing']['boat_details']['dimensions']['draught']['number'][0] ) ) {
			$draught = $json_data['listing']['boat_details']['dimensions']['draught']['number'][0];
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

		if ( isset( $json_data['listing']['engine_data']['engine_data']['fuel'] ) ) {
			$model = $json_data['listing']['engine_data']['engine_data']['fuel'];
			update_post_meta( $post_id, 'listing_fuel', $model );
		} else {
			delete_post_meta( $post_id, 'listing_fuel' );
		}

		if ( isset( $json_data['listing']['engine_data']['engine_data']['year_built'] ) ) {
			$model = $json_data['listing']['engine_data']['engine_data']['year_built'];
			update_post_meta( $post_id, 'listing_year_built', $model );
		} else {
			delete_post_meta( $post_id, 'listing_year_built' );
		}

		if ( isset( $json_data['listing']['listing_details']['sales_details']['sale_status'] ) ) {
			$sale_status = $json_data[ 'listing' ][ 'listing_details' ][ 'sales_details' ]['sale_status'];
			update_post_meta( $post_id, 'listing_sale_status', $sale_status );
		} else {
			delete_post_meta( $post_id, 'listing_sale_status' );
		}

		if ( isset( $json_data['listing']['listing_details']['sales_details']['sale_class'] ) ) {
			$sale_status = $json_data[ 'listing' ][ 'listing_details' ][ 'sales_details' ]['sale_class'];
			update_post_meta( $post_id, 'listing_sale_class', $sale_status );
		} else {
			delete_post_meta( $post_id, 'listing_sale_class' );
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
			delete_post_meta( $post_id, 'listing_location_city' );
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

			$image_list = is_array( $json_data[ 'fileuploader-list-listing_images' ] ) ? $json_data[ 'fileuploader-list-listing_images' ] : json_decode( $json_data[ 'fileuploader-list-listing_images' ], true );

			update_post_meta( $post_id, 'listing_n_images', count( $image_list ) );

			if ( isset( $image_list[ 0 ][ 'file' ] ) ) {
				update_post_meta( $post_id, 'listing_featured_image', $image_list[ 0 ][ 'file' ] );
			} else {
				delete_post_meta( $post_id, 'listing_featured_image' );
			}

		}
		if ( !empty($json_data['listing']['media']['videos']['video_upload'] ) ) {

			$video_list = json_decode( $json_data['listing']['media']['videos']['video_upload'], true );

			update_post_meta( $post_id, 'listing_n_videos', count( $video_list ) );

		}

	}

	/**
	 * Ajax handler to send listing enquiry emails
	 */
	public function send_enquiry() {
		global $post;

		$result = array(
			'status'  => 'NOK',
			'message' => '<span style="color:#FF0000;">' . __( 'Missing data', 'dlmarine' ) . '</span>'
		);

		if ( isset( $_POST['enquiry'] ) && ! empty( $_POST['enquiry']['current_url'] ) && ! empty( $_POST['enquiry']['boat_name'] ) ) {

			$settings = new Settings_Page();
			$settings->refresh_options();

			$can_send_recaptcha   = true;

			$recaptcha_site_key   = $settings->get_integration_option_val( 'Google reCAPTCHA', 'site_key' );
			$recaptcha_secret_key = $settings->get_integration_option_val( 'Google reCAPTCHA', 'secret_key' );
			$show_recaptcha = ! empty( $recaptcha_site_key ) && ! empty( $recaptcha_secret_key );

			if ( $show_recaptcha && ! empty( $_POST[ 'g-recaptcha-response' ] ) ) {
				$url_checker = sprintf(
					'https://www.google.com/recaptcha/api/siteverify?secret=%s&response=%s',
					$recaptcha_secret_key,
					$_POST[ 'g-recaptcha-response' ]
				);
				$verify_response = file_get_contents( $url_checker );
				$response_data   = json_decode( $verify_response );
				if ( empty( $response_data->success ) ) {
					$can_send_recaptcha = false;
				}
			}

			$error_messages = [];

			if ( ! $can_send_recaptcha ) {
				$error_messages[] = __( 'Please complete recaptcha', 'dlmarine' );
			}
			if ( empty( $_POST[ 'enquiry' ][ 'name' ] ) ) {
				$error_messages[] = __( 'The name is required', 'dlmarine' );
			}
			if ( empty( $_POST[ 'enquiry' ][ 'email' ] ) ) {
				$error_messages[] = __( 'The email is required', 'dlmarine' );
			} elseif ( filter_var( $_POST[ 'enquiry' ][ 'email' ], FILTER_VALIDATE_EMAIL ) === false ) {
				$error_messages[] = __( 'The email is not valid', 'dlmarine' );
			}
			if ( empty( $_POST[ 'enquiry' ][ 'phone' ] ) ) {
				$error_messages[] = __( 'The phone is required', 'dlmarine' );
			}
			if ( empty( $_POST[ 'enquiry' ][ 'subject' ] ) ) {
				$error_messages[] = __( 'The subject is required', 'dlmarine' );
			}
			if ( empty( $_POST[ 'enquiry' ][ 'message' ] ) ) {
				$error_messages[] = __( 'The message is required', 'dlmarine' );
			}

			if ( empty( $error_messages ) ) {

				$current_url = $_POST[ 'enquiry' ][ 'current_url' ];
				$boat_name   = $_POST[ 'enquiry' ][ 'boat_name' ];

				if ( $_POST[ 'enquiry' ][ 'subject' ] == 'request_survey' ) {
					$to = 'survey email from options';
					$subject = __( 'New Survey Request from', 'dlmarine' ) . ' ' . get_bloginfo( 'name' );
					$survey_partners_privacy_notice = rwmb_meta( 'survey_partners_privacy_notice', array( 'object_type' => 'setting' ), 'boats' );
					$body =  '<p style="margin-bottom:10px;">' . __( 'New Survey Request', 'dlmarine' ) . '</p> ';
				} else {
					$to = 'email contact from options';
					$subject = $boat_name . ' ' . __( 'New Boat Enquiry', 'dlmarine' );
					$body =  '<p style="margin-bottom:10px;">' . __( 'New Enquiry', 'dlmarine' ) . '</p> ';
				}

				$body .= '<p style="margin-bottom:10px;">' . $_POST[ 'enquiry' ][ 'name' ] . '</p> ';
				$body .= '<p style="margin-bottom:10px;">' . $_POST[ 'enquiry' ][ 'email' ] . '</p> ';
				$body .= '<p style="margin-bottom:10px;">' . $_POST[ 'enquiry' ][ 'phone' ] . '</p> ';
				$body .= '<p style="margin-bottom:10px;">' . $_POST[ 'enquiry' ][ 'subject' ] . '</p> ';
				$body .= '<p style="margin-bottom:10px;">' . $_POST[ 'enquiry' ][ 'message' ] . '</p> ';
				$body .= '<p style="margin-bottom:10px;">' . __( 'View Boat', 'dlmarine' ) . ': <a href="' . $current_url . '">' . $boat_name . '</a></p>';

				$headers = 'From: "' . get_bloginfo( 'name' ) . '" <'. $_POST[ 'enquiry' ][ 'email' ] . ">\r\n" .
				           'Content-type: text/html' . "\r\n" .
				           'Reply-To: ' . $_POST[ 'enquiry' ][ 'email' ] . "\r\n";

				$sent = wp_mail( $to, $subject, $body, $headers );

				if ( $sent ) {
					// Tracking
					if ( ! is_user_logged_in() ) {
						$enquiries = get_post_meta( $post->ID, 'listing_enquiries', true );
						$enquiries = empty( $enquiries ) ? 1 : $enquiries ++;
						update_post_meta( $post->ID, 'listing_enquiries', $enquiries );
					}
					$result[ 'status' ]  = 'OK';
					$result[ 'message' ] = '<span style="color:#058305;">' . __( 'Thank you for contacting us, we will be in touch soon.', 'dlmarine' ) . '</span>';
				} else {
					$result[ 'message' ] = '<span style="color:#058305;">' . __( 'Sorry there was an error. Message was not sent.', 'dlmarine' ) . '</span>';
				}

			} else {
				$result[ 'message' ] = '<span style="color:#058305;">' . implode( '<br>', $error_messages ) . '</span>';
			}

		} else {
			$result['message'] = '<span style="color:#FF0000;">' . __( 'Missing data', 'dlmarine' ) . '</span>';
		}

		wp_send_json( $result );

	}


}
