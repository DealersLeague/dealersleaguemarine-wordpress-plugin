<!--============ Hero Form ==========================================================================-->
<form class="hero-form form">
    <div class="container">
        <!--Main Form-->
        <div class="main-search-form">
            <div class="form-row">
                <div class="col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="manufacturer" class="col-form-label">Manufacturer</label>
                        <select name="manufacturer" id="manufacturer" data-placeholder="Select Manufacturer">
                            <option value="">Select Manufacturer</option>
                            <option value="1">AMP</option>
                            <option value="2">Asis</option>
                            <option value="3">Bayliner</option> 
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
                            <option value="1">Motorboats</option>
                            <option value="2">Sailboats</option> 
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
                            <option value="2">£0 - £19,999</option> 
                            <option value="3">£20,000 - £49,999</option> 
                            <option value="4">£50,000 - £99,999</option> 
                            <option value="5">£100,000 and above</option>  
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
                                <option value="2">2020 - 2010</option>
                                <option value="3">2009 - 2000</option>
                                <option value="4">1999 and older</option> 
                            </select> 

                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                              
                            <select name="fuel" id="fuel" data-placeholder="fuel" >
                                <option value="">Fuel Type</option>
                                <option value="1">Gasoline</option>
                                <option value="2">Diesel</option>
                                <option value="3">Other</option> 
                            </select>

                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                              
                            <select name="country" id="country" data-placeholder="country" >
                                <option value="">Country </option>
                                <option value="1">All Countries</option>
                                <option value="2">United Kingdom</option>
                                <option value="3">Germany</option> 
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