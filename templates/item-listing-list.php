<div class="item">
    <div class="wrapper">
        <div class="image">
            <h3>
                <a href="#" class="tag category"><?php echo $category; ?></a>
                <a href="<?php echo get_permalink( $listing->ID ); ?>" class="title"><?php echo $manufacturer . ' ' . $model; ?></a>
                <span class="tag"><?php echo $sale_status; ?></span>
            </h3>
            <a href="single-listing-1.html" class="image-wrapper background-image" style="background-image: url('https://i.insider.com/5b59df8d1982d835008b460a?width=1136&format=jpeg');">
                <img src="<?php echo $featured_image; ?>" alt="">
            </a>
        </div>
        <!--end image-->

        <div class="price"><?php echo $n_images; ?></div>
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
        <a href="<?php echo get_permalink( $listing->ID ); ?>" class="detail text-caps underline"><?php _e('Detail', 'dlmarine'); ?></a>
    </div>
</div>
<!--end item-->