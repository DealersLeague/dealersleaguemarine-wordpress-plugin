<?php
try {

	/**
	 * Autoload fields, so we can add more classes in the same folder without manually loading them
	 */
	spl_autoload_register( static function ( $class ) {
		$class = str_replace( 'Addcomm\Forms\Fields\\', '', $class );
		$file  = __DIR__ . '/src/fields/' . $class . '.php';
		if ( file_exists( $file ) ) {
			require_once( $file );
		}
	} );

} catch ( Exception $e ) {
	wp_die( $e->getMessage() );
}
