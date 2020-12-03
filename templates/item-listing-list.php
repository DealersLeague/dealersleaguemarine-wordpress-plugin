<div class="item">
    <div class="wrapper">
        <div class="image">
            <h3>
                <a href="#" class="tag category"><?php echo $category; ?></a>
                <a href="<?php echo get_permalink( $listing->ID ); ?>" class="title"><?php echo $manufacturer . ' ' . $model; ?></a>
                <span class="tag"><?php echo $sale_status; ?></span>
            </h3>
            <a href="<?php echo get_permalink( $listing->ID ); ?>" class="image-wrapper background-image">
                <img src="<?php echo $featured_image; ?>" alt="">
            </a>
        </div>
        <!--end image-->

        <?php echo ($n_images ? '<div class="price"><i class="fa fa-image"></i> ' . $n_images . '</div>' : ''); ?>
        <?php echo ($n_videos ? '<div class="price" ' . ($n_images ? 'style="left: 7rem;"' : '') . '><i class="fa fa-video-camera"></i> ' . $n_videos . '</div>' : ''); ?>
             
        <div class="meta">
            <?php echo $currency . $price; ?>
        </div>
        <!--end meta-->
        <div class="description">
            <p><?php echo $short_description_text; ?></p>
        </div>
        <div class="additional-info">
            <ul>
                <?php foreach ( $meta_field_list as $field_name => $field_value ) {
                    if ( ! empty( $field_value ) ) {
                ?>

                <li>
                    <figure><?php echo $field_name; ?></figure>
                    <aside><?php echo $field_value; ?></aside>
                </li>
                <?php
                    }
                    } ?>
            </ul>
        </div>
        <!--end description-->
        <a href="<?php echo get_permalink( $listing->ID ); ?>" class="detail text-caps underline"><?php _e('View Listing', 'dlmarine'); ?></a>
    </div>
</div>
<!--end item-->