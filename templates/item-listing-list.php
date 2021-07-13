<?php
use dealersleague\marine\wordpress\Utils;
?>
<?php 
if($_GET['filter']){
$broker_id = get_post_meta( $listing->ID, 'listing_broker_id', true );
$meta_key = "broker_external_id";
$res = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value=%s", $meta_key,$broker_id) , ARRAY_A  );

    foreach($res as $post_id){
        $broker_external_post_id = $post_id['post_id'];
        if (isset($broker_external_post_id)) {
            $broker_location = get_post_meta($broker_external_post_id, 'broker_location', true );
            foreach ($broker_location as $key) {
                $name = isset($key["name"])?$key["name"]:"";
                $name = str_replace(" ", "_",$name);
                ?><input type="hidden" class="listing_id" data-id="<?php echo $name; ?>" value="<?php echo  $broker_id ?>"><?php
            }
        }
    }
}

?>
<div class="item">
    <div class="wrapper">
        <div class="image"> 
            <a href="<?php echo Utils::get_listing_permalink( $listing->ID ); ?>" class="image-wrapper background-image" data-img="<?php echo $featured_image; ?>">
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
                <?php $name = empty( $range ) ? $manufacturer . ' ' . $model : $manufacturer .' '.$range.' '.$model; ?>
                <a href="<?php echo get_permalink( $listing->ID ); ?>" class="title"><?php echo $name; ?></a>
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
    </div>
    <a href="<?php echo Utils::get_listing_permalink( $listing->ID ); ?>" class="detail text-caps underline"><?php _e('View Listing', 'dlmarine'); ?></a>
</div>
<!--end item-->