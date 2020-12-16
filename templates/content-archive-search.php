<?php

use dealersleague\marine\wordpress\Utils;

if ( empty( $hide_search_bar ) ) {
?>

<!--============ Hero Form ==========================================================================-->
<form class="hero-form form" method="get" id="advanced-searchform" role="search" action="<?php echo esc_url( $action_url ); ?>">
    <div class="container">
        <!--Main Form-->
        <div class="main-search-form">
            <div class="form-row">
	            <?php if ( ! $hide_manufacturer ) { ?>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="manufacturer" class="col-form-label"><?php _e( 'Manufacturer', 'dlmarine' ); ?></label>
                        <select name="manufacturer" id="manufacturer" data-placeholder="<?php _e( 'Select Manufacturer', 'dlmarine' ); ?>">
                            <option value=""><?php _e( 'Select Manufacturer', 'dlmarine' ); ?></option>
                            <?php foreach ( $manufacturer_list as $manufacturer_name => $model_list ) { ?>
                                <option value="<?php echo $manufacturer_name; ?>" <?php echo (isset($search_manufacturer) && $search_manufacturer == $manufacturer_name ? 'selected="selected"' : '') ?>><?php echo ucfirst( $manufacturer_name ); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!--end form-group-->
                </div>
                <?php } ?>
                <!--end col-md-3-->
	            <?php if ( ! $hide_category ) { ?>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="category" class="col-form-label"><?php _e( 'Category', 'dlmarine' ); ?></label>
                        <select name="category" id="category" data-placeholder="<?php _e( 'Select Category', 'dlmarine' ); ?>">
                            <option value=""><?php _e( 'Select Category', 'dlmarine' ); ?></option>
	                        <?php foreach ( $category_list as $category ) { ?>
                                <option value="<?php echo $category; ?>" <?php echo (isset($search_category) && $search_category == $category ? 'selected="selected"' : '') ?>><?php echo ucfirst( __( $category, 'dlmarine' ) ); ?></option>
	                        <?php } ?>
                        </select>
                    </div>
                    <!--end form-group-->
                </div>
	            <?php } ?>
                <!--end col-md-3-->
	            <?php if ( ! $hide_price ) { ?>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="price" class="col-form-label"><?php _e( 'Price', 'dlmarine' ); ?></label>
                        <select name="price" id="price" data-placeholder="<?php _e( 'Select Price', 'dlmarine' ); ?>">
                            <option value=""><?php _e( 'Select Price', 'dlmarine' ); ?></option>
                            <option <?php echo (isset($search_price) && $search_price == 'all' ? 'selected="selected"' : '') ?> value="all"><?php _e( 'All Prices', 'dlmarine' ); ?></option>
                            <option <?php echo (isset($search_price) && $search_price == '0-19999' ? 'selected="selected"' : '') ?> value="0-19999">0 - 19,999</option>
                            <option <?php echo (isset($search_price) && $search_price == '20000-49999' ? 'selected="selected"' : '') ?> value="20000-49999">20,000 - 49,999</option>
                            <option <?php echo (isset($search_price) && $search_price == '50000-99999' ? 'selected="selected"' : '') ?> value="50000-99999">50,000 - 99,999</option>
                            <option <?php echo (isset($search_price) && $search_price == '100000' ? 'selected="selected"' : '') ?> value="100000"><?php _e( '100,000 and above', 'dlmarine' ); ?></option>
                        </select>
                    </div>
                    <!--end form-group-->
                </div>
	            <?php } ?>
                <!--end col-md-3-->
                <!--
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="input-location" class="col-form-label">Where?</label>
                        <input name="location" type="text" class="form-control" id="input-location" placeholder="Enter Location">
                        <span class="geo-location input-group-addon" data-toggle="tooltip" data-placement="top" title="Find My Position"><i class="fa fa-map-marker"></i></span>
                    </div> 
                </div>
                end col-md-3-->
                <div class="col-md-3 col-sm-3">
                    <button type="submit" class="btn btn-primary width-100"><?php _e( 'Search', 'dlmarine' ); ?></button>
                </div>
                <!--end col-md-3-->
            </div>
            <!--end form-row-->
        </div>
        <!--end main-search-form-->
        <!--Alternative Form-->
        <div class="alternative-search-form">
            <a href="#collapseAlternativeSearchForm" class="icon openAlternativeSearchForm" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseAlternativeSearchForm"><i class="fa fa-plus"></i><?php _e( 'More Options', 'dlmarine' ); ?></a>
            <?php
            $show_collapse = isset($search_age)||isset($search_fuel)||isset($search_country)||isset($search_colour) ? 'show' : '' ;
            ?>
            <div class="collapse <?php echo $show_collapse; ?>" id="collapseAlternativeSearchForm">
                <div class="wrapper">
                    <div class="form-row">
	                    <?php if ( ! $hide_age ) { ?>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                              
                            <select name="age" id="age" data-placeholder="<?php _e( 'Age', 'dlmarine' ); ?>" >
                                <option value=""><?php _e('Age', 'dlmarine'); ?></option>
                                <option <?php echo (isset($search_age) && $search_age == 'new' ? 'selected="selected"' : '') ?> value="new"><?php _e( 'New', 'dlmarine'); ?></option>
                                <option <?php echo (isset($search_age) && $search_age == '2010-2020' ? 'selected="selected"' : '') ?> value="2010-2020">2020 - 2010</option>
                                <option <?php echo (isset($search_age) && $search_age == '2000-2009' ? 'selected="selected"' : '') ?> value="2000-2009">2009 - 2000</option>
                                <option <?php echo (isset($search_age) && $search_age == '1999' ? 'selected="selected"' : '') ?> value="1999"><?php _e('1999 and older', 'dlmarine'); ?></option>
                            </select> 

                        </div>
                        <?php } ?>
	                    <?php if ( ! $hide_fuel_type ) { ?>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                              
                            <select name="fuel" id="fuel" data-placeholder="<?php _e( 'Fuel', 'dlmarine' ); ?>" >
                                <option value=""><?php _e( 'Fuel Type', 'dlmarine' ); ?></option>
                                <option <?php echo (isset($search_fuel) && $search_fuel == 'gasoline' ? 'selected="selected"' : '') ?> value="gasoline"><?php _e( 'Gasoline', 'dlmarine' ); ?></option>
                                <option <?php echo (isset($search_fuel) && $search_fuel == 'diesel' ? 'selected="selected"' : '') ?> value="diesel"><?php _e('Diesel', 'dlmarine' ); ?></option>
                                <option <?php echo (isset($search_fuel) && $search_fuel == 'other' ? 'selected="selected"' : '') ?> value="other"><?php _e('Other', 'dlmarine' ); ?></option>
                            </select>

                        </div>
	                    <?php } ?>
	                    <?php if ( ! $hide_country ) { ?>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                              
                            <select name="country" id="country" data-placeholder="<?php _e( 'Country', 'dlmarine' ); ?>" >
                                <option value=""><?php _e('Country', 'dlmarine'); ?></option>
                                <option <?php echo (isset($search_country) && $search_country == 'all' ? 'selected="selected"' : '') ?> value="all"><?php _e( 'All Countries', 'dlmarine' ); ?></option>
	                            <?php foreach ( $country_list as $country_code ) { ?>
                                    <option value="<?php echo $country_code; ?>" <?php echo (isset($search_country) && $search_country == $country_code ? 'selected="selected"' : '') ?>><?php echo Utils::get_country_name( $country_code ); ?></option>
	                            <?php } ?>
                            </select>

                        </div>
                        <?php } ?>
	                    <?php if ( ! $hide_colour ) { ?>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                              
                            <select name="colour" id="colour" data-placeholder="<?php _e( 'Colour', 'dlmarine' ); ?>" >
                                <option value=""><?php _e('Colour', 'dlmarine'); ?></option>
                                <option <?php echo (isset($search_colour) && $search_colour == 'all' ? 'selected="selected"' : '') ?> value="all"><?php _e('All Colours', 'dlmarine'); ?></option>
	                            <?php foreach ( $colour_list as $colour ) { ?>
                                    <option value="<?php echo $colour; ?>" <?php echo (isset($search_colour) && $search_colour == $colour ? 'selected="selected"' : '') ?>><?php echo ucfirst( __( $colour, 'dlmarine' ) ); ?></option>
	                            <?php } ?>
                            </select>

                        </div>
                        <?php } ?>
                    </div>
                    <!--end row-->
                </div>
                <!--end wrapper-->
            </div>
            <!--end collapse-->
        </div>
        <!--end alternative-search-form-->
    </div>
    <!--end container-->
</form>
<!--============ End Hero Form ======================================================================-->
<?php } ?>