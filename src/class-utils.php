<?php

namespace dealersleague\marine\wordpress;

class Utils {

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
			$price = number_format( floatval( $price ), 2, ',', '.' );
			$remove = ',00';
		} else {
			$price = number_format( floatval( $price ), 2, '.', ',' );
		}
		if ( self::ends_with( $price, $remove ) ) {
			$p = explode( $remove, $price );
			$price = $p[0];
		}

		return $price;
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