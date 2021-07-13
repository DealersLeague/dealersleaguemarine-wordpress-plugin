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

<!-- filter by broker -->
<?php 
global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM wp_postmeta WHERE meta_key = 'listing_manufacturer'" );
$stack = array();

foreach($results as $rsult){
	array_push($stack, $rsult->meta_value);
}

$boat_broker_name = array_unique($stack); 

$listing = $wpdb->get_results( "SELECT * FROM wp_posts WHERE post_type = 'boat'" );
$arr = [];
foreach ($listing as $key) {
	$broker_id = get_post_meta( $key->ID, 'listing_broker_id', true );
	if(!array_key_exists($broker_id,$arr)){
		$meta_key  = "broker_external_id";
		$res = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value=%s", $meta_key,$broker_id) , ARRAY_A  );
		if(!empty($res)){
			$broker_external_post_id = $res[0]['post_id'];
			$broker_location = get_post_meta($broker_external_post_id, 'broker_location', true );
			foreach ($broker_location as $l) {
				$name = isset($l["name"])?$l["name"]:"";
				$name = str_replace(" ", "_",$name);
				$arr[$broker_id] = $name;
			}
		}
	}
}
?>

<div class="filter_by_broker">
	<label class="mr-3" style="margin-bottom:0;padding:0">Sort by brocker</label>
	<input type="hidden" class="filter_param" value="<?php echo $_GET['filter'] ?>" data-id="<?php echo $_GET['filter'] ?>">
	<select name="filter_broker" id="filter_broker"  class="width-200px" >
		<?php 
		//    $meta_key = "broker_external_id";
		$res = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE meta_key = 'broker_location'"));

		if (!empty($res)) {
			
			foreach($res as $post_id){
					$broker_external_post_id = $post_id->post_id;
					// var_dump($broker_external_post_id);
					if (isset($broker_external_post_id)) {
						$broker_location = get_post_meta($broker_external_post_id, 'broker_location', true );
						foreach ($broker_location as $key) {
							$name = isset($key["name"])?$key["name"]:"";
							?><option class="option_name" <?php echo $sort == $key["name"] ? 'selected="selected"' : '' ; ?> value="<?php echo $key["name"]; ?>" ><?php echo $name ?></option><?php
						}
					}
			}
		}
		?>
	</select>
	<?php
	foreach ($arr as $key => $val) { ?>
		<input type="hidden" class='listing_id' value="<?php echo $key?>" data-id='<?php echo $val?>'>
	<?php }
	?>
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

	    $listing_json_data = maybe_unserialize( get_post_meta( $listing->ID, 'listing_json_data', true ) );
	    $short_description_text = Utils::get_short_description( $listing_json_data );
		$year = $listing_json_data['listing']['boat_details']['construction_details']['year_built'];

	    $meta_field_list = array(
		    __( 'Manufacturer', 'dlmarine' ) => $manufacturer,
		    __( 'Model', 'dlmarine' )     => $model,
		    __( 'Condition', 'dlmarine' ) => ucwords( __( $condition, 'dlmarine' ) ),
		    __( 'LOA', 'dlmarine' )       => empty( $loa ) ? '' : $loa .'m',
		    __( 'Beam', 'dlmarine' )      => empty( $beam ) ? '' : $beam .'m',
		    __( 'Draft', 'dlmarine' )     => empty( $draft ) ? '' : $draft .'m',
		    __( 'Location', 'dlmarine' )     => $location,
		    __( 'Year', 'dlmarine' )     	  => $year,
	    );

        if ( $layout_type == 'grid' ) {
            include 'item-listing-grid.php';
         } else {
	        include 'item-listing-list.php';
        }

    }
    ?>

</div>

