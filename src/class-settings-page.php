<?php

namespace dealersleague\marine\wordpress;

class Settings_Page {

	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $option_page = 'dealers_league_marine_settings_page';
	private $option_group = 'dealers_league_marine_option_group';
	private $option_name = 'dealers_league_marine_option';
	protected $options;

	private $web_settings_option_name = 'dealers_league_marine_web_settings_option';
	protected $web_settings_options;

	private $integration_option_name = 'dealers_league_marine_integration_option';
	protected $integration_options;

	private $search_form_option_name = 'dealers_league_marine_search_form_option';
	protected $search_form_options;

	private $option_metabox = [];
	private $tab_page = [];
	private $times = 1;
	/**
	 * Start up
	 */
	public function init(): void {
		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );

		$this->options = get_option( $this->option_name );

	}

	public function refresh_options() {
		$this->options              = get_option( $this->option_name );
		$this->integration_options  = maybe_unserialize( get_option( $this->integration_option_name ) );
		$this->web_settings_options = maybe_unserialize( get_option( $this->web_settings_option_name ) );
		$this->search_form_options  = json_decode( get_option( $this->search_form_option_name ), true );
	}

	/**
	 * @return array
	 */
	public function get_tab_page_fields(): array {
		// Only need to initiate the array once per page-load
		if ( empty( $this->option_metabox ) ) {

			$this->option_metabox[ 'connection' ] = array(
				'id'          => 'connection_setting_section',
				'title'       => __( 'Connection Settings', 'dlmarine' ),
				'description' => '',
				'page'        => 'dealers_league_marine_settings_page',
				'option'      => 'dealers_league_marine_option',
				'fields'      => array(
					array(
						'id'   => 'dealers_league_marine_email',
						'name' => __( 'Username', 'dlmarine' ),
						'type' => 'email',
						'desc' => __( 'Your Dealers League Marine Username', 'dlmarine' ),
                    ),
					array(
						'id'   => 'dealers_league_marine_api_key',
						'name' => __( 'API Key', 'dlmarine' ),
						'desc' => __( 'API Key provided by Dealers League SL', 'dlmarine' ),
						'type' => 'text'
                    ),
					array(
						'id'   => 'dealers_league_marine_api_url',
						'name' => __( 'API URL', 'dlmarine' ),
						'desc' => __( 'API URL for external requests', 'dlmarine' ),
						'type' => 'url'
					),
					array(
						'id'      => 'dealers_league_marine_refresh_listings',
						'name'    => __( 'Refresh listings', 'dlmarine' ),
						'onclick' => '',
						'type'    => 'button'
					),
					array(
						'id'      => 'dealers_league_marine_view_listings',
						'name'    => __( 'View listings', 'dlmarine' ),
						'desc' => __( 'This will let you see the list of boats in the Wordpress database. Not for editing listings, normally just used for debugging.', 'dlmarine' ),
						'onclick' => '',
						'type'    => 'button'
					)
                )
            );

		}

		return apply_filters( 'dealers_league_marine_settings_tab', $this->option_metabox );

	}

	public function get_main_option_name(): string {
		return $this->option_name;
	}

	/**
	 * @param $name
	 *
	 * @return string
	 */
	public function get_option_val( $name ): string {
		return ! empty( $this->options[ $name ] ) ? $this->options[ $name ] : '';
	}

	/**
	 * @param $name
	 *
	 * @return string
	 */
	public function get_web_settings_option_val( $name ): string {
		return ! empty( $this->web_settings_options[ $name ] ) ? esc_attr( $this->web_settings_options[ $name ] ) : '';
	}

	/**
	 * @param $integration_name
	 * @param $var_name
	 *
	 * @return array|string
	 */
	public function get_integration_option_val( $integration_name, $var_name ): string {

	    $fields = isset( $this->integration_options[ $integration_name ]['fields'] ) ? json_decode( $this->integration_options[ $integration_name ]['fields'], true ) : [];
	    foreach ( $fields as $field ) {
	        if ( $field['name'] == $var_name ) {
		        return $field[ 'value' ];
            }
        }

	    return '';

	}

	/**
	 * @param $name
	 *
	 * @return string
	 */
	public function get_search_form_option_val( $name ): array {
		return ! empty( $this->search_form_options[ $name ] ) ? $this->search_form_options[ $name ] : [];
	}

	/**
	 * Add options page
	 */
	public function add_settings_page(): void {

		// This page will be under "Settings"
		add_options_page(
			__( 'Dealers League Marine Settings', 'dlmarine' ),
			__( 'Dealers League Marine', 'dlmarine' ),
			'manage_options',
			'dealers-league-marine-settings',
			array( $this, 'create_admin_page' )
		);

	}

	/**
	 * Options page callback
	 */
	public function create_admin_page(): void {
		// Set class property

		$action         = sanitize_text_field($_GET[ 'action' ] ?? '');
		$current_page   = '';
		$current_option = '';

		if ( isset( $_POST[ 'dealers_league_marine_option' ] ) ) {
			$option_name = empty( $action ) ? 'connection' : $action;
			$this->save_options( $_POST[ 'dealers_league_marine_option' ], $option_name );
		}

		$tab_page_field_list = $this->get_tab_page_fields();

		?>
        <div class="wrap">
            <h1><?php
				_e( 'Dealers League Marine Settings', 'dlmarine' ); ?></h1>

            <h2 class="nav-tab-wrapper">

				<?php
				foreach ( $tab_page_field_list as $tab_action => $tab_page ) {

					$url       = esc_url( add_query_arg( [ 'action' => $tab_action ], admin_url( '/edit.php?post_type='.Boat_Post_Type::get_post_type_name().'&page='.Boat_Post_Type::get_post_type_name().'_settings' ) ) );
					$tab_label = ucfirst( $tab_action );
					$active    = ( ! isset( $_GET[ 'action' ] ) && $tab_action === 'connection' ) || ( isset( $_GET[ 'action' ] ) && $tab_action == $_GET[ 'action' ] ) ? 'nav-tab-active' : '';
					if ( ! empty( $active ) ) {
						$current_page   = $tab_page[ 'page' ];
						$current_option = $tab_page[ 'option' ];
					}
					?>

                    <a href="<?php
					echo $url; ?>" class="nav-tab <?php
					echo $active; ?>"><?php
						esc_html_e( $tab_label ); ?></a>

					<?php
				}
				?>


            </h2>

            <form method="post" action="">
				<?php
				settings_fields( $current_option );
				do_settings_sections( $current_page );
				submit_button();
				?>
            </form>
        </div>
		<?php
	}


	/**
	 * Register and add settings
	 */
	public function page_init(): void {
		register_setting(
			$this->option_group, // Option group
			$this->option_name, // Option name
			null // Sanitize
		);

		$tab_page_field_list = $this->get_tab_page_fields();

		foreach ( $tab_page_field_list as $tab_page ) {

			add_settings_section(
				$tab_page[ 'id' ], // ID
				$tab_page[ 'title' ], // Title
				$tab_page[ 'description' ], // Callback to show a description
				$tab_page[ 'page' ] // Page
			);

			foreach ( $tab_page[ 'fields' ] as $field ) {
				add_settings_field(
					$field[ 'id' ], // ID
					$field[ 'name' ], // Title
					function () use ( $field ) {
						$this->render_field( $field );
					}, // Callback to display the fields
					$tab_page[ 'page' ], // Page
					$tab_page[ 'id' ] // Section
				);
			}

		}

	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param $input
	 * @param $type
	 *
	 * @return mixed
	 */
	public function sanitize( $input, $type ) {
		$new_input = '';

		switch ( $type ) {
			case 'number':
				$new_input = absint( $input );
				break;
			case 'text':
			case 'textarea':
			case 'select':
				$new_input = sanitize_text_field( $input );
				break;
            case 'url':
	            $new_input = esc_url_raw( $input );
	            break;
			case 'email':
				$new_input = sanitize_email( $input );
				break;
			case 'checkbox':
				$new_input = $input === 'on';
				break;
		}

		return $new_input;
	}

	/**
	 * @param $options
	 * @param $option_name
	 *
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function save_options( $options, $option_name ): void {
		try {
			$tab_page_fields = $this->get_tab_page_fields();

			if ( array_key_exists( $option_name, $tab_page_fields ) ) {

				$field_list = $tab_page_fields[ $option_name ][ 'fields' ];

				foreach ( $field_list as $field ) {
					if ( array_key_exists( $field[ 'id' ], $options ) ) {
						$value = $this->sanitize( $options[ $field[ 'id' ] ], $field[ 'type' ] );
						$this->options[ $field[ 'id' ] ] = $value;
					} else {
						$this->options[ $field[ 'id' ] ] = '';
					}
				}
			}

			update_option( $this->option_name, $this->options );

			// Getting options from API
			$api_object = new Api();
			$api_object->init( $this );

			$web_settings = $api_object->get_web_settings();
			update_option( $this->web_settings_option_name, $web_settings  );
			
			$integrations = $api_object->get_integration();
			update_option( $this->integration_option_name, $integrations );

		} catch(\Exception $ex){
			echo '<div class="error notice notice-warning is-dismissible">
             <p>'.$ex->getMessage().'</p>
         	</div>';
		}
	}

	/**
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \dealersleague\marine\Exceptions\DealersLeagueException
	 */
	public function save_search_form_options() {
		// Getting options from API
		$api_object = new Api();
		$api_object->init( $this );

		$search_form_options = array(
			'countries'     => $api_object->get_country_list(),
			'manufacturers' => $api_object->get_manufacturer_list(),
			'categories'    => $api_object->get_category_list(),
			'colours'       => $api_object->get_colour_tag_list(),
		);

		update_option( $this->search_form_option_name, json_encode( $search_form_options ) );
	}

	/**
	 * @param $web_settings
	 */
	public function save_web_settings_options( $web_settings ) {
		update_option( $this->web_settings_option_name, $web_settings );
	}

	/**
	 * @param $integrations
	 */
	public function save_integrations_options( $integrations ) {
		update_option( $this->integration_option_name, $integrations );
	}

	/**
	 * @param $field
	 *
	 * @return void
	 */
	public function render_field( $field ): void {
		$html = '';
		switch ( $field[ 'type' ] ) {
			case 'number':
				$html = sprintf(
					'<input type="number" min="0" id="%s" name="%s[%s]" value="%s" class="regular-text code" />',
					$field[ 'id' ],
                    $this->option_name,
                    $field[ 'id' ],
                    isset( $this->options[ $field[ 'id' ] ] ) ? esc_attr( $this->options[ $field[ 'id' ] ] ) : ''
				);
				break;
            case 'email':
            case 'url':
			case 'text':
				$html = sprintf(
					'<input type="%s" id="%s" name="%s[%s]" value="%s" class="regular-text code" />',
					$field['type'],
					$field[ 'id' ],
                    $this->option_name,
                    $field[ 'id' ],
                    isset( $this->options[ $field[ 'id' ] ] ) ? esc_attr( $this->options[ $field[ 'id' ] ] ) : ''
				);
				break;
			case 'select':
				$html = sprintf(
					'<select id="%s" name="%s[%s]">',
					$field[ 'id' ],
                    $this->option_name,
                    $field[ 'id' ]
				);

				$html .= '<option value=""> --- </option>';
				foreach ( $field[ 'options' ] as $option ) {
					$selected = isset( $this->options[ $field[ 'id' ] ] ) && $this->options[ $field[ 'id' ] ] == $option[ 'value' ] ? 'selected="selected"' : '';
					$html     .= '<option value="' . $option[ 'value' ] . '" ' . $selected . '>' . $option[ 'label' ] . '</option>';
				}

				$html .= '</select>';
				break;
			case 'checkbox':
				$checked = ! empty( $this->options[ $field[ 'id' ] ] ) ? 'checked="checked"' : '';
				$html    = sprintf(
					'<input type="checkbox" id="%s" name="%s[%s]" ' . $checked . ' />',
					$field[ 'id' ],
                    $this->option_name,
                    $field[ 'id' ]
				);
				break;
			case 'textarea':
				$html = sprintf(
					'<textarea id="%s" name="%s[%s]" rows="6" class="regular-text code">%s</textarea>',
					$field[ 'id' ],
                    $this->option_name,
                    $field[ 'id' ],
                    isset( $this->options[ $field[ 'id' ] ] ) ? esc_attr( $this->options[ $field[ 'id' ] ] ) : ''
				);
				break;
            case 'button':
                $html = sprintf(
                    '<button type="button" id="%s" onclick="%s" class="%s" >%s</button>',
                    $field[ 'id' ],
                    isset( $field['onclick'] ) ? $field['onclick'] : '',
                    isset( $field['class'] ) ? $field['class'] : '',
                    $field['name']
                );
                break;
		}

		if ( ! empty( $field[ 'desc' ] ) ) {
			$html .= '<p class="description">' . $field[ 'desc' ] . '</p>';
		}

		echo $html;
	}

}

