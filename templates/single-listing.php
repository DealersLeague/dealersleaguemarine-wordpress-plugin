<?php
/**
 * The template for displaying single listings.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

$post_id = get_the_ID();
$listing_external_id = get_post_meta( $post_id, 'listing_external_id', true );
$listing_json_data   = maybe_unserialize( get_post_meta( $post_id, 'listing_json_data', true ) );

get_header();
?>

<main id="site-content" role="main">

	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

	?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
