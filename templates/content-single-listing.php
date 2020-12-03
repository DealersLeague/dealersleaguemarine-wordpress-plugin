<?php

use dealersleague\marine\wordpress\Settings_Page;
use dealersleague\marine\wordpress\Utils;

$settings = new Settings_Page();
$settings->refresh_options();
// Options for recaptcha
$recaptcha_site_key   = $settings->get_integration_option_val( 'Google reCAPTCHA', 'site_key' );
$recaptcha_secret_key = $settings->get_integration_option_val( 'Google reCAPTCHA', 'secret_key' );
$show_recaptcha       = ! empty( $recaptcha_site_key ) && ! empty( $recaptcha_secret_key );
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

// Images for slider
if ( is_array( $listing_json_data[ 'fileuploader-list-listing_images' ] ) ) {
    $image_list = $listing_json_data[ 'fileuploader-list-listing_images' ];
} else {
	$image_list = empty( $listing_json_data[ 'fileuploader-list-listing_images' ] ) ? [] : json_decode( $listing_json_data[ 'fileuploader-list-listing_images' ], true );
}

// Documents for download
if ( is_array( $listing_json_data[ 'fileuploader-list-listing_documents' ] ) ) {
    $document_list = $listing_json_data[ 'fileuploader-list-listing_documents' ]; 
} else {
	$document_list = empty( $listing_json_data[ 'fileuploader-list-listing_documents' ] ) ? [] : json_decode( $listing_json_data[ 'fileuploader-list-listing_documents' ], true ); 
} 

if ( ! empty( $listing_json_data[ 'listing_uploaded_document_list' ] ) ) { 
    $document_names = explode( ',', $listing_json_data[ 'listing_uploaded_document_list' ] );
} 

// videos 
if ( is_array( $listing_json_data['listing']['media']['videos']['video_upload'] ) ) {
    $videos = $listing_json_data['listing']['media']['videos']['video_upload'];
} else {
    $videos = false;
}

$long_description_text = Utils::get_long_description( $listing_json_data );

// Details
$post_id      = get_the_ID();
$post_title   = get_the_title();
$boat_type    = get_post_meta( $post_id, 'listing_boat_type', true );
$manufacturer = get_post_meta( $post_id, 'listing_manufacturer', true );
$model        = get_post_meta( $post_id, 'listing_model', true );
$condition    = get_post_meta( $post_id, 'listing_condition', true );
$condition    = str_replace( '-', ' ', $condition );
$location     = get_post_meta( $post_id, 'listing_location', true );
$sale_status  = get_post_meta( $post_id, 'listing_sale_status', true );
$loa          = get_post_meta( $post_id, 'listing_loa', true ) . Utils::get_unity( 'loa' );
$draft        = get_post_meta( $post_id, 'listing_draught', true ) . Utils::get_unity( 'draught' );
$beam         = get_post_meta( $post_id, 'listing_beam', true ) . Utils::get_unity( 'beam' );
// Loop sections
$exclude_section_list = [
	'advert',
	'listing_managment',
	'images',
	'panorama_images',
	'videos',
	'panoramas',
	'documents'
];

?>

<section class="content">
    <section class="block">
        <!--Gallery Carousel-->
        <section class="single-boat-owl-carousel">
            <div class="owl-carousel full-width-carousel" style="min-height: 300px;width:100%;">
                <?php
                foreach ( $image_list as $index => $image ) {
                 ?>
                <div class="item background-image">
                    <img class="owl-lazy" data-src="<?php echo $image['file']; ?>" data-hash="<?php echo $index; ?>" alt="<?php echo $post_title; ?>" >
                </div>
                <?php
                }
                ?>
            </div>
        </section>
        <!--end Gallery Carousel-->
        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <!--============ Listing Detail =============================================================-->
                <div class="col-md-8">
                    <!--Description-->
                    <section>
                        <h2 class="listing-heading"><?php _e('Description', 'dlmarine'); ?></h2>
                        <p>
                            <?php echo $long_description_text;?>
                        </p>
                    </section>
                    <!--end Description-->
                    <!--Details-->
                    <section>
                        <h2 class="listing-heading"><?php _e('General Details', 'dlmarine' ); ?></h2>
                        <div class="items grid grid-xl-3-items grid-lg-3-items grid-md-3-items">
                            <?php if (! empty( $manufacturer ) ) { ?>
                                <div class="item boat-info-item">
                                    <strong><?php _e('Manufacturer', 'dlmarine' ); ?></strong><br>
                                    <?php echo $manufacturer; ?>
                                </div>
                            <?php } ?>

	                        <?php if (! empty( $model ) ) { ?>
                                <div class="item boat-info-item">
                                    <strong><?php _e('Model', 'dlmarine' ); ?></strong><br>
	                                <?php echo $model; ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $boat_type ) ) { ?>
                                <div class="item boat-info-item">
                                    <strong><?php _e('Boat Type', 'dlmarine'); ?></strong><br>
	                                <?php _e( $boat_type, 'dlmarine'); ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $condition ) ) { ?>
                                <div class="item boat-info-item">
                                    <strong><?php _e('Condition', 'dlmarine' ); ?></strong><br>
	                                <?php _e( $condition, 'dlmarine'); ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $location ) ) { ?>
                                <div class="item boat-info-item">
                                    <strong><? _e('Location', 'dlmarine' ); ?></strong><br>
	                                <?php echo $location; ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $sale_status ) ) { ?>
                                <div class="item boat-info-item">
                                    <strong><?php _e('Sale Status', 'dlmarine' ); ?></strong><br>
	                                <?php _e( $sale_status, 'dlmarine'); ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $loa ) ) { ?>
                                <div class="item boat-info-item">
                                    <strong><?php _e('LOA', 'dlmarine'); ?></strong><br>
	                                <?php echo $loa; ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $draft ) ) { ?>
                                <div class="item boat-info-item">
                                    <strong><?php _e('Draft', 'dlmarine'); ?></strong><br>
	                                <?php echo $draft; ?>
                                </div>
	                        <?php } ?>

	                        <?php if (! empty( $beam ) ) { ?>
                                <div class="item boat-info-item">
                                    <strong><?php _e('Beam', 'dlmarine' ); ?></strong><br>
	                                <?php echo $beam; ?>
                                </div>
	                        <?php } ?>
                        </div>
                    </section>
                    <!--end Details-->

                    <?php if ( $videos && $video_placement != 'SIDEBAR' ) { ?>
                        <section>
                            <?php foreach ( $videos as $video ) { 
                                echo '<div class="videoWrapper">';
                                    echo wp_oembed_get( $video );  
                                echo '</div>';
                            } ?>
                        </section>
                    <?php } ?>

                    <?php

	                    foreach ( $transformed_data as $section_name => $section ) {
                            if ( ! in_array( $section_name, $exclude_section_list ) && ! empty( $section ) ) {
	                            echo '<section>';
	                            echo '<h2 class="listing-heading">' . __( ucwords( str_replace( '_', ' ', $section_name ) ), 'dlmarine' ) . '</h2>';
                                echo ' <div class="items grid grid-xl-3-items grid-lg-3-items grid-md-3-items">';
	                            foreach ( $section as $field_name => $field_value ) {
                                    if( ! empty( $field_value ) ) {
                                        $val = str_replace( '_', ' ', $field_value );
                                        $val = str_replace( '-', ' ', $val );
                                        $name = ( $field_name == 'vat' ) ? __('VAT', 'dlmarine') : __( ucwords( str_replace( '_', ' ', $field_name ) ), 'dlmarine');
                                        $name = ( $field_name == 'boat_types' ) ? __('Category', 'dlmarine') : __( ucwords( str_replace( '_', ' ', $field_name ) ), 'dlmarine');
                                        echo '<div class="item boat-info-item">';
			                            echo '<span><strong>' .  $name . '</strong></span><br>';
			                            echo '<span>' . ltrim( $val, ' ' ) . '</span>';
			                            echo '</div>';
		                            }
	                            }
                                echo '</div>';
	                            echo '</section>';
                            }

	                    }

                    ?>

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

                    <section>
                    </section>

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

                    <!--Contact Form-->
                    <section>
                        <h2><?php _e('Enquiry', 'dlmarine'); ?></h2>
                        <div class="box">
                            <form class="form email" id="form_send_enquiry" method="post">
                                <input type="hidden" name="enquiry['current_url]" value="<?php the_permalink();?>">
                                <input type="hidden" name="enquiry['boat_name]" value="<?php echo $manufacturer.' '.$model;?>">

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
                                            <select name="enquiry[subject]" id="subject" required="required">
                                                <option value=""><?php _e('Choose an option', 'dlmarine'); ?></option>
                                                <option value="<?php _e('Viewing', 'dlmarine'); ?>"><?php _e('Viewing', 'dlmarine'); ?></option>
                                                <option value="<?php _e('Availability', 'dlmarine'); ?>"><?php _e('Availability', 'dlmarine'); ?></option>
                                                <option value="<?php _e('Pricing', 'dlmarine'); ?>"><?php _e('Pricing', 'dlmarine'); ?></option>
                                                <option value="<?php _e('Further Information', 'dlmarine'); ?>"><?php _e('Further Information', 'dlmarine'); ?></option>

                                                <option value="request_survey"><?php _e('Request Survey', 'dlmarine'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!--end form-group-->
                                <div class="form-group">
                                    <label for="message" class="col-form-label"><?php _e('Message', 'dlmarine'); ?></label>
                                    <textarea name="enquiry[message]" id="message" class="form-control" rows="4" style="resize: none;"></textarea>
                                </div>
                                <?php if ( ! empty( $gdpr_message ) ) { ?>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="enquiry[gdpr]" value="yes" required>
                                        <?php echo $gdpr_message; ?>
                                    </label>
                                </div>
                                <?php } ?>
                                <!--end form-group-->
                                <?php if ( $show_recaptcha ) { ?>
                                <div id="g-recaptcha" class="m-b-20 m-t-20"></div>
                                <script src="https://www.google.com/recaptcha/api.js?onload=reCaptchaCallback&render=explicit" async defer></script>
                                <?php } ?>
                                <button type="submit" id="btn-send-enquiry" class="btn btn-primary btn-send-enquiry"><?php _e('Send', 'dlmarine'); ?></button>


                            </form>
                        </div>
                    </section>
                    <!--end Contact Form-->


                </div>
                <!--============ End Listing Detail =========================================================-->
                <!--============ Sidebar ====================================================================-->
                <div class="col-md-4">
                    <aside class="sidebar">
                        <!--Author-->
                        <section>
                            <a href="#" class="btn btn-primary btn-lg btn-block"><?php _e('Enquiry', 'dlmarine'); ?></a>
                            <a href="#" class="btn btn-primary btn-lg btn-block"><?php _e('Print', 'dlmarine'); ?></a>

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
                                <a class="social-icon" rel="nofollow" href="#" onclick="window.print();return false;">
                                    <img alt="<?php _e('Print this page', 'dlmarine'); ?>" src="<?php
                                    echo plugins_url( 'img/print-social.png', __DIR__ ); ?>"/>
                                </a>
                            </div>
                        </section>
                        <!--End Author-->

                        <?php if ( $videos && $video_placement == 'SIDEBAR' ) { ?>
                            <section>
                                <?php foreach ( $videos as $video ) {  
                                    echo '<div class="videoWrapper">';
                                        echo wp_oembed_get( $video );  
                                    echo '</div>';  
                                } ?>
                            </section>
                        <?php } ?>
                    </aside>
                </div>
                <!--============ End Sidebar ================================================================-->
            </div>
        </div>
        <!--end container-->
    </section>
    <!--end block-->
</section>
<!--end content-->
