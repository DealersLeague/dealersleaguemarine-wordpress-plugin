<?php

namespace dealersleague\marine\wordpress;

class Utils {

	public static $fields_json;

	public static $subfields_texts = array();
	public static $fields_texts = array();
	public static $section_texts = array();
	public static $tab_texts = array();

	public static $currency_list = array(
		'EUR' => '&euro;',
		'GBP' => '&pound;',
		'USD' => '&dollar;'
	);
  
	public static function get_currency_symbol( $currency_code ) {
		if ( array_key_exists( $currency_code, self::$currency_list ) ) {
			return self::$currency_list[ $currency_code ];
		}

		return $currency_code . ' ';
	}


	public static function format_price( $price, $currency_code ) {
		$remove = '.00';
		if ( $currency_code == 'EUR' ) {
			$price  = number_format( floatval( $price ), 2, ',', '.' );
			$remove = ',00';
		} else {
			$price = number_format( floatval( $price ), 2, '.', ',' );
		}
		if ( self::ends_with( $price, $remove ) ) {
			$p     = explode( $remove, $price );
			$price = $p[ 0 ];
		}

		return $price;
	}

	public static function get_boat_type_name( $boat_type_key ) {

		$boat_type_list = array (
			'sail-cabin'            => __( 'Cabin', 'dlmarine' ),
			'sail-catamaran'        => __( 'Catamaran', 'dlmarine' ),
			'sail-classic'          => __( 'Classic', 'dlmarine' ),
			'sail-cruising'         => __( 'Cruising', 'dlmarine' ),
			'sail-daysailer'        => __( 'Daysailer', 'dlmarine' ),
			'sail-decksaloon'       => __( 'Decksaloon', 'dlmarine' ),
			'sail-dinghy'           => __( 'Dinghy', 'dlmarine' ),
			'sail-flat'             => __( 'Flat', 'dlmarine' ),
			'sail-gulet'            => __( 'Gulet', 'dlmarine' ),
			'sail-hull'             => __( 'Hull', 'dlmarine' ),
			'sail-motorsailer'      => __( 'Motorsailer', 'dlmarine' ),
			'sail-racing'           => __( 'Racing', 'dlmarine' ),
			'sail-trimaran'         => __( 'Trimaran', 'dlmarine' ),
			'sail-yacht'            => __( 'Yacht', 'dlmarine' ),
			'power-airboat'         => __( 'Airboat', 'dlmarine' ),
			'power-bowrider'        => __( 'Bowrider', 'dlmarine' ),
			'power-cabin'           => __( 'Cabin', 'dlmarine' ),
			'power-cargo'           => __( 'Cargo', 'dlmarine' ),
			'power-catamaran'       => __( 'Catamaran', 'dlmarine' ),
			'power-centerconsole'   => __( 'Centerconsole', 'dlmarine' ),
			'power-classic'         => __( 'Classic', 'dlmarine' ),
			'power-cruiser'         => __( 'Cruiser', 'dlmarine' ),
			'power-cuddycabin'      => __( 'Cuddycabin', 'dlmarine' ),
			'power-daycruiser'      => __( 'Daycruiser', 'dlmarine' ),
			'power-deck'            => __( 'Deck', 'dlmarine' ),
			'power-diving'          => __( 'Diving', 'dlmarine' ),
			'power-dualconsole'     => __( 'Dualconsole', 'dlmarine' ),
			'power-fishing'         => __( 'Fishing', 'dlmarine' ),
			'power-floatinghome'    => __( 'Floatinghome', 'dlmarine' ),
			'power-hardtop'         => __( 'Hardtop', 'dlmarine' ),
			'power-highperformance' => __( 'Highperformance', 'dlmarine' ),
			'power-houseboat'       => __( 'Houseboat', 'dlmarine' ),
			'power-hull'            => __( 'Hull', 'dlmarine' ),
			'power-narrow'          => __( 'Narrow', 'dlmarine' ),
			'power-passenger'       => __( 'Passenger', 'dlmarine' ),
			'power-pilothouse'      => __( 'Pilothouse', 'dlmarine' ),
			'power-pontoon'         => __( 'Pontoon', 'dlmarine' ),
			'power-runabout'        => __( 'Runabout', 'dlmarine' ),
			'power-sloep'           => __( 'Sloep', 'dlmarine' ),
			'power-skiandwake'      => __( 'Skiandwake', 'dlmarine' ),
			'power-sport'           => __( 'Sport', 'dlmarine' ),
			'power-submarine'       => __( 'Submarine', 'dlmarine' ),
			'power-trawler'         => __( 'Trawler', 'dlmarine' ),
			'power-trimaran'        => __( 'Power Trimaran', 'dlmarine' ),
			'power-utility'         => __( 'Utility', 'dlmarine' ),
			'power-walkaround'      => __( 'Walkaround', 'dlmarine' ),
			'power-yacht'           => __( 'Yacht', 'dlmarine' ),
			'inflatable-rib'        => __( 'RIB', 'dlmarine' ),
			'inflatable-soft'       => __( 'Soft', 'dlmarine' ),
			'inflatable-rafting'    => __( 'Rafting', 'dlmarine' ),
			'small-canoe'           => __( 'Canoe', 'dlmarine' ),
			'small-dinghy'          => __( 'Dinghy', 'dlmarine' ),
			'small-fishing'         => __( 'Fishing', 'dlmarine' ),
			'small-kayak'           => __( 'Kayak', 'dlmarine' ),
			'small-pedal'           => __( 'Pedal', 'dlmarine' ),
			'small-rowing'          => __( 'Rowing', 'dlmarine' ),
			'pwc-jetski'            => __( 'Jetski', 'dlmarine' ),
			'pwc-gadget'            => __( 'Gadget', 'dlmarine' ),
			'flybridge-yacht'       => __( 'Flybridge', 'dlmarine' ),
			'mega-yacht'            => __( 'Mega Yacht', 'dlmarine' ),
			'electric-boat'         => __( 'Electric', 'dlmarine' ),
			'solar-boat'            => __( 'Solar', 'dlmarine' ),
			'ketch'                 => __( 'Ketch', 'dlmarine' ),
			'yawl'                  => __( 'Yawl', 'dlmarine' ),
			'jet-boat'              => __( 'Jet', 'dlmarine' ),
			'offshore-boat'         => __( 'Offshore', 'dlmarine' ),
			'lobster-boat'          => __( 'Lobster', 'dlmarine' ),
			'crabber'               => __( 'Crabber', 'dlmarine' ),
			'dragger'               => __( 'Dragger', 'dlmarine' ),
			'longliner'             => __( 'Longliner', 'dlmarine' ),
			'bay-boat'              => __( 'Bay Boat', 'dlmarine' ),
			'duck-boat'             => __( 'Duck Boat', 'dlmarine' ),
			'tanker'                => __( 'Tanker', 'dlmarine' ),
			'container-ship'        => __( 'Container Ship', 'dlmarine' )
		);

		$boat_type_string = [];
		if ( is_array( $boat_type_key ) ) {
			foreach ( $boat_type_key as $key ) {
				if ( array_key_exists( $key, $boat_type_list ) ) {
					$boat_type_string[] = $boat_type_list[ $key ];
				} else {
					$boat_type_string[] = $key;
				}
			}
		} elseif ( is_string( $boat_type_key ) ) {

			if( array_key_exists( $boat_type_key, $boat_type_list ) ) {
				$boat_type_string[] = $boat_type_list[ $boat_type_key ];
			} else{
				$boat_type_string[] = $boat_type_key;
			}
		}

		return implode(', ', $boat_type_string );
	}

	public static function get_country_name( $county_code  ) {

		$country_list = array ( 
			'DE' => __( 'Germany', 'dlmarine' ),
			'GB' => __( 'United Kingdom', 'dlmarine' ),
			'AD' => __( 'Andorra', 'dlmarine' ),
			'AE' => __( 'United Arab Emirates', 'dlmarine' ),
			'AF' => __( 'Afghanistan', 'dlmarine' ),
			'AG' => __( 'Antigua and Barbuda', 'dlmarine' ),
			'AI' => __( 'Anguilla', 'dlmarine' ),
			'AL' => __( 'Albania', 'dlmarine' ),
			'AM' => __( 'Armenia', 'dlmarine' ),
			'AO' => __( 'Angola', 'dlmarine' ),
			'AQ' => __( 'Antarctica', 'dlmarine' ),
			'AR' => __( 'Argentina', 'dlmarine' ),
			'AS' => __( 'American Samoa', 'dlmarine' ),
			'AT' => __( 'Austria', 'dlmarine' ),
			'AU' => __( 'Australia', 'dlmarine' ),
			'AW' => __( 'Aruba', 'dlmarine' ),
			'AX' => __( 'Åland Islands', 'dlmarine' ),
			'AZ' => __( 'Azerbaijan', 'dlmarine' ),
			'BA' => __( 'Bosnia and Herzegovina', 'dlmarine' ),
			'BB' => __( 'Barbados', 'dlmarine' ),
			'BD' => __( 'Bangladesh', 'dlmarine' ),
			'BE' => __( 'Belgium', 'dlmarine' ),
			'BF' => __( 'Burkina Faso', 'dlmarine' ),
			'BG' => __( 'Bulgaria', 'dlmarine' ),
			'BH' => __( 'Bahrain', 'dlmarine' ),
			'BI' => __( 'Burundi', 'dlmarine' ),
			'BJ' => __( 'Benin', 'dlmarine' ),
			'BL' => __( 'Saint Barthélemy', 'dlmarine' ),
			'BM' => __( 'Bermuda', 'dlmarine' ),
			'BN' => __( 'Brunei Darussalam', 'dlmarine' ),
			'BO' => __( 'Bolivia (Plurinational State of)', 'dlmarine' ),
			'BQ' => __( 'Bonaire, Sint Eustatius and Saba', 'dlmarine' ),
			'BR' => __( 'Brazil', 'dlmarine' ),
			'BS' => __( 'Bahamas', 'dlmarine' ),
			'BT' => __( 'Bhutan', 'dlmarine' ),
			'BV' => __( 'Bouvet Island', 'dlmarine' ),
			'BW' => __( 'Botswana', 'dlmarine' ),
			'BY' => __( 'Belarus', 'dlmarine' ),
			'BZ' => __( 'Belize', 'dlmarine' ),
			'CA' => __( 'Canada', 'dlmarine' ),
			'CC' => __( 'Cocos (Keeling) Islands', 'dlmarine' ),
			'CD' => __( 'Congo, Democratic Republic of the', 'dlmarine' ),
			'CF' => __( 'Central African Republic', 'dlmarine' ),
			'CG' => __( 'Congo', 'dlmarine' ),
			'CH' => __( 'Switzerland', 'dlmarine' ),
			'CI' => __( 'Côte d\'Ivoire', 'dlmarine' ),
			'CK' => __( 'Cook Islands', 'dlmarine' ),
			'CL' => __( 'Chile', 'dlmarine' ),
			'CM' => __( 'Cameroon', 'dlmarine' ),
			'CN' => __( 'China', 'dlmarine' ),
			'CO' => __( 'Colombia', 'dlmarine' ),
			'CR' => __( 'Costa Rica', 'dlmarine' ),
			'CU' => __( 'Cuba', 'dlmarine' ),
			'CV' => __( 'Cabo Verde', 'dlmarine' ),
			'CW' => __( 'Curaçao', 'dlmarine' ),
			'CX' => __( 'Christmas Island', 'dlmarine' ),
			'CY' => __( 'Cyprus', 'dlmarine' ),
			'CZ' => __( 'Czechia', 'dlmarine' ),
			'DJ' => __( 'Djibouti', 'dlmarine' ),
			'DK' => __( 'Denmark', 'dlmarine' ),
			'DM' => __( 'Dominica', 'dlmarine' ),
			'DO' => __( 'Dominican Republic', 'dlmarine' ),
			'DZ' => __( 'Algeria', 'dlmarine' ),
			'EC' => __( 'Ecuador', 'dlmarine' ),
			'EE' => __( 'Estonia', 'dlmarine' ),
			'EG' => __( 'Egypt', 'dlmarine' ),
			'EH' => __( 'Western Sahara', 'dlmarine' ),
			'ER' => __( 'Eritrea', 'dlmarine' ),
			'ES' => __( 'Spain', 'dlmarine' ),
			'ET' => __( 'Ethiopia', 'dlmarine' ),
			'FI' => __( 'Finland', 'dlmarine' ),
			'FJ' => __( 'Fiji', 'dlmarine' ),
			'FK' => __( 'Falkland Islands (Malvinas)', 'dlmarine' ),
			'FM' => __( 'Micronesia (Federated States of)', 'dlmarine' ),
			'FO' => __( 'Faroe Islands', 'dlmarine' ),
			'FR' => __( 'France', 'dlmarine' ),
			'GA' => __( 'Gabon', 'dlmarine' ),
			'GD' => __( 'Grenada', 'dlmarine' ),
			'GE' => __( 'Georgia', 'dlmarine' ),
			'GF' => __( 'French Guiana', 'dlmarine' ),
			'GG' => __( 'Guernsey', 'dlmarine' ),
			'GH' => __( 'Ghana', 'dlmarine' ),
			'GI' => __( 'Gibraltar', 'dlmarine' ),
			'GL' => __( 'Greenland', 'dlmarine' ),
			'GM' => __( 'Gambia', 'dlmarine' ),
			'GN' => __( 'Guinea', 'dlmarine' ),
			'GP' => __( 'Guadeloupe', 'dlmarine' ),
			'GQ' => __( 'Equatorial Guinea', 'dlmarine' ),
			'GR' => __( 'Greece', 'dlmarine' ),
			'GS' => __( 'South Georgia and the South Sandwich Islands', 'dlmarine' ),
			'GT' => __( 'Guatemala', 'dlmarine' ),
			'GU' => __( 'Guam', 'dlmarine' ),
			'GW' => __( 'Guinea-Bissau', 'dlmarine' ),
			'GY' => __( 'Guyana', 'dlmarine' ),
			'HK' => __( 'Hong Kong', 'dlmarine' ),
			'HM' => __( 'Heard Island and McDonald Islands', 'dlmarine' ),
			'HN' => __( 'Honduras', 'dlmarine' ),
			'HR' => __( 'Croatia', 'dlmarine' ),
			'HT' => __( 'Haiti', 'dlmarine' ),
			'HU' => __( 'Hungary', 'dlmarine' ),
			'ID' => __( 'Indonesia', 'dlmarine' ),
			'IE' => __( 'Ireland', 'dlmarine' ),
			'IL' => __( 'Israel', 'dlmarine' ),
			'IM' => __( 'Isle of Man', 'dlmarine' ),
			'IN' => __( 'India', 'dlmarine' ),
			'IO' => __( 'British Indian Ocean Territory', 'dlmarine' ),
			'IQ' => __( 'Iraq', 'dlmarine' ),
			'IR' => __( 'Iran (Islamic Republic of)', 'dlmarine' ),
			'IS' => __( 'Iceland', 'dlmarine' ),
			'IT' => __( 'Italy', 'dlmarine' ),
			'JE' => __( 'Jersey', 'dlmarine' ),
			'JM' => __( 'Jamaica', 'dlmarine' ),
			'JO' => __( 'Jordan', 'dlmarine' ),
			'JP' => __( 'Japan', 'dlmarine' ),
			'KE' => __( 'Kenya', 'dlmarine' ),
			'KG' => __( 'Kyrgyzstan', 'dlmarine' ),
			'KH' => __( 'Cambodia', 'dlmarine' ),
			'KI' => __( 'Kiribati', 'dlmarine' ),
			'KM' => __( 'Comoros', 'dlmarine' ),
			'KN' => __( 'Saint Kitts and Nevis', 'dlmarine' ),
			'KP' => __( 'Korea (Democratic People\'s Republic of)', 'dlmarine' ),
			'KR' => __( 'Korea, Republic of', 'dlmarine' ),
			'KW' => __( 'Kuwait', 'dlmarine' ),
			'KY' => __( 'Cayman Islands', 'dlmarine' ),
			'KZ' => __( 'Kazakhstan', 'dlmarine' ),
			'LA' => __( 'Lao People\'s Democratic Republic', 'dlmarine' ),
			'LB' => __( 'Lebanon', 'dlmarine' ),
			'LC' => __( 'Saint Lucia', 'dlmarine' ),
			'LI' => __( 'Liechtenstein', 'dlmarine' ),
			'LK' => __( 'Sri Lanka', 'dlmarine' ),
			'LR' => __( 'Liberia', 'dlmarine' ),
			'LS' => __( 'Lesotho', 'dlmarine' ),
			'LT' => __( 'Lithuania', 'dlmarine' ),
			'LU' => __( 'Luxembourg', 'dlmarine' ),
			'LV' => __( 'Latvia', 'dlmarine' ),
			'LY' => __( 'Libya', 'dlmarine' ),
			'MA' => __( 'Morocco', 'dlmarine' ),
			'MC' => __( 'Monaco', 'dlmarine' ),
			'MD' => __( 'Moldova, Republic of', 'dlmarine' ),
			'ME' => __( 'Montenegro', 'dlmarine' ),
			'MF' => __( 'Saint Martin (French part)', 'dlmarine' ),
			'MG' => __( 'Madagascar', 'dlmarine' ),
			'MH' => __( 'Marshall Islands', 'dlmarine' ),
			'MK' => __( 'North Macedonia', 'dlmarine' ),
			'ML' => __( 'Mali', 'dlmarine' ),
			'MM' => __( 'Myanmar', 'dlmarine' ),
			'MN' => __( 'Mongolia', 'dlmarine' ),
			'MO' => __( 'Macao', 'dlmarine' ),
			'MP' => __( 'Northern Mariana Islands', 'dlmarine' ),
			'MQ' => __( 'Martinique', 'dlmarine' ),
			'MR' => __( 'Mauritania', 'dlmarine' ),
			'MS' => __( 'Montserrat', 'dlmarine' ),
			'MT' => __( 'Malta', 'dlmarine' ),
			'MU' => __( 'Mauritius', 'dlmarine' ),
			'MV' => __( 'Maldives', 'dlmarine' ),
			'MW' => __( 'Malawi', 'dlmarine' ),
			'MX' => __( 'Mexico', 'dlmarine' ),
			'MY' => __( 'Malaysia', 'dlmarine' ),
			'MZ' => __( 'Mozambique', 'dlmarine' ),
			'NA' => __( 'Namibia', 'dlmarine' ),
			'NC' => __( 'New Caledonia', 'dlmarine' ),
			'NE' => __( 'Niger', 'dlmarine' ),
			'NF' => __( 'Norfolk Island', 'dlmarine' ),
			'NG' => __( 'Nigeria', 'dlmarine' ),
			'NI' => __( 'Nicaragua', 'dlmarine' ),
			'NL' => __( 'Netherlands', 'dlmarine' ),
			'NO' => __( 'Norway', 'dlmarine' ),
			'NP' => __( 'Nepal', 'dlmarine' ),
			'NR' => __( 'Nauru', 'dlmarine' ),
			'NU' => __( 'Niue', 'dlmarine' ),
			'NZ' => __( 'New Zealand', 'dlmarine' ),
			'OM' => __( 'Oman', 'dlmarine' ),
			'PA' => __( 'Panama', 'dlmarine' ),
			'PE' => __( 'Peru', 'dlmarine' ),
			'PF' => __( 'French Polynesia', 'dlmarine' ),
			'PG' => __( 'Papua New Guinea', 'dlmarine' ),
			'PH' => __( 'Philippines', 'dlmarine' ),
			'PK' => __( 'Pakistan', 'dlmarine' ),
			'PL' => __( 'Poland', 'dlmarine' ),
			'PM' => __( 'Saint Pierre and Miquelon', 'dlmarine' ),
			'PN' => __( 'Pitcairn', 'dlmarine' ),
			'PR' => __( 'Puerto Rico', 'dlmarine' ),
			'PS' => __( 'Palestine, State of', 'dlmarine' ),
			'PT' => __( 'Portugal', 'dlmarine' ),
			'PW' => __( 'Palau', 'dlmarine' ),
			'PY' => __( 'Paraguay', 'dlmarine' ),
			'QA' => __( 'Qatar', 'dlmarine' ),
			'RE' => __( 'Réunion', 'dlmarine' ),
			'RO' => __( 'Romania', 'dlmarine' ),
			'RS' => __( 'Serbia', 'dlmarine' ),
			'RU' => __( 'Russian Federation', 'dlmarine' ),
			'RW' => __( 'Rwanda', 'dlmarine' ),
			'SA' => __( 'Saudi Arabia', 'dlmarine' ),
			'SB' => __( 'Solomon Islands', 'dlmarine' ),
			'SC' => __( 'Seychelles', 'dlmarine' ),
			'SD' => __( 'Sudan', 'dlmarine' ),
			'SE' => __( 'Sweden', 'dlmarine' ),
			'SG' => __( 'Singapore', 'dlmarine' ),
			'SH' => __( 'Saint Helena, Ascension and Tristan da Cunha', 'dlmarine' ),
			'SI' => __( 'Slovenia', 'dlmarine' ),
			'SJ' => __( 'Svalbard and Jan Mayen', 'dlmarine' ),
			'SK' => __( 'Slovakia', 'dlmarine' ),
			'SL' => __( 'Sierra Leone', 'dlmarine' ),
			'SM' => __( 'San Marino', 'dlmarine' ),
			'SN' => __( 'Senegal', 'dlmarine' ),
			'SO' => __( 'Somalia', 'dlmarine' ),
			'SR' => __( 'Suriname', 'dlmarine' ),
			'SS' => __( 'South Sudan', 'dlmarine' ),
			'ST' => __( 'Sao Tome and Principe', 'dlmarine' ),
			'SV' => __( 'El Salvador', 'dlmarine' ),
			'SX' => __( 'Sint Maarten (Dutch part)', 'dlmarine' ),
			'SY' => __( 'Syrian Arab Republic', 'dlmarine' ),
			'SZ' => __( 'Eswatini', 'dlmarine' ),
			'TC' => __( 'Turks and Caicos Islands', 'dlmarine' ),
			'TD' => __( 'Chad', 'dlmarine' ),
			'TF' => __( 'French Southern Territories', 'dlmarine' ),
			'TG' => __( 'Togo', 'dlmarine' ),
			'TH' => __( 'Thailand', 'dlmarine' ),
			'TJ' => __( 'Tajikistan', 'dlmarine' ),
			'TK' => __( 'Tokelau', 'dlmarine' ),
			'TL' => __( 'Timor-Leste', 'dlmarine' ),
			'TM' => __( 'Turkmenistan', 'dlmarine' ),
			'TN' => __( 'Tunisia', 'dlmarine' ),
			'TO' => __( 'Tonga', 'dlmarine' ),
			'TR' => __( 'Turkey', 'dlmarine' ),
			'TT' => __( 'Trinidad and Tobago', 'dlmarine' ),
			'TV' => __( 'Tuvalu', 'dlmarine' ),
			'TW' => __( 'Taiwan, Province of China', 'dlmarine' ),
			'TZ' => __( 'Tanzania, United Republic of', 'dlmarine' ),
			'UA' => __( 'Ukraine', 'dlmarine' ),
			'UG' => __( 'Uganda', 'dlmarine' ),
			'UM' => __( 'United States Minor Outlying Islands', 'dlmarine' ),
			'US' => __( 'United States of America', 'dlmarine' ),
			'UY' => __( 'Uruguay', 'dlmarine' ),
			'UZ' => __( 'Uzbekistan', 'dlmarine' ),
			'VA' => __( 'Holy See', 'dlmarine' ),
			'VC' => __( 'Saint Vincent and the Grenadines', 'dlmarine' ),
			'VE' => __( 'Venezuela (Bolivarian Republic of)', 'dlmarine' ),
			'VG' => __( 'Virgin Islands (British)', 'dlmarine' ),
			'VI' => __( 'Virgin Islands (U.S.)', 'dlmarine' ),
			'VN' => __( 'Viet Nam', 'dlmarine' ),
			'VU' => __( 'Vanuatu', 'dlmarine' ),
			'WF' => __( 'Wallis and Futuna', 'dlmarine' ),
			'WS' => __( 'Samoa', 'dlmarine' ),
			'YE' => __( 'Yemen', 'dlmarine' ),
			'YT' => __( 'Mayotte', 'dlmarine' ),
			'ZA' => __( 'South Africa', 'dlmarine' ),
			'ZM' => __( 'Zambia', 'dlmarine' ),
			'ZW' => __( 'Zimbabwe',  'dlmarine' )
		);

		if ( array_key_exists( $county_code , $country_list ) ) {
			return $country_list[ $county_code  ];
		}

		return $county_code;
	}

	public static function get_unity( $field_name ) {

		$unity_list = array(
			'loa'              => __( 'm', 'dlmarine' ),
			'lwl'              => __( 'm', 'dlmarine' ),
			'beam'             => __( 'm', 'dlmarine' ),
			'draught'          => __( 'm', 'dlmarine' ),
			'draught_keelup'   => __( 'm', 'dlmarine' ),
			'clearance'        => __( 'm', 'dlmarine' ),
			'displacement'     => __( 'kg', 'dlmarine' ),
			'keel_ballast'     => __( 'kg', 'dlmarine' ),
			'speed'            => __( 'kmh', 'dlmarine' ),
			'consumption'      => __( 'lh', 'dlmarine' ),
			'range'            => __( 'nm', 'dlmarine' ),
			'power'            => __( 'hp', 'dlmarine' ),
			'headroom'         => __( 'm', 'dlmarine' ),
			'volume'           => __( 'L', 'dlmarine' ),
			'capacity'         => __( 'cm3', 'dlmarine' ),
			'weight'           => __( 'kg', 'dlmarine' ),
			'max_speed'        => __( 'kmh', 'dlmarine' ),
			'cruising_speed'   => __( 'kmh', 'dlmarine' ),
			'length'           => __( 'm', 'dlmarine' ),
			'width'            => __( 'm', 'dlmarine' ),
			'axle_width'       => __( 'm', 'dlmarine' ),
			'curb_weight'      => __( 'kg', 'dlmarine' ),
			'payload'          => __( 'kg', 'dlmarine' ),
			'total_weight'     => __( 'kg', 'dlmarine' ),
			'area'             => __( 'm2', 'dlmarine' ),
			'water_depth'      => __( 'm', 'dlmarine' ),
			'max_boat_draught' => __( 'm', 'dlmarine' ),
		);

		if ( array_key_exists( strtolower( $field_name ) , $unity_list ) ) {
			return $unity_list[ strtolower( $field_name )  ];
		}

		return '';

	}

	public static function get_ce_design_category( $field_name ) {

		//$field_name = strtoupper( $field_name );

		$category_list = array(
			'a' => __( 'Ocean', 'dlmarine' ),
			'b' => __( 'Offshore', 'dlmarine' ),
			'c' => __( 'Inshore', 'dlmarine' ),
			'd' => __( 'Sheltered waters', 'dlmarine' ),
		); 

		if ( array_key_exists( $field_name , $category_list ) ) {
			return $category_list[ $field_name ];
		}

		return '';

	}

	
	public static function get_long_description( $listing_json_data ) {
		// Description
		$current_site_language = explode( '_', get_locale() );

		$language = strtolower( $current_site_language[ 0 ] );

		$long_description_array = empty( $listing_json_data[ 'listing' ][ 'listing_details' ][ 'listing_managment' ][ 'long_description' ] ) ? [] : $listing_json_data[ 'listing' ][ 'listing_details' ][ 'listing_managment' ][ 'long_description' ];
		$long_description_text  = '';
		if ( count( $long_description_array ) === 1 ) {
			$long_description_text = ! empty( $long_description_array[ 'text' ][ 0 ] ) ? $long_description_array[ 'text' ][ 0 ] : '';
		} elseif ( isset( $long_description_array[ 'language' ] ) ) {
			foreach ( $long_description_array[ 'language' ] as $index => $long_description_language ) {
				if ( $long_description_language == $language ) {
					$long_description_text = $long_description_array[ 'text' ][ $index ];
					break;
				}
			}
			if ( empty( $long_description_text ) ) {
				$long_description_text = $long_description_array[ 'text' ][ 0 ];
			}
		}

		return $long_description_text;
	}

	public static function get_short_description( $listing_json_data ) {
		// Description
		$current_site_language = explode( '_', get_locale() );

		$language = strtolower( $current_site_language[ 0 ] );

		$short_description_array = empty( $listing_json_data[ 'listing' ][ 'listing_details' ][ 'listing_managment' ][ 'short_description' ] ) ? [] : $listing_json_data[ 'listing' ][ 'listing_details' ][ 'listing_managment' ][ 'short_description' ];
		$short_description_text  = '';
		if ( count( $short_description_array ) === 1 ) {
			$short_description_text = ! empty( $short_description_array[ 'text' ][ 0 ] ) ? $short_description_array[ 'text' ][ 0 ] : '';
		} elseif ( isset( $short_description_array[ 'language' ] ) && is_array( $short_description_array[ 'language' ] ) ) {
			foreach ( $short_description_array[ 'language' ] as $index => $short_description_language ) {
				if ( $short_description_language == $language ) {
					$short_description_text = $short_description_array[ 'text' ][ $index ];
					break;
				}
			}
			if ( empty( $short_description_text ) ) {
				$short_description_text = $short_description_array[ 'text' ][ 0 ];
			}
		}

		return $short_description_text;
	}
	

	/**
	 * @param $string
	 * @param $test
	 *
	 * @return bool
	 */
	public static function ends_with( $string, $test ) {
		$strlen  = strlen( $string );
		$testlen = strlen( $test );
		if ( $testlen > $strlen ) {
			return false;
		}

		return substr_compare( $string, $test, $strlen - $testlen, $testlen ) === 0;
	}

	/**
	 * @param $text
	 *
	 * @return mixed|string|void
	 */
	public static function check_translation( $text ) {

		$path = plugin_dir_path( __FILE__ ) . '../json/fields.json';
		if ( empty( self::$fields_json ) && file_exists( $path ) ) {
			self::$fields_json = json_decode( file_get_contents( $path ), true );
		}

		foreach ( self::$fields_json['tabs'] as $tab ) {
			if ( ! isset( self::$tab_texts[ $tab['id'] ] ) ) {
				self::$tab_texts[ $tab['id'] ] = __( $tab['name'], 'dlmarine' );
			}

			foreach ( $tab['sections'] as $section ) {
				if ( ! isset( self::$section_texts[ $section['id'] ] ) ) {
					self::$section_texts[ $section['id'] ] = __( $section['name'], 'dlmarine' );
				}
				foreach ( $section['fields' ] as $field ) {

					if ( isset( $field['fields'] ) ) {

						foreach ( $field['fields' ]  as $subfield) {
							if ( ! isset( self::$subfields_texts[ $subfield[ 'id' ] ] ) ) {

								if ( ! empty( $subfield[ 'name' ] ) ) {
									self::$subfields_texts[ $field[ 'id' ] ] = __( $subfield[ 'name' ], 'dlmarine' );
								} elseif ( ! empty( $subfield[ 'label' ] ) ) {
									self::$subfields_texts[ $field[ 'id' ] ] = __( $subfield[ 'label' ], 'dlmarine' );
								} else {
									self::$subfields_texts[ $subfield[ 'id' ] ] = $subfield[ 'id' ];
								}

							}
						}

						if ( ! isset( self::$fields_texts[ $field[ 'id' ] ] ) ) {

							if ( ! empty( $field[ 'name' ] ) ) {
								self::$fields_texts[ $field[ 'id' ] ] = __( $field[ 'name' ], 'dlmarine' );
							} elseif ( ! empty( $field[ 'label' ] ) ) {
								self::$fields_texts[ $field[ 'id' ] ] = __( $field[ 'label' ], 'dlmarine' );
							} else {
								self::$fields_texts[ $field[ 'id' ] ] = $field[ 'id' ];
							}

						}
					} else {
						if ( ! isset( self::$fields_texts[ $field[ 'id' ] ] ) ) {

							if ( ! empty( $field[ 'name' ] ) ) {
								self::$fields_texts[ $field[ 'id' ] ] = __( $field[ 'name' ], 'dlmarine' );
							} elseif ( ! empty( $field[ 'label' ] ) ) {
								self::$fields_texts[ $field[ 'id' ] ] = __( $field[ 'label' ], 'dlmarine' );
							} else {
								self::$fields_texts[ $field[ 'id' ] ] = __( $field[ 'id' ], 'dlmarine' );
							}

						}
					}

				}

			}

		}

		$text_to_return = '';

		if ( isset( self::$tab_texts[ $text ] ) ) {
			$text_to_return = self::$tab_texts[ $text ];
			$text_to_return = str_replace( '_', ' ', $text_to_return );
			$text_to_return = __( ucwords( $text_to_return ), 'dlmarine' );
		} elseif ( isset( self::$section_texts[ $text ] ) ) {
			$text_to_return = self::$section_texts[ $text ];
			$text_to_return = str_replace( '_', ' ', $text_to_return );
			$text_to_return = __( ucwords( $text_to_return ), 'dlmarine' );
		} elseif ( isset( self::$fields_texts[ $text ] ) ) {
			$text_to_return = self::$fields_texts[ $text ];
			$text_to_return = str_replace( '_', ' ', $text_to_return );
			$text_to_return = __( ucwords( $text_to_return ), 'dlmarine' );
		} elseif ( isset( self::$subfields_texts[ $text ] ) ) {
			$text_to_return = self::$subfields_texts[ $text ];
			$text_to_return = str_replace( '_', ' ', $text_to_return );
			$text_to_return = __( ucwords( $text_to_return ), 'dlmarine' );
		} elseif ( empty( $text_to_return ) || strpos( $text_to_return, '_' ) !== false ) {

			if ( is_array( $text ) ) {
				foreach ( $text as $t ) {
					$t_translate       = str_replace( '_', ' ', $t );
					$translated = __( $t_translate, 'dlmarine' );
					$translated = strtolower( $t_translate ) == strtolower( $translated ) ? __( strtoupper( $t_translate ), 'dlmarine' ) : $translated;
					$translated = strtolower( $t_translate ) == strtolower( $translated ) ? __( strtolower( $t_translate ), 'dlmarine' ) : $translated;
					$translated = strtolower( $t_translate ) == strtolower( $translated ) ? __( ucfirst( $t_translate ), 'dlmarine' ) : $translated;
					$translated = strtolower( $t_translate ) == strtolower( $translated ) ? __( ucwords( $t_translate ), 'dlmarine' ) : $translated;

					$text_to_return .= strtolower( $t ) == strtolower( $translated ) ? $t : $translated;
				}
			} else {

				$original   = $text;
				$text       = str_replace( '_', ' ', $text );
				$translated = __( $text, 'dlmarine' );
				$translated = strtolower( $text ) == strtolower( $translated ) ? __( strtoupper( $text ), 'dlmarine' ) : $translated;
				$translated = strtolower( $text ) == strtolower( $translated ) ? __( strtolower( $text ), 'dlmarine' ) : $translated;
				$translated = strtolower( $text ) == strtolower( $translated ) ? __( ucfirst( $text ), 'dlmarine' ) : $translated;
				$translated = strtolower( $text ) == strtolower( $translated ) ? __( ucwords( $text ), 'dlmarine' ) : $translated;

				$text_to_return = strtolower( $original ) == strtolower( $translated ) ? $original : $translated;
			}
		}

		if ( strtolower( $text_to_return ) == 'volume' ) {
			$text_to_return = __( 'Volume', 'dlmarine' );
		}
		return $text_to_return;
	}

}