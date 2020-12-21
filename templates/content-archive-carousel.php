<?php
use dealersleague\marine\wordpress\Utils;
/*
 * vars $sort, $layout_type and $listings come from archive shortcode, which includes this file
 */
?>
<div class="archive-carousel owl-carousel">

    <?php foreach ( $listings->posts as $listing ) {

        $category       = get_post_meta( $listing->ID, 'listing_boat_type', true );
        $manufacturer   = get_post_meta( $listing->ID, 'listing_manufacturer', true );
        $country        = get_post_meta( $listing->ID, 'listing_location_country', true );
        $condition      = str_replace( '-', ' ', get_post_meta( $listing->ID, 'listing_condition', true ) );
        $featured_image = get_post_meta( $listing->ID, 'listing_featured_image', true );
	    $n_images       = get_post_meta( $listing->ID, 'listing_n_images', true );
	    $n_videos       = get_post_meta( $listing->ID, 'listing_n_videos', true );
        
        /*$location       = get_post_meta( $listing->ID, 'listing_location_city', true );
	    if ( ! empty( $location ) && ! empty( $condition ) ) {
		    $location .= ', ' . $country;
        }
	    $model          = get_post_meta( $listing->ID, 'listing_model', true );
	    
	    
	    $loa            = get_post_meta( $listing->ID, 'listing_loa', true );
	    $beam           = get_post_meta( $listing->ID, 'listing_beam', true );
	    $draft          = get_post_meta( $listing->ID, 'listing_draught', true );
	    
	    $sale_status    = get_post_meta( $listing->ID, 'listing_sale_status', true );
	    $currency_code  = get_post_meta( $listing->ID, 'listing_currency', true );
	    $currency       = Utils::get_currency_symbol( $currency_code );
	    $price          = Utils::format_price( get_post_meta( $listing->ID, 'listing_price', true ), $currency_code );
	    

	    $listing_json_data = get_post_meta( $listing->ID, 'listing_json_data', true );
	    $short_description_text = Utils::get_short_description( $listing_json_data );

	    $meta_field_list = array(
		    __( 'Manufacturer', 'model' ) => $manufacturer,
		    __( 'Model', 'dlmarine' )     => $model,
		    __( 'Condition', 'dlmarine' ) => ucwords( __( $condition, 'dlmarine' ) ),
		    __( 'LOA', 'dlmarine' )       => empty( $loa ) ? '' : $loa .'m',
		    __( 'Beam', 'dlmarine' )      => empty( $beam ) ? '' : $beam .'m',
		    __( 'Draft', 'dlmarine' )     => empty( $draft ) ? '' : $draft .'m',
		    __( 'Location', 'model' )     => $location,
	    );*/

        ?>

        <div class="item">
            <a class="archive-carousel-item owl-lazy" data-src="<?php echo $featured_image; ?>" href="<?php the_permalink($listing->ID); ?>"> 
            </a>
        </div>
        <!--end item-->

        <?php

    }
    ?>

</div>

