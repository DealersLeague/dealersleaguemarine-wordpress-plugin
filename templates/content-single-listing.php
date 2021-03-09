<?php

use dealersleague\marine\wordpress\Settings_Page;
use dealersleague\marine\wordpress\Utils;
use dealersleague\marine\wordpress\Dealers_League_Marine;

$settings = new Settings_Page();
$settings->refresh_options();

// Options for recaptcha
$recaptcha_site_key   = $settings->get_integration_option_val( 'Google reCAPTCHA', 'site_key' );
$recaptcha_secret_key = $settings->get_integration_option_val( 'Google reCAPTCHA', 'secret_key' );
$show_recaptcha       = ! empty( $recaptcha_site_key ) && ! empty( $recaptcha_secret_key );

// Options for survey
$survey_active       = false;
$survey_email        = $settings->get_integration_option_val( 'EMS Boot Check', 'survey_email' );
$survey_link         = $settings->get_integration_option_val( 'EMS Boot Check', 'survey_link' );
$survey_privacy_text = $settings->get_integration_option_val( 'EMS Boot Check', 'survey_privacy_notice' );
if ( ! empty( $survey_email ) && ! empty( $survey_link ) && ! empty( $survey_privacy_text ) ) {
	$survey_active = true;
	$link = '<a target="_blank" href="'.$survey_link.'">'.$survey_link.'</a>';
	$survey_privacy_text = str_replace( '{survey_link}', $link, $survey_privacy_text );
}


// Privacy link option
$privacy_policy_page_link = $settings->get_web_settings_option_val( 'privacy_link' );
$video_placement = $settings->get_web_settings_option_val( 'video_placement' );
$gdpr_message             = '';
if ( ! empty( $privacy_policy_page_link) ) {
	$gdpr_message = sprintf(
		__( 'I have read and agreed to the %sPrivacy Policy%s', 'dlmarine' ),
		'<a target="_blank" href="' . $privacy_policy_page_link . '">',
		'</a>'
	);
}

$hide_enquiry_button     = $settings->get_web_settings_option_val( 'hide_enquiry_button' );
$hide_print_button       = $settings->get_web_settings_option_val( 'hide_print_button' );
$hide_watch_video_button = $settings->get_web_settings_option_val( 'hide_watch_video_button' );

// Documents for download

if ( ! empty( $listing_json_data[ 'fileuploader-list-listing_documents' ] ) && is_array( $listing_json_data[ 'fileuploader-list-listing_documents' ] ) ) {
    $document_list = $listing_json_data[ 'fileuploader-list-listing_documents' ];
} else {
	$document_list = empty( $listing_json_data[ 'fileuploader-list-listing_documents' ] ) ? [] : json_decode( $listing_json_data[ 'fileuploader-list-listing_documents' ], true );
}

if ( ! empty( $listing_json_data[ 'listing_uploaded_document_list' ] ) ) { 
    $document_names = explode( ',', $listing_json_data[ 'listing_uploaded_document_list' ] );
} 

/*
 * Videos *
 * If there are no videos, the JSON sends an array with an empty string. 
 * So we get the first item and check if that is empty instead of checking if the whole array is empty.
 */
if ( empty( $listing_json_data['listing']['media']['videos']['video_upload'][0] ) ) { 
    $videos = false;
} else {
    $videos = $listing_json_data['listing']['media']['videos']['video_upload'];
}

$post_id      = get_the_ID();

$image_list = get_post_meta( $post_id, 'listing_image', true );
if (is_string($image_list)){
    $image_list = [];
}
$broker_id = get_post_meta( $post_id, 'listing_broker_id', true );
global $wpdb;
if (!is_null($broker_id)) {
    $meta_key = "broker_external_id";
    $res = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value=%s", $meta_key,$broker_id) , ARRAY_A  );
    if (!empty($res)) {
        $broker_external_post_id = $res[0]["post_id"];
        if (isset($broker_external_post_id)) {
            $broker_location = get_post_meta($broker_external_post_id, 'broker_location', true );
            
        }
    }
}
// Panorama
$panorama_list = maybe_unserialize( get_post_meta( $post_id, 'listing_panorama', true ) );
if ( empty( $panorama_list ) || ! is_array( $panorama_list ) ) {
    $panorama_list = false;
}

// Has sidebar 
$sidebar_class = 'col-md-8';
if ( ! $panorama_list && ! $videos ) {
    $sidebar_class = 'col-md-12';
}


// Details

$boat_type    = get_post_meta( $post_id, 'listing_boat_type', true );
$manufacturer = get_post_meta( $post_id, 'listing_manufacturer', true );
$range        = get_post_meta( $post_id, 'listing_range', true );
$model        = get_post_meta( $post_id, 'listing_model', true );

$post_title   = empty( $range ) ? $manufacturer . ' ' . $model : $manufacturer . ' ' . $range . ' ' . $model;//get_the_title();

$boat_name    = $listing_json_data['listing']['boat_details']['construction_details']['boat_name'];
$condition    = get_post_meta( $post_id, 'listing_condition', true );
$sale_class   = get_post_meta( $post_id, 'listing_sale_class', true );
if ( in_array( $sale_class, array( 'new','new-instock','new-onorder','new-inorder') ) ) {
    $condition = 'New';
} else {
	$condition = ucfirst( str_replace( '-', ' ', trim($condition) ) );
}
$vat_status            = get_post_meta( $post_id, 'listing_vat_status', true );
$vat_area              = get_post_meta( $post_id, 'listing_vat_paid_area', true );
$vat_separately        = get_post_meta( $post_id, 'listing_vat_stated_separately', true );
$city                  = get_post_meta( $post_id, 'listing_location_city', true );
$country               = get_post_meta( $post_id, 'listing_location_country', true );
$country               = get_post_meta( $post_id, 'flag', true );
$price_number          = get_post_meta( $post_id, 'listing_price', true );
$currency              = get_post_meta( $post_id, 'listing_currency', true );
$price                 = Utils::format_price( $price_number, $currency );
$currency              = Utils::get_currency_symbol( $currency );
$location              = get_post_meta( $post_id, 'listing_location', true );
$sale_status           = get_post_meta( $post_id, 'listing_sale_status', true );
$loa_number            = get_post_meta( $post_id, 'listing_loa', true );
$loa                   = empty( $loa_number ) ? '' : $loa_number . Utils::get_unity( 'loa' );
$draft                 = get_post_meta( $post_id, 'listing_draught', true );
$draft                 = empty( $draft ) ? '' : $draft . Utils::get_unity( 'draft' );
$year                  = get_post_meta( $post_id, 'listing_year_built', true );
$beam                  = get_post_meta( $post_id, 'listing_beam', true );
$beam                  = empty( $beam ) ? '' : $beam . Utils::get_unity( 'beam' );
$flag                  = $listing_json_data['listing']['boat_details']['registration']['flag'] ?? '';
$port                  = $listing_json_data['listing']['boat_details']['registration']['port'] ?? '';
$purpose               = $listing_json_data['listing']['boat_details']['registration']['purpose'] ?? '';
$previous_owners       = $listing_json_data['listing']['listing_details']['sales_details']['previous_owners'] ?? '';
$range                 = get_post_meta( $post_id, 'range', true );
$range                 = empty( $range ) ? '' : $range . Utils::get_unity( 'range' );
$ce_certification      = $listing_json_data['listing']['boat_details']['construction_details']['ce_certification'] ?? '';
$ce_design_category    = $listing_json_data['listing']['boat_details']['construction_details']['ce_design_category'] ?? '';
$ce_design_category    = empty( $ce_design_category ) ? '' : strtoupper( $ce_design_category ) . ' - ' . Utils::get_ce_design_category( 'a' );
$ce_passenger_capacity = $listing_json_data['listing']['boat_details']['construction_details']['ce_passenger_capacity'] ?? '';
$long_description_text = Utils::get_long_description( $listing_json_data );
$year_built            = $listing_json_data['listing']['boat_details']['construction_details']['year_built'];
$year_launched         = $listing_json_data['listing']['boat_details']['construction_details']['year_launched'];
$last_refit            = $listing_json_data['listing']['boat_details']['construction_details']['last_refit'];
$clearance             = $listing_json_data['listing']['boat_details']['dimensions']['clearance']['number'][0];
$clearance             = empty( $clearance ) ? '' : $clearance . Utils::get_unity( 'clearance' );
$displacement          = $listing_json_data['listing']['boat_details']['dimensions']['displacement']['number'][0];
$displacement          = empty( $displacement ) ? '' : $displacement . Utils::get_unity( 'displacement' );
$keel_ballast          = $listing_json_data['listing']['boat_details']['hull']['keel_ballast']['number'][0];
$keel_ballast          = empty( $keel_ballast ) ? '' : $keel_ballast . Utils::get_unity( 'keel_ballast' );
$n_images              = get_post_meta( $post_id, 'listing_n_images', true );

// Loop sections
$exclude_section_list = [
	'advert',
    'sales_details',
	'listing_managment',
	'images',
	'panorama_images',
	'videos',
	'panoramas',
	'boat_types',
    'documents',
    'registration',
    'dimensions'
];

// listing[boat_details][drive][no_engine]
if ( ! empty( $listing_json_data['listing']['boat_details']['drive']['no_engine'] ) ) {
	$exclude_section_list[] = 'drive';
}


// Tracking
if ( ! is_user_logged_in() ) {
    $visits = get_post_meta( $post_id, 'listing_visits', true );
    $visits = empty( $visits ) ? 1 : intval( $visits ) + 1;
	update_post_meta( $post_id, 'listing_visits', $visits );
}

// Related listings
$is_advanced = $settings->get_web_settings_option_val( 'related_boats' );
$similar_listings = Dealers_League_Marine::get_similar_listings( $is_advanced, $post_id, $boat_type, 3, $manufacturer, $loa_number, $price_number );

?>

<section class="content">
    <section class="block">
<!-- START Gallery Carousel -->
        <section class="single-boat-owl-carousel">
            <div class="owl-carousel full-width-carousel<?php echo ( $n_images == '1' ? ' single-image' : '' ); ?>" style="min-height: 300px;width:100%;">
                <?php
                foreach ( $image_list as $index => $image ) {
                 ?>
                <a href="<?php echo $image['file']; ?>" data-img="<?php echo $image['file']; ?>" data-featherlight="image" style="display:inline-block" class="item background-image">
                    <img class="owl-lazy" data-src="<?php echo $image['file']; ?>" data-hash="<?php echo $index; ?>" alt="<?php echo $post_title; ?>" >
                </a>
                <?php
                }
                ?>
            </div>
        </section>
<!-- END Gallery Carousel -->

<!-- START Listing Meta -->
        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-8">
                    <div class="single-listing-price"><?php echo $currency . $price; ?></div>

                    <?php if ( ! empty( $vat_status ) && strtoupper( $vat_status ) == 'PAID' ) { ?> 
                        <?php if ( strtoupper( $vat_area ) == 'EU' ) { ?> 
                            <span class="single-listing-price-vat"><?php _e('EU taxed (document existent)', 'dlmarine' ); ?></span> 
                        <?php } else { ?>
                            <span class="single-listing-price-vat"><?php _e('VAT Paid', 'dlmarine' ); ?></span> 
                        <?php } ?>  
                    <?php } ?>

                    <?php if ( ! empty( $vat_separately ) && $vat_separately == 'on' ) { ?> 
                        <span class="single-listing-price-vat"> 
                            <?php echo ( ! empty( $vat_status ) && strtoupper( $vat_status ) == 'PAID' ? ' / ' : '' ); ?> 
                            <?php _e('VAT Stated Separatly', 'dlmarine' ); ?>
                        </span> 
                    <?php } ?>

                    <h1 class="single-listing-title"><?php echo $post_title; ?></h1>

                    <div class="social-icons">
                        <a class="social-icon" rel="nofollow" target="_blank"
                            href="http://www.facebook.com/sharer/sharer.php?u=<?php
                            the_permalink(); ?>&title=<?php
                            echo $post_title; ?>">
                            <img alt="<?php _e('Share on Facebook', 'dlmarine'); ?>" src="<?php
                                echo plugins_url( 'img/fb-social.png', __DIR__ ); ?>"/>
                        </a>
                        <a class="social-icon" rel="nofollow" target="_blank"
                            href="http://twitter.com/intent/tweet?status=<?php
                            echo $post_title; ?>+<?php
                            the_permalink(); ?>">
                            <img alt="<?php _e('Share on Twitter', 'dlmarine'); ?>" src="<?php
                                echo plugins_url( 'img/tr-social.png', __DIR__ ); ?>"/>
                        </a>
                        <a class="social-icon" rel="nofollow" target="_blank" href="mailto:?subject=<?php
                            _e( 'Thought you might like this' ); ?>: <?php
                            echo $post_title; ?>&body=<?php
                            _e( 'Hi, Thought this might interest you' ); ?>: <?php
                            the_permalink(); ?>">
                            <img alt="<?php _e('Share via email', 'dlmarine'); ?>" src="<?php
                                echo plugins_url( 'img/email-social.png', __DIR__ ); ?>"/>
                        </a>
                        <a class="social-icon" rel="nofollow" target="_blank" href="whatsapp://send?text=<?php
                            _e( 'Check out this boat' ); ?>: <?php
                            the_permalink(); ?>">
                            <img alt="<?php _e('Share via WhatsApp', 'dlmarine'); ?>" src="<?php
                            echo plugins_url( 'img/whatsapp-social.png', __DIR__ ); ?>"/>
                        </a>
                        <?php if ( empty( $hide_print_button ) ) { ?>
                            <a class="social-icon" rel="nofollow" href="#" onclick="window.print();return false;">
                                <img alt="<?php _e('Print this page', 'dlmarine'); ?>" src="<?php
                                echo plugins_url( 'img/print-social.png', __DIR__ ); ?>"/>
                            </a>
                        <?php } ?>
                    </div>
                     
                </div>
                <div class="col-md-4 listing-buttons">
                    <?php if ( empty( $hide_enquiry_button ) ) { ?>
                        <a id="form_send_enquiry_btn" href="#form_send_enquiry" class="btn btn-primary btn-lg btn-block anchor-scroll"><?php _e('Enquiry', 'dlmarine'); ?></a>
                    <?php } ?>
                    <?php if ( $videos && $video_placement != 'SIDEBAR' && empty( $hide_watch_video_button ) ) { ?>
                        <a href="#video-wrapper" class="btn btn-primary btn-lg btn-block anchor-scroll"><?php _e('Watch Video', 'dlmarine'); ?></a>
                    <?php } ?> 
                    <?php if ( $survey_active ) { ?>
                        <a id="form_send_survey_btn" href="#form_send_enquiry" class="btn btn-primary btn-lg btn-block anchor-scroll"><?php _e('Request Survey', 'dlmarine'); ?></a>
                    <?php } ?>
                    
                    <?php do_action( 'after_buttons' ); ?>
                     
                </div>
                 
            </div>
        </div>
<!-- END Listing Meta -->

        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <!--============ Listing Detail =============================================================-->
                <div class="<?php echo $sidebar_class; ?> listing-mobile-order-first long-description-section">
<!-- START Description -->
                    <section>  
                        <p>
                            <?php echo $long_description_text;?>
                        </p>
                    </section>
<!-- END Description -->
 
<!-- START Videos --> 
                    <?php if ( $videos && $video_placement != 'SIDEBAR' ) { ?>
                        <section>
                            <?php foreach ( $videos as $video ) { 
                                echo '<div class="videoWrapper" id="video-wrapper">';
	                            $oembed = wp_oembed_get( $video );
	                            if ( $oembed ) {
		                            echo $oembed;
	                            } else {
		                            echo '<p>' . __( 'Click here to watch the video:', 'dlmarine' ) . ' <a href="' . $video . '">' . $video . '</a></p>';
	                            }
                                echo '</div>';
                            } ?>
                        </section>
                    <?php } ?>

                </div>
<!-- END Videos -->

<!-- START Sidebar -->
				<?php $multi_broker = true; ?>
				
                <?php if ( $panorama_list || $videos || $multi_broker ) { ?>
                    <div class="col-md-4 media-sidebar-section">
						<?php if ( $multi_broker && !empty($broker_location)) {
                                foreach ($broker_location as $key) {
                                    $name = isset($key["name"])?$key["name"]:"";
                                    $address = isset($key['address'])?$key['address']:'';
                                    $email = isset($key['email'])?$key['email']:'#';
                                    $daytime_phone = isset($key['daytime_phone'])?$key['daytime_phone']:'';
                                    $mobile = isset($key['mobile'])?$key['mobile']:'';
                                    $fax = isset($key['fax'])?$key['fax']:'';
                                    $website = isset($key['website'])?$key['website']:'';
                                 ?>
                                    <div class="broker-details">
                                        <p class="broker-name"><?php echo $name; ?></p>
                                        <address class="broker-address"><p><?php echo $address; ?></p></address>
                                        <p class="broker-email"><a href="<?php echo  $email; ?>"><?php _e( 'Send Enquiry', 'dlmarine' ); ?></a></p>
                                        <p class="broker-phone"><?php _e( 'Phone', 'dlmarine' ); ?>: <a href="tel: <?php echo $daytime_phone ?>"><?php echo $daytime_phone ?></a></p>
                                        <p class="broker-mobile"><?php _e( 'Mobile', 'dlmarine' ); ?>: <a href="tel: <?php echo $mobile ?>"><?php echo $mobile ?></a></p>
                                        <p class="broker-fax"><?php _e( 'Fax', 'dlmarine' ); ?>: <?php echo $fax; ?></p>
                                        <p><a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a></p> 
                                    </div>
        							<!-- <div class="broker-details">
        								<p class="broker-name">Blu-Yachting</p>
        								<address class="broker-address"><p></p></address>
        								<p class="broker-email"><a href="#form_send_enquiry"><?php _e( 'Send Enquiry', 'dlmarine' ); ?></a></p>
        								<p class="broker-phone"><?php _e( 'Phone', 'dlmarine' ); ?>: <a href="tel:+39-348-56 822 62">+39-348-56 822 62</a></p>
        								<p class="broker-mobile"><?php _e( 'Mobile', 'dlmarine' ); ?>: <a href="tel:+39-348-56 822 62">+39-348-56 822 62</a></p>
        								<p class="broker-fax"><?php _e( 'Fax', 'dlmarine' ); ?>: +39-0431-53 028</p>
        								<p><a target="_blank" href="http://www.blu-yachting.com">http://www.blu-yachting.com</a></p> 
        							</div> -->
						<?php }
                        } ?>

                        <?php if ( $videos && $video_placement == 'SIDEBAR' ) { ?>
                            <section class="single-listing-videos">
                                <?php foreach ( $videos as $video ) {  
                                    echo '<div class="video-single">';
                                    echo '<div class="videoWrapper">';
                                    $oembed = wp_oembed_get( $video );
                                    if ( $oembed ) {
                                        echo $oembed;
                                    } else {
                                        echo '<p>' . __( 'Click here to watch the video:', 'dlmarine' ) . ' <a href="' . $video . '">' . $video . '</a></p>';
                                    }
                                    echo '</div>';  
                                    echo '</div>';  
                                } ?>
                            </section>
                        <?php } ?>

                        <?php if ( ! empty( $panorama_list ) && is_array( $panorama_list ) ) { ?>
                        <section class="panorama-wrapper">
                            <?php foreach ( $panorama_list as $panorama ) { ?>
                                <div class='responsive-panorama'>
                                    <iframe src="<?php echo $panorama; ?>" width="100%" allow="fullscreen"></iframe>
                                </div>
                            <?php } ?>
                        </section>
                        <?php } ?>  
                    </div>  
                <?php } ?>
<!-- END Sidebar -->               
                <div class="col-md-12">

<!--Details-->
                <section>
                        <h2 class="listing-heading"><?php _e('General Details', 'dlmarine' ); ?></h2>
                        <div class="items grid grid-xl-3-items grid-lg-3-items grid-md-3-items listing-details-grid">
                            <?php if (! empty( $manufacturer ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Manufacturer', 'dlmarine' ); ?></strong>: 
                                    <?php echo $manufacturer; ?>
                                </div>
                            <?php } ?>

	                        <?php if (! empty( $model ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Model', 'dlmarine' ); ?></strong>: 
	                                <?php echo $model; ?>
                                </div>
	                        <?php } ?>

                            <?php if (! empty( $boat_name ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Boat Name', 'dlmarine' ); ?></strong>: 
	                                <?php echo $boat_name; ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $boat_type ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Category', 'dlmarine'); ?></strong>: 
	                                <?php _e( ucwords( $boat_type ), 'dlmarine'); ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $condition ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Condition', 'dlmarine' ); ?></strong>: 
	                                <?php _e( ucwords( $condition ), 'dlmarine'); ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $location ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Location', 'dlmarine' ); ?></strong>: 
	                                <?php echo $location; ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $sale_status ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Sale Status', 'dlmarine' ); ?></strong>: 
	                                <?php _e( ucwords( $sale_status ), 'dlmarine'); ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $loa ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('LOA', 'dlmarine'); ?></strong>: 
	                                <?php echo $loa; ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $draft ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Draft', 'dlmarine'); ?></strong>: 
	                                <?php echo $draft; ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $beam ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Beam', 'dlmarine' ); ?></strong>: 
	                                <?php echo $beam; ?>
                                </div>
                            <?php } ?>
                            
                            <?php if (! empty( $city ) && ! empty( $country) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Location', 'dlmarine' ); ?></strong>: 
					                <?php $country = Utils::get_country_name( $country ); ?>
                                    <?php echo $city .', ' . $country; ?>
                                </div>
			                <?php } ?>

                            <?php if (! empty( $flag ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Flag', 'dlmarine' ); ?></strong>: 
					                <?php echo Utils::get_country_name( $flag ); ?> 
                                </div>
			                <?php } ?>

                            <?php if (! empty( $port ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Port', 'dlmarine' ); ?></strong>: 
	                                <?php echo $port; ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $purpose ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Purpose', 'dlmarine' ); ?></strong>: 
	                                <?php echo __( ucfirst( $purpose ), 'dlmarine' ); ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $previous_owners ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Previous Owners', 'dlmarine' ); ?></strong>: 
	                                <?php echo $previous_owners; ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $range ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Range', 'dlmarine' ); ?></strong>: 
	                                <?php echo $range; ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $ce_certification ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('CE Certification', 'dlmarine' ); ?></strong>: 
	                                <?php echo $ce_certification; ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $ce_design_category ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('CE Design Category', 'dlmarine' ); ?></strong>: 
	                                <?php echo $ce_design_category; ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $ce_passenger_capacity ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('CE Passenger Capacity', 'dlmarine' ); ?></strong>: 
	                                <?php echo $ce_passenger_capacity; ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $year_built ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Year Built', 'dlmarine' ); ?></strong>: 
	                                <?php echo $year_built; ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $year_launched ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Year Launched', 'dlmarine' ); ?></strong>: 
	                                <?php echo $year_launched; ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $last_refit ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Last Refit', 'dlmarine' ); ?></strong>: 
	                                <?php echo $last_refit; ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $clearance ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Clearance', 'dlmarine' ); ?></strong>: 
	                                <?php echo $clearance; ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $displacement ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Displacement', 'dlmarine' ); ?></strong>: 
	                                <?php echo $displacement; ?>
                                </div>
                            <?php } ?>

                            <?php if (! empty( $keel_ballast ) ) { ?>
                                <div class="item boat-info-item item-title">
                                    <strong><?php _e('Ballast', 'dlmarine' ); ?></strong>: 
	                                <?php echo $keel_ballast; ?>
                                </div>
                            <?php } ?>
 
                        </div>
                    </section>
                    

                    <section class="listing-accordion">

                    <?php

                        foreach ( $transformed_data as $section_name => $section ) {
                            if ( ! in_array( $section_name, $exclude_section_list ) && ! empty( $section ) ) {
                                
                                echo '<h2 class="listing-heading">' . Utils::check_translation( $section_name ) . '<i class="fa fa-sort-down"></i></h2>';
                                echo ' <div class="items grid grid-xl-3-items grid-lg-3-items grid-md-3-items listing-details-grid">';
                                foreach ( $section as $field_name => $field_value ) {
                                    if( ! empty( $field_value ) ) {
                                        $val = str_replace( '_', ' ', $field_value );
                                        $val = str_replace( '-', ' ', $val );
                                        $name = ( $field_name == 'vat' ) ? __('VAT', 'dlmarine') : $field_name;//__( ucwords( str_replace( '_', ' ', $field_name ) ), 'dlmarine');
                                        $name = ( $field_name == 'boat_types' ) ? __('Category', 'dlmarine') : $field_name;//__( ucwords( str_replace( '_', ' ', $field_name ) ), 'dlmarine');
                                        echo '<div class="item boat-info-item">';
                                        echo '<span class="item-title"><strong>' .  Utils::check_translation( $name ) . '</strong></span>';
                                        if ( ! empty( trim($val) ) && trim($val) != '<br>' && trim( $val ) != ' <br><strong> </strong>   ' && trim( strtolower($val) ) != 'on' ) {
	                                        echo ':  <span>' . ltrim( Utils::check_translation( $val ), ' ' ) . '</span>';
                                        }
                                        echo '</div>';
                                    }
                                }
                                echo '</div>'; 
                            }

                        }

                        
                        do_action('after_accordion', 
                            $manufacturer, 
                            $model, 
                            $year, 
                            $price 
                        );

                    ?>

                    </section>

                    <?php if ( ! empty( $document_list ) ) {

                        echo '<h2 class="listing-heading">' . __( 'Documents', 'dlmarine' ) . '</h2>';

                        echo '<ul>';

                            foreach ( $document_list as $index => $doc ) { 
                                echo '<li>';
                                    echo '<a href="' . $doc['file'] . '">' . $document_names[$index] . '</a>'; 
                                echo '</li>';
                            }

                        echo '</ul>';

                    } ?> 

                    
<!-- START Contact Form-->
                    <?php if ( $show_recaptcha ) { ?>
                    <script>
                        function reCaptchaVerify(response) {
                            if (response === document.querySelector('.g-recaptcha-response').value) {
                                jQuery('#btn-send-enquiry').prop("disabled", false);
                            } else {
                                jQuery('#btn-send-enquiry').prop("disabled", true);
                            }
                        }
                        function reCaptchaExpired () {

                        }
                        function reCaptchaCallback () {
                            grecaptcha.render('g-recaptcha', {
                                'sitekey': "<?php echo $recaptcha_site_key; ?>",
                                'callback': reCaptchaVerify,
                                'expired-callback': reCaptchaExpired
                            });
                        }
                    </script>
                    <?php } ?>

                    <section>
                        <h2><?php _e('Enquiry', 'dlmarine'); ?></h2>
                        <div class="box">
                            <form class="form email" id="form_send_enquiry" method="post">
                                <input type="hidden" name="enquiry[current_url]" value="<?php the_permalink();?>">
                                <input type="hidden" name="enquiry[boat_name]" value="<?php echo $manufacturer.' '.$model;?>">

                                <div class="success" style="display: none;"></div>
                                <div class="error" style="display: none;"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label"><?php _e('Name', 'dlmarine'); ?></label>
                                            <input name="enquiry[name]" type="text" class="form-control" id="name" placeholder="<?php _e('Your Name', 'dlmarine'); ?>" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label"><?php _e('Email', 'dlmarine'); ?></label>
                                            <input name="enquiry[email]" type="email" class="form-control" id="email" placeholder="<?php _e('Your Email', 'dlmarine'); ?>" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="col-form-label"><?php _e('Phone', 'dlmarine'); ?></label>
                                            <input name="enquiry[phone]" type="tel" class="form-control" id="phone" placeholder="<?php _e('Your Phone', 'dlmarine'); ?>" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject" class="col-form-label"><?php _e('Subject', 'dlmarine'); ?></label>
                                            <select name="enquiry[subject]" id="enquiry-subject" required="required">
                                                <option value=""><?php _e('Choose an option', 'dlmarine'); ?></option>
                                                <option value="<?php _e('Viewing', 'dlmarine'); ?>"><?php _e('Viewing', 'dlmarine'); ?></option>
                                                <option value="<?php _e('Availability', 'dlmarine'); ?>"><?php _e('Availability', 'dlmarine'); ?></option>
                                                <option value="<?php _e('Pricing', 'dlmarine'); ?>"><?php _e('Pricing', 'dlmarine'); ?></option>
                                                <option value="<?php _e('Further Information', 'dlmarine'); ?>"><?php _e('Further Information', 'dlmarine'); ?></option>
                                                <?php if ( $survey_active ) { ?>
                                                <option value="request_survey"><?php _e('Request Survey', 'dlmarine'); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div id="message-wrapper" class="form-group">
                                    <label for="message" class="col-form-label"><?php _e('Message', 'dlmarine'); ?></label>
                                    <textarea name="enquiry[message]" id="message" class="form-control" rows="4" style="resize: none;"></textarea>
                                </div>
                                <?php if ( $survey_active ) { ?>
                                <div id="survey-wrapper" class="form-group" style="display:none;">
                                    <span><?php echo $survey_privacy_text; ?></span>
                                </div>
                                <?php } ?>

                                <?php if ( ! empty( $gdpr_message ) ) { ?>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="enquiry[gdpr]" value="yes" required>
                                        <?php echo $gdpr_message; ?>
                                    </label>
                                </div>
                                <?php } ?>
 
                                <?php if ( $show_recaptcha ) { ?>
                                <div id="g-recaptcha" class="m-b-20 m-t-20"></div>
                                <script src="https://www.google.com/recaptcha/api.js?onload=reCaptchaCallback&render=explicit" async defer></script>
                                <?php } ?>
                                <button type="submit" id="btn-send-enquiry" class="btn btn-primary btn-send-enquiry"><?php _e('Send', 'dlmarine'); ?></button>


                            </form>
                        </div>
                    </section>
<!-- END Contact Form-->

                    <?php if ( ! empty( $similar_listings ) ) { ?>

                    <section class="related-boats-section">
                        <h2><?php _e('Related Boats', 'dlmarine' ); ?></h2>
                        <div class="items grid grid-xl-<?php echo count( $similar_listings ); ?>-items grid-lg-<?php echo count( $similar_listings ); ?>-items grid-md-<?php echo count( $similar_listings ); ?>-items dlmarine-similar-listings">

                        <?php foreach ( $similar_listings as $similar_listing ) { ?>

                            <?php
	                        $country        = get_post_meta( $similar_listing->ID, 'listing_location_country', true );
	                        $location       = get_post_meta( $similar_listing->ID, 'listing_location_city', true );
	                        if ( ! empty( $location ) && ! empty( $country ) ) {
		                        $location .= ', ' . Utils::get_country_name( $country );
	                        }
	                        $model          = get_post_meta( $similar_listing->ID, 'listing_model', true );
	                        $manufacturer   = get_post_meta( $similar_listing->ID, 'listing_manufacturer', true );
	                        $category       = get_post_meta( $similar_listing->ID, 'listing_boat_type', true );
	                        $loa            = get_post_meta( $similar_listing->ID, 'listing_loa', true );
	                        $beam           = get_post_meta( $similar_listing->ID, 'listing_beam', true );
	                        $draft          = get_post_meta( $similar_listing->ID, 'listing_draught', true );
	                        $condition      = get_post_meta( $post_id, 'listing_condition', true );
	                        $sale_status    = get_post_meta( $similar_listing->ID, 'listing_sale_status', true );
	                        $sale_class     = get_post_meta( $post_id, 'listing_sale_class', true );
	                        if ( in_array( $sale_class, array( 'new','new-instock','new-onorder','new-inorder') ) ) {
		                        $condition = 'New';
	                        } else {
		                        $condition = ucfirst( str_replace( '-', ' ', trim($condition) ) );
	                        }
	                        $currency_code  = get_post_meta( $similar_listing->ID, 'listing_currency', true );
	                        $currency       = Utils::get_currency_symbol( $currency_code );
	                        $price          = Utils::format_price( get_post_meta( $similar_listing->ID, 'listing_price', true ), $currency_code );
	                        $featured_image = get_post_meta( $similar_listing->ID, 'listing_featured_image', true );
	                        $n_images       = get_post_meta( $similar_listing->ID, 'listing_n_images', true );
	                        $n_videos       = get_post_meta( $similar_listing->ID, 'listing_n_videos', true );

	                        $meta_field_list = array(
		                        __( 'Manufacturer', 'model' ) => $manufacturer,
		                        __( 'Model', 'dlmarine' )     => $model,
		                        __( 'Condition', 'dlmarine' ) => ucwords( __( $condition, 'dlmarine' ) ),
		                        __( 'LOA', 'dlmarine' )       => empty( $loa ) ? '' : $loa .'m',
		                        __( 'Beam', 'dlmarine' )      => empty( $beam ) ? '' : $beam .'m',
		                        __( 'Draft', 'dlmarine' )     => empty( $draft ) ? '' : $draft .'m',
		                        __( 'Location', 'model' )     => $location,
	                        );
                            ?>
                            <div class="item item-similar-listing">
                                <div class="wrapper">
                                    <div class="image">
                                        <a href="<?php echo Utils::get_listing_permalink( $similar_listing->ID ); ?>" class="image-wrapper background-image" data-img="<?php echo $featured_image;?>">
                                            <img src="<?php echo $featured_image;?>" alt="">
                                        </a>
                                    </div>
                                    <!--end image-->

	                                <?php echo ($n_images ? '<div class="price"><i class="fa fa-image"></i> ' . $n_images . '</div>' : ''); ?>
	                                <?php echo ($n_videos ? '<div class="price" ' . ($n_images ? 'style="left: 7rem;"' : '') . '><i class="fa fa-video-camera"></i> ' . $n_videos . '</div>' : ''); ?>


                                    <div class="price-left"><a href="#" class="tag category"><?php echo __( ucfirst( $category ) , 'dlmarine' ); ?></a></div>

                                    <!--end meta-->
                                    <!--<div class="description">
										<p></p>
									</div>-->
                                    <div class="additional-info">
                                        <h3>
                                            <a href="<?php echo get_permalink( $similar_listing->ID ); ?>" class="title"><?php echo $manufacturer . ' ' . $model; ?></a>
                                        </h3>

                                        <ul>
                                            <li class="price-small"><?php echo $currency . $price; ?></li>
                                        </ul>

                                        <ul>
		                                    <?php foreach ( $meta_field_list as $field_name => $field_value ) {
			                                    if ( ! empty( $field_value ) ) {
				                                    ?>

                                                    <li>
                                                        <strong><?php echo __( $field_name, 'dlmarine'); ?></strong>
					                                    <?php echo __($field_value, 'dlmarine'); ?>
                                                    </li>
				                                    <?php
			                                    }
		                                    } ?>
                                        </ul>
                                    </div>
                                    <!--end description-->
                                    <a href="<?php echo Utils::get_listing_permalink( $similar_listing->ID ); ?>" class="detail text-caps"><?php _e('View Listing', 'dlmarine'); ?></a>
                                </div>
                            </div>

                        <?php } ?>

                        </div>
                    </section>
                    <?php } ?>

                </div>
<!--============ End Listing Detail =========================================================--> 
            </div>
        </div>
<!--end container-->
    </section>
<!--end block-->
</section>
<!--end content-->