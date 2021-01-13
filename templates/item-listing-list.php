<?php
use dealersleague\marine\wordpress\Utils;
?>
<div class="item">
    <div class="wrapper">
        <div class="image"> 
            <a href="<?php echo Utils::get_listing_permalink( $listing->ID ); ?>" class="image-wrapper background-image">
                <img src="<?php echo $featured_image; ?>" alt="">
            </a>
        </div>
        <!--end image-->

        <?php echo ($n_images ? '<div class="price"><i class="fa fa-image"></i> ' . $n_images . '</div>' : ''); ?>
        <?php echo ($n_videos ? '<div class="price" ' . ($n_images ? 'style="left: 7rem;"' : '') . '><i class="fa fa-video-camera"></i> ' . $n_videos . '</div>' : ''); ?>
             
        <div class="meta d-none d-xl-block">
	        <?php echo $currency . $price; ?>
        </div>
        <!--end meta-->
        <!--<div class="description">
            <p><?php echo $short_description_text; ?></p>
        </div>-->
        <div class="additional-info">
            <h3>
                <a href="#" class="tag category"><?php echo __( ucfirst( $category ) , 'dlmarine' ); ?></a>
                <a href="<?php echo get_permalink( $listing->ID ); ?>" class="title"><?php echo $manufacturer . ' ' . $model; ?></a>
            </h3>

            <ul class="d-block d-xl-none">
                <li class="price-small">
		        <?php echo $currency . $price; ?>
                </li>
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
        <?php __( 'As New', 'dlmarine' ); ?>
        <a href="<?php echo Utils::get_listing_permalink( $listing->ID ); ?>" class="detail text-caps underline"><?php _e('View Listing', 'dlmarine'); ?></a>
    </div>
</div>
<!--end item-->