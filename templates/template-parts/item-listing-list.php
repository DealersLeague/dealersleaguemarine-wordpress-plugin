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
	<div class="row">
		<div class="image col-md-5 col-sm-6"> 

			<a 
				href="<?php echo Utils::get_listing_permalink( $listing->ID ); ?>" 
				class="image-wrapper background-image" 
				data-img="<?php echo $featured_image; ?>"
				style="background-image: url('<?php echo $featured_image; ?>');">
                <img src="<?php echo $featured_image; ?>" alt="">
            </a>
			
			<div class="media-icons">
				<?php echo ($n_images ? '<div class="photos"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M7 7C5.34315 7 4 8.34315 4 10C4 11.6569 5.34315 13 7 13C8.65685 13 10 11.6569 10 10C10 8.34315 8.65685 7 7 7ZM6 10C6 9.44772 6.44772 9 7 9C7.55228 9 8 9.44772 8 10C8 10.5523 7.55228 11 7 11C6.44772 11 6 10.5523 6 10Z" fill="currentColor" /> <path fill-rule="evenodd" clip-rule="evenodd" d="M3 3C1.34315 3 0 4.34315 0 6V18C0 19.6569 1.34315 21 3 21H21C22.6569 21 24 19.6569 24 18V6C24 4.34315 22.6569 3 21 3H3ZM21 5H3C2.44772 5 2 5.44772 2 6V18C2 18.5523 2.44772 19 3 19H7.31374L14.1924 12.1214C15.364 10.9498 17.2635 10.9498 18.435 12.1214L22 15.6863V6C22 5.44772 21.5523 5 21 5ZM21 19H10.1422L15.6066 13.5356C15.9971 13.145 16.6303 13.145 17.0208 13.5356L21.907 18.4217C21.7479 18.7633 21.4016 19 21 19Z" fill="currentColor" /></svg> ' . $n_images . '</div>' : ''); ?>
				<?php echo ($n_videos ? '<div class="videos"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M4 4.5V6.5H12V7.5H3C1.34315 7.5 0 8.84315 0 10.5V16.5C0 18.1569 1.34315 19.5 3 19.5H15C16.5731 19.5 17.8634 18.2892 17.9898 16.7487L24 17.5V9.5L17.9898 10.2513C17.8634 8.71078 16.5731 7.5 15 7.5H14V5.5C14 4.94772 13.5523 4.5 13 4.5H4ZM18 12.2656V14.7344L22 15.2344V11.7656L18 12.2656ZM16 10.5C16 9.94772 15.5523 9.5 15 9.5H3C2.44772 9.5 2 9.94772 2 10.5V16.5C2 17.0523 2.44772 17.5 3 17.5H15C15.5523 17.5 16 17.0523 16 16.5V10.5Z" fill="currentColor" /></svg> ' . $n_videos . '</div>' : ''); ?>
			</div>

			<div class="kind"><a href="#" class="tag category"><?php _e( ucfirst( $category ) , 'dlmarine' ); ?></a></div>
		</div>         
				
		<div class="info col-md-7 col-sm-6">
			<div class="price-title">
				<h3>
					<a href="<?php echo get_permalink( $listing->ID ); ?>" class="title"><?php echo $name; ?></a>
				</h3>
				<h3 class="price"><?php echo $currency . $price; ?></h3>
			</div>           
			
			<div class="additional-info">          
				<ul>
					<?php 
						foreach ( $meta_field_list as $field_name => $field_value ) {
							if ( ! empty( $field_value ) ) {
								
								echo '<li><strong>' . __( $field_name, 'dlmarine') . '</strong>' . __($field_value, 'dlmarine') . '</li>';

							}
						} 
					?>
				</ul> 
			</div>
			<div class="more-info">
				<a href="<?php echo Utils::get_listing_permalink( $listing->ID ); ?>" class="btn btn-outline-primary"><?php _e('View Listing', 'dlmarine'); ?></a>
			</div>

		</div>   
	</div>        
</div>

<!--end item-->