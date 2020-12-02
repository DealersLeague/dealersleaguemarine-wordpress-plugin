<!--============ Hero Form ==========================================================================-->
<form class="hero-form form" method="get" id="advanced-searchform" role="search" action="<?php echo esc_url( $action_url ); ?>">
    <div class="container">
        <!--Main Form-->
        <div class="main-search-form">
            <div class="form-row">
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="manufacturer" class="col-form-label">Manufacturer</label>
                        <select name="manufacturer" id="manufacturer" data-placeholder="Select Manufacturer">
                            <option value="">Select Manufacturer</option>
                            <option value="Integrity">Integrity</option>
                            <option value="Yamaha">Yamaha</option>
                            <option value="Bayliner">Bayliner</option>
                        </select>
                    </div>
                    <!--end form-group-->
                </div>
                <!--end col-md-3-->
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="category" class="col-form-label">Category</label>
                        <select name="category" id="category" data-placeholder="Select Category">
                            <option value="">Select Category</option>
                            <option value="motorboat">Motorboats</option>
                            <option value="sailboat">Sailboats</option>
                        </select>
                    </div>
                    <!--end form-group-->
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="price" class="col-form-label">Price</label>
                        <select name="price" id="price" data-placeholder="Select price">
                            <option value="">Select Price</option>
                            <option value="1">All Prices</option>
                            <option value="0-19999">0 - 19,999</option>
                            <option value="20000-49999">20,000 - 49,999</option>
                            <option value="50000-99999">50,000 - 99,999</option>
                            <option value="100000"><?php __( '100,000 and above', 'dlmarine' ); ?></option>
                        </select>
                    </div>
                    <!--end form-group-->
                </div>
                <!--end col-md-3
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="input-location" class="col-form-label">Where?</label>
                        <input name="location" type="text" class="form-control" id="input-location" placeholder="Enter Location">
                        <span class="geo-location input-group-addon" data-toggle="tooltip" data-placement="top" title="Find My Position"><i class="fa fa-map-marker"></i></span>
                    </div> 
                </div>
                end col-md-3-->
                <div class="col-md-3 col-sm-3">
                    <button type="submit" class="btn btn-primary width-100">Search</button>
                </div>
                <!--end col-md-3-->
            </div>
            <!--end form-row-->
        </div>
        <!--end main-search-form-->
        <!--Alternative Form-->
        <div class="alternative-search-form">
            <a href="#collapseAlternativeSearchForm" class="icon openAlternativeSearchForm" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseAlternativeSearchForm"><i class="fa fa-plus"></i>More Options</a>
            <div class="collapse" id="collapseAlternativeSearchForm">
                <div class="wrapper">
                    <div class="form-row">
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                              
                            <select name="age" id="age" data-placeholder="age" >
                                <option value="">Age</option>
                                <option value="1">New</option>
                                <option value="2010-2020">2020 - 2010</option>
                                <option value="2000-2009">2009 - 2000</option>
                                <option value="1999"><?php __('1999 and older', 'dlmarine'); ?></option>
                            </select> 

                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                              
                            <select name="fuel" id="fuel" data-placeholder="fuel" >
                                <option value="">Fuel Type</option>
                                <option value="gasoline">Gasoline</option>
                                <option value="diesel">Diesel</option>
                                <option value="other">Other</option>
                            </select>

                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                              
                            <select name="country" id="country" data-placeholder="country" >
                                <option value="">Country </option>
                                <option value="1">All Countries</option>
                                <option value="UK">United Kingdom</option>
                                <option value="DE">Germany</option>
                            </select>

                        </div> 
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                              
                            <select name="colour" id="colour" data-placeholder="colour" >
                                <option value="">Colour</option>
                                <option value="1">All Colours</option>
                                <option value="2">United Kingdom</option>
                                <option value="3">Germany</option> 
                            </select>

                        </div>  
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