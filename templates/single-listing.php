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

<div class="wrapper" id="full-width-page-wrapper">

	<div class="cont ainer" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">
 

				<?php

if ( have_posts() ) {

	while ( have_posts() ) {
		the_post();
		//var_dump($listing_json_data);
		get_template_part( 'template-parts/content', get_post_type() );
	}
}

?>
					
					<section class="content">
            <section class="block">
                <!--Gallery Carousel-->
                <section>
                    <div class="owl-carousel full-width-carousel">
                        <div class="item background-image"><img src="<?php echo plugins_url('img/placeholders/image-24.jpg' , __DIR__ ); ?>" alt="" data-hash="1"></div>
                        <div class="item background-image"><img src="<?php echo plugins_url('img/placeholders/image-26.jpg' , __DIR__ ); ?>" alt="" data-hash="2"></div>
                        <div class="item background-image"><img src="<?php echo plugins_url('img/placeholders/image-22.jpg' , __DIR__ ); ?>" alt="" data-hash="4"></div>
                        <div class="item background-image"><img src="<?php echo plugins_url('img/placeholders/image-23.jpg' , __DIR__ ); ?>" alt="" data-hash="5"></div>
                        <div class="item background-image"><img src="<?php echo plugins_url('img/placeholders/image-20.jpg' , __DIR__ ); ?>" alt="" data-hash="6"></div>
                        <div class="item background-image"><img src="<?php echo plugins_url('img/placeholders/image-25.jpg' , __DIR__ ); ?>" alt="" data-hash="3"></div>
                    </div>
                </section>
                <!--end Gallery Carousel-->
                <div class="container">
                    <div class="row flex-column-reverse flex-md-row">
                        <!--============ Listing Detail =============================================================-->
                        <div class="col-md-8">
                            <!--Description-->
                            <section>
                                <h2>Description</h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit
                                    amet fermentum sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                                    per inceptos himenaeos. Vestibulum tincidunt, sapien sagittis sollicitudin dapibus,
                                    risus mi euismod elit, in dictum justo lacus sit amet dui. Sed faucibus vitae nisl
                                    at dignissim.
                                </p>
                            </section>
                            <!--end Description-->
                            <!--Details-->
                            <section>
                                <h2>Details</h2>
                                <dl class="columns-3"> 
									<dt>Manufacturer</dt>
									<dd>x</dd>

									<dt>Model</dt>
									<dd>x</dd>
									
									<dt>Boat Type</dt>
									<dd>x</dd>
									
                                    <dt>Condition</dt>
									<dd>x</dd>
									
                                    <dt>Location</dt>
									<dd>x</dd> 
									
                                    <dt>Sale Status</dt>
									<dd>x</dd>
									  
                                    <dt>LOA</dt>
									<dd>x</dd>
									
                                    <dt>Draft</dt>
									<dd>x</dd>
									  
                                    <dt>Beam</dt>
									<dd>x</dd> 
                                </dl>
                            </section>
                            <!--end Details--> 
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
													<input name="name" type="text" class="form-control" id="name" placeholder="Your Name">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="email" class="col-form-label">Email</label>
													<input name="email" type="email" class="form-control" id="email" placeholder="Your Email">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="phone" class="col-form-label">Phone</label>
													<input name="phone" type="tel" class="form-control" id="phone" placeholder="Your Phone">
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
										<a class="social-icon" rel="nofollow" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>">
											<img alt="Share on Facebook" src="<?php echo plugins_url('img/fb-social.png' , __DIR__ ); ?>" />
										</a>
										
										<a class="social-icon" rel="nofollow" target="_blank" href="http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php the_permalink(); ?>">
											<img alt="Share on Twitter" src="<?php echo plugins_url('img/tr-social.png' , __DIR__ ); ?>" />
										</a> 

										<a class="social-icon" rel="nofollow" target="_blank" href="mailto:?subject=<?php _e( 'Thought you might like this' ); ?>: <?php the_title(); ?>&body=<?php _e( 'Hi, Thought this might interest you' ); ?>: <?php the_permalink(); ?>">
											<img alt="Share via email" src="<?php echo plugins_url('img/email-social.png' , __DIR__ ); ?>" />
										</a> 

										<a class="social-icon" rel="nofollow" target="_blank" href="whatsapp://send?text=<?php _e( 'Check out this boat' ); ?>: <?php the_permalink(); ?>">	
											<img alt="Share via WhatsApp" src="<?php echo plugins_url('img/whatsapp-social.png' , __DIR__ ); ?>" />
										</a>

										<a class="social-icon" rel="nofollow" href="#" onclick="window.print();return false;">
											<img alt="Print this page" src="<?php echo plugins_url('img/print-social.png' , __DIR__ ); ?>" />
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




				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div>
 

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
