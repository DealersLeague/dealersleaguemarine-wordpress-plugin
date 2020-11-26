<?php

// Images for slider
if ( is_array( $listing_json_data[ 'fileuploader-list-listing_images' ] ) ) {
    $image_list = $listing_json_data[ 'fileuploader-list-listing_images' ];
} else {
	$image_list = empty( $listing_json_data[ 'fileuploader-list-listing_images' ] ) ? [] : json_decode( $listing_json_data[ 'fileuploader-list-listing_images' ], true );
}
// Description
$current_site_language =  explode( '_', get_locale() );

$language = strtolower( $current_site_language[0] );

$long_description_array = empty( $listing_json_data['listing']['listing_details']['listing_managment']['long_description'] ) ? [] : $listing_json_data['listing']['listing_details']['listing_managment']['long_description'];
$long_description_text = '';
if ( count( $long_description_array ) === 1 ) {
	$long_description_text = ! empty( $long_description_array['text'][0] ) ? $long_description_array['text'][0] : '';
} else {
    foreach ( $long_description_array['language'] as $index => $long_description_language ) {
        if ( $long_description_language == $language ) {
	        $long_description_text =  $long_description_array[ 'text' ][ $index ];
	        break;
        }
    }
    if ( empty( $long_description_text ) ) {
	    $long_description_text = $long_description_array[ 'text' ][0];
    }
}
// Details
$post_id      = get_the_ID();
$boat_type    = get_post_meta( $post_id, 'listing_boat_type', true );
$manufacturer = get_post_meta( $post_id, 'listing_manufacturer', true );
$model        = get_post_meta( $post_id, 'listing_model', true );
$condition    = get_post_meta( $post_id, 'listing_condition', true );
$location     = get_post_meta( $post_id, 'listing_location', true );
$sale_status  = get_post_meta( $post_id, 'listing_sale_status', true );
$loa          = get_post_meta( $post_id, 'listing_loa', true );
$draft        = get_post_meta( $post_id, 'listing_draught', true );
$beam         = get_post_meta( $post_id, 'listing_beam', true );
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
        <section>
            <div class="owl-carousel full-width-carousel">
                <?php
                foreach ( $image_list as $index => $image ) {
                 ?>
                <div class="item background-image">
                    <img src="<?php echo $image['file']; ?>" alt="" data-hash="<?php echo $index; ?>">
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
                        <h2><?php _e('Description', 'dlmarine'); ?></h2>
                        <p>
                            <?php echo $long_description_text; ?>
                        </p>
                    </section>
                    <!--end Description-->
                    <!--Details-->
                    <section>
                        <h2><?php _e('Details', 'dlmarine' ); ?></h2>
                        <dl class="columns-3">
                            <?php if (! empty( $manufacturer ) ) { ?>
                            <dt><?php _e('Manufacturer', 'dlcrm' ); ?></dt>
                            <dd><?php echo $manufacturer; ?></dd>
                            <?php } ?>

	                        <?php if (! empty( $model ) ) { ?>
                            <dt><?php _e('Model', 'dlcrm' ); ?></dt>
                            <dd><?php echo $model; ?></dd>
	                        <?php } ?>

	                        <?php if (! empty( $boat_type ) ) { ?>
                            <dt><?php _e('Boat Type', 'dlcrm'); ?></dt>
                            <dd><?php _e( $boat_type, 'dlcrm'); ?></dd>
	                        <?php } ?>

	                        <?php if (! empty( $condition ) ) { ?>
                            <dt><?php _e('Condition', 'dlcrm' ); ?></dt>
                            <dd><?php _e( $condition, 'dlcrm'); ?></dd>
	                        <?php } ?>

	                        <?php if (! empty( $location ) ) { ?>
                            <dt><? _e('Location', 'dlcrm' ); ?></dt>
                            <dd><?php echo $location; ?></dd>
	                        <?php } ?>

	                        <?php if (! empty( $sale_status ) ) { ?>
                            <dt><?php _e('Sale Status', 'dlcrm' ); ?></dt>
                            <dd><?php _e( $sale_status, 'dlcrm'); ?></dd>
	                        <?php } ?>

	                        <?php if (! empty( $loa ) ) { ?>
                            <dt><?php _e('LOA', 'dlcrm'); ?></dt>
                            <dd><?php echo $loa; ?></dd>
	                        <?php } ?>

	                        <?php if (! empty( $draft ) ) { ?>
                            <dt><?php _e('Draft', 'dlcrm'); ?></dt>
                            <dd><?php echo $draft; ?></dd>
	                        <?php } ?>

	                        <?php if (! empty( $beam ) ) { ?>
                            <dt><?php _e('Beam', 'dlcrm' ); ?></dt>
                            <dd><?php echo $beam; ?></dd>
	                        <?php } ?>
                        </dl>
                    </section>
                    <!--end Details-->

                    <?php

	                    foreach ( $transformed_data as $section_name => $section ) {
                            if ( ! in_array( $section_name, $exclude_section_list ) && ! empty( $section ) ) {
	                            echo '<section>';
	                            echo '<h2>' . __( ucwords( str_replace( '_', ' ', $section_name ) ), 'dlcrm' ) . ' '. count($section).'</h2>';
                                echo '<div class=col-xs-12>';
	                            foreach ( $section as $field_name => $field_value ) {
                                    echo '<div class="col-xs-4">';
		                            if ( is_array( $field_value ) ) {
			                            echo '<span style="font-weight: 700;margin-right:5px;width:50%;text-align: left;">' . $field_name . '</span>';

			                            foreach ( $field_value as $subfield_name => $subfield_value ) {

			                                if ( ! is_array( $subfield_value ) ) {

				                                echo '<span style="width:50%;text-align: left;">' . $subfield_value . '</span>';

			                                } else {


			                                    if ( ( $subfield_name == 'number' || $subfield_name=='speed' )  && ! empty( $subfield_value[0] ) ) {
				                                    echo '<span style="width:50%;text-align: left;">' . $subfield_value[0] . '</span>';
                                                } elseif( $subfield_name != 'number' && $subfield_name!='speed'){
			                                        echo '<br>'.$subfield_name .' '. $subfield_value[0]. ' ';

                                                }
                                            }

			                            }


		                            } elseif( ! empty( $field_value ) ) {

			                            echo '<span style="font-weight: 700;margin-right:5px;width:50%;text-align: left;">' .  __( ucwords( str_replace( '_', ' ', $field_name ) ), 'dlcrm' ) . '</span>';
			                            echo '<span style="width:50%;text-align: left;">' . $field_value . '</span>';

		                            }
		                            echo '</div>';
	                            }
                                echo '</div>';
	                            echo '</section>';
                            }

	                    }

                    ?>
                    <!--Features-->
                    <section>
                        <h2>Features</h2>
                        <ul class="features-checkboxes columns-3">
                            <li>Quality Wood</li>
                            <li>Brushed Alluminium Handles</li>
                            <li>Foam mattress</li>
                            <li>Detachable chaise section</li>
                            <li>3 fold pull out mechanism</li>
                        </ul>
                    </section>
                    <!--end Features-->

                    <!--Features-->
                    <section>
                        <h2>Features</h2>
                        <ul class="features-checkboxes columns-3">
                            <li>Quality Wood</li>
                            <li>Brushed Alluminium Handles</li>
                            <li>Foam mattress</li>
                            <li>Detachable chaise section</li>
                            <li>3 fold pull out mechanism</li>
                        </ul>
                    </section>
                    <!--end Features-->

                    <!--Features-->
                    <section>
                        <h2>Features</h2>
                        <ul class="features-checkboxes columns-3">
                            <li>Quality Wood</li>
                            <li>Brushed Alluminium Handles</li>
                            <li>Foam mattress</li>
                            <li>Detachable chaise section</li>
                            <li>3 fold pull out mechanism</li>
                        </ul>
                    </section>
                    <!--end Features-->

                    <!--Features-->
                    <section>
                        <h2>Features</h2>
                        <ul class="features-checkboxes columns-3">
                            <li>Quality Wood</li>
                            <li>Brushed Alluminium Handles</li>
                            <li>Foam mattress</li>
                            <li>Detachable chaise section</li>
                            <li>3 fold pull out mechanism</li>
                        </ul>
                    </section>
                    <!--end Features-->

                    <!--Contact Form-->
                    <section>
                        <h2>Enquire</h2>
                        <div class="box">
                            <form class="form email">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Name</label>
                                            <input name="name" type="text" class="form-control" id="name"
                                                   placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label">Email</label>
                                            <input name="email" type="email" class="form-control" id="email"
                                                   placeholder="Your Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="col-form-label">Phone</label>
                                            <input name="phone" type="tel" class="form-control" id="phone"
                                                   placeholder="Your Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject" class="col-form-label">Subject</label>
                                            <select name="subject" id="subject">
                                                <option>Auswählen</option>
                                                <option value="Besichtigung">Besichtigung</option>
                                                <option value="Verfügbarkeit">Verfügbarkeit</option>
                                                <option value="Preisanfrage">Preisanfrage</option>
                                                <option value="Weitere Informationen">Weitere Informationen</option>

                                                <option value="request_survey">Gutachten</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!--end form-group-->
                                <div class="form-group">
                                    <label for="message" class="col-form-label">Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="4"></textarea>
                                </div>
                                <!--end form-group-->
                                <button type="submit" class="btn btn-primary">Send</button>
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
                            <a href="#" class="btn btn-primary btn-lg btn-block">Enquiry</a>
                            <a href="#" class="btn btn-primary btn-lg btn-block">Print</a>

                            <div class="social-icons">
                                <a class="social-icon" rel="nofollow" target="_blank"
                                   href="http://www.facebook.com/sharer/sharer.php?u=<?php
								   the_permalink(); ?>&title=<?php
								   the_title(); ?>">
                                    <img alt="Share on Facebook" src="<?php
									echo plugins_url( 'img/fb-social.png', __DIR__ ); ?>"/>
                                </a>

                                <a class="social-icon" rel="nofollow" target="_blank"
                                   href="http://twitter.com/intent/tweet?status=<?php
								   the_title(); ?>+<?php
								   the_permalink(); ?>">
                                    <img alt="Share on Twitter" src="<?php
									echo plugins_url( 'img/tr-social.png', __DIR__ ); ?>"/>
                                </a>

                                <a class="social-icon" rel="nofollow" target="_blank" href="mailto:?subject=<?php
								_e( 'Thought you might like this' ); ?>: <?php
								the_title(); ?>&body=<?php
								_e( 'Hi, Thought this might interest you' ); ?>: <?php
								the_permalink(); ?>">
                                    <img alt="Share via email" src="<?php
									echo plugins_url( 'img/email-social.png', __DIR__ ); ?>"/>
                                </a>

                                <a class="social-icon" rel="nofollow" target="_blank" href="whatsapp://send?text=<?php
								_e( 'Check out this boat' ); ?>: <?php
								the_permalink(); ?>">
                                    <img alt="Share via WhatsApp" src="<?php
									echo plugins_url( 'img/whatsapp-social.png', __DIR__ ); ?>"/>
                                </a>

                                <a class="social-icon" rel="nofollow" href="#" onclick="window.print();return false;">
                                    <img alt="Print this page" src="<?php
									echo plugins_url( 'img/print-social.png', __DIR__ ); ?>"/>
                                </a>
                            </div>
                        </section>
                        <!--End Author-->
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
