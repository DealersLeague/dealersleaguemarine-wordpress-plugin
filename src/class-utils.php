<?php

namespace dealersleague\marine\wordpress;

class Utils {

	public static $currency_list = array(
		'EUR' => '&euro;',
		'GBP' => '&pound;',
		'USD' => '&dollar;'

	);

	public static $boat_type_list = array (
		'sail-cabin'            => 'Cabin',
		'sail-catamaran'        => 'Catamaran',
		'sail-classic'          => 'Classic',
		'sail-cruising'         => 'Cruising',
		'sail-daysailer'        => 'Daysailer',
		'sail-decksaloon'       => 'Decksaloon',
		'sail-dinghy'           => 'Dinghy',
		'sail-flat'             => 'Flat',
		'sail-gulet'            => 'Gulet',
		'sail-hull'             => 'Hull',
		'sail-motorsailer'      => 'Motorsailer',
		'sail-racing'           => 'Racing',
		'sail-trimaran'         => 'Trimaran',
		'sail-yacht'            => 'Yacht',
		'power-airboat'         => 'Airboat',
		'power-bowrider'        => 'Bowrider',
		'power-cabin'           => 'Cabin',
		'power-cargo'           => 'Cargo',
		'power-catamaran'       => 'Catamaran',
		'power-centerconsole'   => 'Centerconsole',
		'power-classic'         => 'Classic',
		'power-cruiser'         => 'Cruiser',
		'power-cuddycabin'      => 'Cuddycabin',
		'power-daycruiser'      => 'Daycruiser',
		'power-deck'            => 'Deck',
		'power-diving'          => 'Diving',
		'power-dualconsole'     => 'Dualconsole',
		'power-fishing'         => 'Fishing',
		'power-floatinghome'    => 'Floatinghome',
		'power-hardtop'         => 'Hardtop',
		'power-highperformance' => 'Highperformance',
		'power-houseboat'       => 'Houseboat',
		'power-hull'            => 'Hull',
		'power-narrow'          => 'Narrow',
		'power-passenger'       => 'Passenger',
		'power-pilothouse'      => 'Pilothouse',
		'power-pontoon'         => 'Pontoon',
		'power-runabout'        => 'Runabout',
		'power-sloep'           => 'Sloep',
		'power-skiandwake'      => 'Skiandwake',
		'power-sport'           => 'Sport',
		'power-submarine'       => 'Submarine',
		'power-trawler'         => 'Trawler',
		'power-trimaran'        => 'Power Trimaran',
		'power-utility'         => 'Utility',
		'power-walkaround'      => 'Walkaround',
		'power-yacht'           => 'Yacht',
		'inflatable-rib'        => 'RIB',
		'inflatable-soft'       => 'Soft',
		'inflatable-rafting'    => 'Rafting',
		'small-canoe'           => 'Canoe',
		'small-dinghy'          => 'Dinghy',
		'small-fishing'         => 'Fishing',
		'small-kayak'           => 'Kayak',
		'small-pedal'           => 'Pedal',
		'small-rowing'          => 'Rowing',
		'pwc-jetski'            => 'Jetski',
		'pwc-gadget'            => 'Gadget',
		'flybridge-yacht'       => 'Flybridge',
		'mega-yacht'            => 'Mega Yacht',
		'electric-boat'         => 'Electric',
		'solar-boat'            => 'Solar',
		'ketch'                 => 'Ketch',
		'yawl'                  => 'Yawl',
		'jet-boat'              => 'Jet',
		'offshore-boat'         => 'Offshore',
		'lobster-boat'          => 'Lobster',
		'crabber'               => 'Crabber',
		'dragger'               => 'Dragger',
		'longliner'             => 'Longliner',
		'bay-boat'              => 'Bay Boat',
		'duck-boat'             => 'Duck Boat',
		'tanker'                => 'Tanker',
		'container-ship'        => 'Container Ship'
	);

	public static $country_list = array (
		"DE" => "Germany",
		"GB" => "United Kingdom",
		"AD" => "Andorra",
		"AE" => "United Arab Emirates",
		"AF" => "Afghanistan",
		"AG" => "Antigua and Barbuda",
		"AI" => "Anguilla",
		"AL" => "Albania",
		"AM" => "Armenia",
		"AO" => "Angola",
		"AQ" => "Antarctica",
		"AR" => "Argentina",
		"AS" => "American Samoa",
		"AT" => "Austria",
		"AU" => "Australia",
		"AW" => "Aruba",
		"AX" => "Åland Islands",
		"AZ" => "Azerbaijan",
		"BA" => "Bosnia and Herzegovina",
		"BB" => "Barbados",
		"BD" => "Bangladesh",
		"BE" => "Belgium",
		"BF" => "Burkina Faso",
		"BG" => "Bulgaria",
		"BH" => "Bahrain",
		"BI" => "Burundi",
		"BJ" => "Benin",
		"BL" => "Saint Barthélemy",
		"BM" => "Bermuda",
		"BN" => "Brunei Darussalam",
		"BO" => "Bolivia (Plurinational State of)",
		"BQ" => "Bonaire, Sint Eustatius and Saba",
		"BR" => "Brazil",
		"BS" => "Bahamas",
		"BT" => "Bhutan",
		"BV" => "Bouvet Island",
		"BW" => "Botswana",
		"BY" => "Belarus",
		"BZ" => "Belize",
		"CA" => "Canada",
		"CC" => "Cocos (Keeling) Islands",
		"CD" => "Congo, Democratic Republic of the",
		"CF" => "Central African Republic",
		"CG" => "Congo",
		"CH" => "Switzerland",
		"CI" => "Côte d'Ivoire",
		"CK" => "Cook Islands",
		"CL" => "Chile",
		"CM" => "Cameroon",
		"CN" => "China",
		"CO" => "Colombia",
		"CR" => "Costa Rica",
		"CU" => "Cuba",
		"CV" => "Cabo Verde",
		"CW" => "Curaçao",
		"CX" => "Christmas Island",
		"CY" => "Cyprus",
		"CZ" => "Czechia",
		"DJ" => "Djibouti",
		"DK" => "Denmark",
		"DM" => "Dominica",
		"DO" => "Dominican Republic",
		"DZ" => "Algeria",
		"EC" => "Ecuador",
		"EE" => "Estonia",
		"EG" => "Egypt",
		"EH" => "Western Sahara",
		"ER" => "Eritrea",
		"ES" => "Spain",
		"ET" => "Ethiopia",
		"FI" => "Finland",
		"FJ" => "Fiji",
		"FK" => "Falkland Islands (Malvinas)",
		"FM" => "Micronesia (Federated States of)",
		"FO" => "Faroe Islands",
		"FR" => "France",
		"GA" => "Gabon",
		"GD" => "Grenada",
		"GE" => "Georgia",
		"GF" => "French Guiana",
		"GG" => "Guernsey",
		"GH" => "Ghana",
		"GI" => "Gibraltar",
		"GL" => "Greenland",
		"GM" => "Gambia",
		"GN" => "Guinea",
		"GP" => "Guadeloupe",
		"GQ" => "Equatorial Guinea",
		"GR" => "Greece",
		"GS" => "South Georgia and the South Sandwich Islands",
		"GT" => "Guatemala",
		"GU" => "Guam",
		"GW" => "Guinea-Bissau",
		"GY" => "Guyana",
		"HK" => "Hong Kong",
		"HM" => "Heard Island and McDonald Islands",
		"HN" => "Honduras",
		"HR" => "Croatia",
		"HT" => "Haiti",
		"HU" => "Hungary",
		"ID" => "Indonesia",
		"IE" => "Ireland",
		"IL" => "Israel",
		"IM" => "Isle of Man",
		"IN" => "India",
		"IO" => "British Indian Ocean Territory",
		"IQ" => "Iraq",
		"IR" => "Iran (Islamic Republic of)",
		"IS" => "Iceland",
		"IT" => "Italy",
		"JE" => "Jersey",
		"JM" => "Jamaica",
		"JO" => "Jordan",
		"JP" => "Japan",
		"KE" => "Kenya",
		"KG" => "Kyrgyzstan",
		"KH" => "Cambodia",
		"KI" => "Kiribati",
		"KM" => "Comoros",
		"KN" => "Saint Kitts and Nevis",
		"KP" => "Korea (Democratic People's Republic of)",
		"KR" => "Korea, Republic of",
		"KW" => "Kuwait",
		"KY" => "Cayman Islands",
		"KZ" => "Kazakhstan",
		"LA" => "Lao People's Democratic Republic",
		"LB" => "Lebanon",
		"LC" => "Saint Lucia",
		"LI" => "Liechtenstein",
		"LK" => "Sri Lanka",
		"LR" => "Liberia",
		"LS" => "Lesotho",
		"LT" => "Lithuania",
		"LU" => "Luxembourg",
		"LV" => "Latvia",
		"LY" => "Libya",
		"MA" => "Morocco",
		"MC" => "Monaco",
		"MD" => "Moldova, Republic of",
		"ME" => "Montenegro",
		"MF" => "Saint Martin (French part)",
		"MG" => "Madagascar",
		"MH" => "Marshall Islands",
		"MK" => "North Macedonia",
		"ML" => "Mali",
		"MM" => "Myanmar",
		"MN" => "Mongolia",
		"MO" => "Macao",
		"MP" => "Northern Mariana Islands",
		"MQ" => "Martinique",
		"MR" => "Mauritania",
		"MS" => "Montserrat",
		"MT" => "Malta",
		"MU" => "Mauritius",
		"MV" => "Maldives",
		"MW" => "Malawi",
		"MX" => "Mexico",
		"MY" => "Malaysia",
		"MZ" => "Mozambique",
		"NA" => "Namibia",
		"NC" => "New Caledonia",
		"NE" => "Niger",
		"NF" => "Norfolk Island",
		"NG" => "Nigeria",
		"NI" => "Nicaragua",
		"NL" => "Netherlands",
		"NO" => "Norway",
		"NP" => "Nepal",
		"NR" => "Nauru",
		"NU" => "Niue",
		"NZ" => "New Zealand",
		"OM" => "Oman",
		"PA" => "Panama",
		"PE" => "Peru",
		"PF" => "French Polynesia",
		"PG" => "Papua New Guinea",
		"PH" => "Philippines",
		"PK" => "Pakistan",
		"PL" => "Poland",
		"PM" => "Saint Pierre and Miquelon",
		"PN" => "Pitcairn",
		"PR" => "Puerto Rico",
		"PS" => "Palestine, State of",
		"PT" => "Portugal",
		"PW" => "Palau",
		"PY" => "Paraguay",
		"QA" => "Qatar",
		"RE" => "Réunion",
		"RO" => "Romania",
		"RS" => "Serbia",
		"RU" => "Russian Federation",
		"RW" => "Rwanda",
		"SA" => "Saudi Arabia",
		"SB" => "Solomon Islands",
		"SC" => "Seychelles",
		"SD" => "Sudan",
		"SE" => "Sweden",
		"SG" => "Singapore",
		"SH" => "Saint Helena, Ascension and Tristan da Cunha",
		"SI" => "Slovenia",
		"SJ" => "Svalbard and Jan Mayen",
		"SK" => "Slovakia",
		"SL" => "Sierra Leone",
		"SM" => "San Marino",
		"SN" => "Senegal",
		"SO" => "Somalia",
		"SR" => "Suriname",
		"SS" => "South Sudan",
		"ST" => "Sao Tome and Principe",
		"SV" => "El Salvador",
		"SX" => "Sint Maarten (Dutch part)",
		"SY" => "Syrian Arab Republic",
		"SZ" => "Eswatini",
		"TC" => "Turks and Caicos Islands",
		"TD" => "Chad",
		"TF" => "French Southern Territories",
		"TG" => "Togo",
		"TH" => "Thailand",
		"TJ" => "Tajikistan",
		"TK" => "Tokelau",
		"TL" => "Timor-Leste",
		"TM" => "Turkmenistan",
		"TN" => "Tunisia",
		"TO" => "Tonga",
		"TR" => "Turkey",
		"TT" => "Trinidad and Tobago",
		"TV" => "Tuvalu",
		"TW" => "Taiwan, Province of China",
		"TZ" => "Tanzania, United Republic of",
		"UA" => "Ukraine",
		"UG" => "Uganda",
		"UM" => "United States Minor Outlying Islands",
		"US" => "United States of America",
		"UY" => "Uruguay",
		"UZ" => "Uzbekistan",
		"VA" => "Holy See",
		"VC" => "Saint Vincent and the Grenadines",
		"VE" => "Venezuela (Bolivarian Republic of)",
		"VG" => "Virgin Islands (British)",
		"VI" => "Virgin Islands (U.S.)",
		"VN" => "Viet Nam",
		"VU" => "Vanuatu",
		"WF" => "Wallis and Futuna",
		"WS" => "Samoa",
		"YE" => "Yemen",
		"YT" => "Mayotte",
		"ZA" => "South Africa",
		"ZM" => "Zambia",
		"ZW" => "Zimbabwe" 
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
		if ( array_key_exists( $boat_type_key, self::$boat_type_list ) ) {
			return self::$boat_type_list[ $boat_type_key ];
		}

		return $boat_type_key;
	}

	public static function get_country_name( $county_code  ) {
		
		if ( array_key_exists( $county_code , self::$country_list ) ) {
			return self::$country_list[ $county_code  ];
		}

		return $county_code;
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

}