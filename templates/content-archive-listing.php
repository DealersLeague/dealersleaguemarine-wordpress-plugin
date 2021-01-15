<?php
use dealersleague\marine\wordpress\Utils;
/*
 * vars $sort, $layout_type and $listings come from archive shortcode, which includes this file
 */
?>
<div class="section-title clearfix">
    <?php if ( empty( $hide_order_by ) ) { ?>
    <div class="float-left float-xs-none" style="display: flex;align-items: center;">
        <label class="mr-3" style="margin-bottom:0;padding:0"><?php _e('Sort by:', 'dlmarine'); ?></label>
        <select name="sorting" id="sorting" class="width-200px" data-placeholder="<?php _e( 'Default Sorting', 'dlmarine');?>" >
            <option value="<?php echo esc_url( remove_query_arg( 'sort' ) )?>"><?php _e( 'Default Sorting', 'dlmarine');?></option>
            <option <?php echo $sort == 'date_desc' ? 'selected="selected"' : '' ; ?> value="<?php echo esc_url( add_query_arg( 'sort', 'date_desc' ) )?>"><?php _e( 'Newest First', 'dlmarine');?></option>
            <option <?php echo $sort == 'date_asc' ? 'selected="selected"' : '' ; ?> value="<?php echo esc_url( add_query_arg( 'sort', 'date_asc' ) )?>"><?php _e( 'Oldest First', 'dlmarine');?></option>
            <option <?php echo $sort == 'price_asc' ? 'selected="selected"' : '' ; ?> value="<?php echo esc_url( add_query_arg( 'sort', 'price_asc' ) )?>"><?php _e( 'Lowest Price First', 'dlmarine');?></option>
            <option <?php echo $sort == 'price_desc' ? 'selected="selected"' : '' ; ?> value="<?php echo esc_url( add_query_arg( 'sort', 'price_desc' ) )?>"><?php _e( 'Highest Price First', 'dlmarine');?></option>
        </select>

    </div>
    <?php } ?>
    <div class="float-right d-xs-none thumbnail-toggle">
        <a href="#" class="change-class <?php echo ($layout_type == 'grid' ? 'active' : ''); ?>" data-change-from-class="list" data-change-to-class="grid"
           data-parent-class="items">
            <i class="fa fa-th"></i>
        </a>
        <a href="#" class="change-class <?php echo ($layout_type == 'list' ? 'active' : ''); ?>" data-change-from-class="grid" data-change-to-class="list"
           data-parent-class="items">
            <i class="fa fa-th-list"></i>
        </a>
    </div>
</div>

<div class="items grid-xl-4-items grid-lg-4-items grid-md-4-items <?php echo $layout_type; ?>">

    <?php foreach ( $listings->posts as $listing ) {

	    $country        = get_post_meta( $listing->ID, 'listing_location_country', true );
	    $location       = get_post_meta( $listing->ID, 'listing_location_city', true );
	    if ( ! empty( $location ) && ! empty( $country ) ) {
		    $location .= ', ' . Utils::get_country_name( $country );
        }
	    $model          = get_post_meta( $listing->ID, 'listing_model', true );
	    $manufacturer   = get_post_meta( $listing->ID, 'listing_manufacturer', true );
	    $range          = get_post_meta( $listing->ID, 'listing_range', true );
	    $category       = get_post_meta( $listing->ID, 'listing_boat_type', true );
	    $loa            = get_post_meta( $listing->ID, 'listing_loa', true );
	    $beam           = get_post_meta( $listing->ID, 'listing_beam', true );
	    $draft          = get_post_meta( $listing->ID, 'listing_draught', true );
	    $condition    = get_post_meta( $listing->ID, 'listing_condition', true );
	    $sale_class   = get_post_meta( $listing->ID, 'listing_sale_class', true );
	    if ( in_array( $sale_class, array( 'new','new-instock','new-onorder','new-inorder') ) ) {
		    $condition = 'New';
	    } else {
		    $condition = ucfirst( str_replace( '-', ' ', $condition ) );
	    }
	    $sale_status    = get_post_meta( $listing->ID, 'listing_sale_status', true );
	    $currency_code  = get_post_meta( $listing->ID, 'listing_currency', true );
	    $currency       = Utils::get_currency_symbol( $currency_code );
	    $price          = Utils::format_price( get_post_meta( $listing->ID, 'listing_price', true ), $currency_code );
	    $featured_image = get_post_meta( $listing->ID, 'listing_featured_image', true );
	    $n_images       = get_post_meta( $listing->ID, 'listing_n_images', true );
	    $n_videos       = get_post_meta( $listing->ID, 'listing_n_videos', true ); 

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

