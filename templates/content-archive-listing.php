<?php
use dealersleague\marine\wordpress\Utils;
?>
<div class="section-title clearfix">
    <div class="float-left float-xs-none">
        <label class="mr-3 align-text-bottom">Sort by: </label>
        <select name="sorting" id="sorting" class="small width-200px selectized" data-placeholder="Default Sorting"
                tabindex="-1" style="display: none;">
            <option value="" selected="selected">Default Sorting</option>
            <option value="" selected="selected">Newest First</option>
            <option value="" selected="selected">Oldest First</option>
            <option value="" selected="selected">Lowest Price First</option>
            <option value="" selected="selected">Highest Price First</option>
        </select>
    </div>
    <div class="float-right d-xs-none thumbnail-toggle">
        <a href="#" class="change-class" data-change-from-class="list" data-change-to-class="grid"
           data-parent-class="items">
            <i class="fa fa-th"></i>
        </a>
        <a href="#" class="change-class active" data-change-from-class="grid" data-change-to-class="list"
           data-parent-class="items">
            <i class="fa fa-th-list"></i>
        </a>
    </div>
</div>

<div class="items grid-xl-4-items grid-lg-4-items grid-md-4-items <?php echo $layout_type; ?>">

    <?php foreach ( $listings->posts as $listing ) {

	    $country        = get_post_meta( $listing->ID, 'listing_location_country', true );
	    $location       = get_post_meta( $listing->ID, 'listing_location_city', true );
	    if ( ! empty( $location ) && ! empty( $condition ) ) {
		    $location .= ', ' . $country;
        }
	    $model          = get_post_meta( $listing->ID, 'listing_model', true );
	    $manufacturer   = get_post_meta( $listing->ID, 'listing_manufacturer', true );
	    $category       = get_post_meta( $listing->ID, 'listing_boat_type', true );
	    $loa            = get_post_meta( $listing->ID, 'listing_loa', true );
	    $beam           = get_post_meta( $listing->ID, 'listing_beam', true );
	    $draft          = get_post_meta( $listing->ID, 'listing_draught', true );
	    $condition      = str_replace( '-', ' ', get_post_meta( $listing->ID, 'listing_condition', true ) );
	    $sale_status    = get_post_meta( $listing->ID, 'listing_sale_status', true );
	    $price          = Utils::format_price( get_post_meta( $listing->ID, 'listing_price', true ) );
	    $currency       = Utils::get_currency_symbol( get_post_meta( $listing->ID, 'listing_currency', true ) );
	    $featured_image = get_post_meta( $listing->ID, 'listing_featured_image', true );
	    $n_images       = get_post_meta( $listing->ID, 'listing_n_images', true );

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
	    );

        if ( $layout_type == 'grid' ) {
            include 'item-listing-grid.php';
         } else {
	        include 'item-listing-list.php';
        }

    }
    ?>

</div>

