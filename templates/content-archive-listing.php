<?php
$layout_type = 'list'; // list|grid;
?>

<div class="section-title clearfix">
    <div class="float-left float-xs-none">
        <label class="mr-3 align-text-bottom">Sort by: </label>
        <select name="sorting" id="sorting" class="small width-200px selectized" data-placeholder="Default Sorting"
                tabindex="-1" style="display: none;">
            <option value="" selected="selected">Default Sorting</option>
            <option value="" selected="selected">Newest First</option>
            <option value="" selected="selected">Oldest First</option>
            <option value="" selected="selected">Lowest Price First</option>
            <option value="" selected="selected">Highest Price First</option>
        </select>
    </div>
    <div class="float-right d-xs-none thumbnail-toggle">
        <a href="#" class="change-class" data-change-from-class="list" data-change-to-class="grid"
           data-parent-class="items">
            <i class="fa fa-th"></i>
        </a>
        <a href="#" class="change-class active" data-change-from-class="grid" data-change-to-class="list"
           data-parent-class="items">
            <i class="fa fa-th-list"></i>
        </a>
    </div>
</div>

<?php
if ( $layout_type == 'list' ) {
?>

<div class="items grid-xl-4-items grid-lg-4-items grid-md-4-items list">
    <div class="item">
        <div class="ribbon-featured">
            <div class="ribbon-start"></div>
            <div class="ribbon-content">Featured</div>
            <div class="ribbon-end">
                <figure class="ribbon-shadow"></figure>
            </div>
        </div>
        <!--end ribbon-->
        <div class="wrapper">
            <div class="image">
                <h3>
                    <a href="#" class="tag category">Home &amp; Decor</a>
                    <a href="single-listing-1.html" class="title">Furniture for sale</a>
                    <span class="tag">Offer</span>
                </h3>
                <a href="single-listing-1.html" class="image-wrapper background-image"
                   style="background-image: url(&quot;file:///Users/walterbarcelos/Documents/DEALERS%20LEAGUE/WORDPRESS%20PLUGIN/elements-craigs-directory-listing-template-J2GNYE-nnAKn1Iy-02-13/html/assets/img/image-01.jpg&quot;);">
                    <img src="assets/img/image-01.jpg" alt="">
                </a>
            </div>
            <!--end image-->
            <h4 class="location">
                <a href="#">Manhattan, NY</a>
            </h4>
            <div class="price">$80</div>
            <div class="meta">
                <figure>
                    <i class="fa fa-calendar-o"></i>02.05.2017
                </figure>
                <figure>
                    <a href="#">
                        <i class="fa fa-user"></i>Jane Doe
                    </a>
                </figure>
            </div>
            <!--end meta-->
            <div class="description">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis lobortis</p>
            </div>
            <!--end description-->
            <a href="single-listing-1.html" class="detail text-caps underline">Detail</a>
        </div>
    </div>
    <!--end item-->

    <div class="item">
        <div class="ribbon-featured">
            <div class="ribbon-start"></div>
            <div class="ribbon-content">Featured</div>
            <div class="ribbon-end">
                <figure class="ribbon-shadow"></figure>
            </div>
        </div>
        <!--end ribbon-->
        <div class="wrapper">
            <div class="image">
                <h3>
                    <a href="#" class="tag category">Home &amp; Decor</a>
                    <a href="single-listing-1.html" class="title">Furniture for sale</a>
                    <span class="tag">Offer</span>
                </h3>
                <a href="single-listing-1.html" class="image-wrapper background-image"
                   style="background-image: url(&quot;file:///Users/walterbarcelos/Documents/DEALERS%20LEAGUE/WORDPRESS%20PLUGIN/elements-craigs-directory-listing-template-J2GNYE-nnAKn1Iy-02-13/html/assets/img/image-01.jpg&quot;);">
                    <img src="assets/img/image-01.jpg" alt="">
                </a>
            </div>
            <!--end image-->
            <h4 class="location">
                <a href="#">Manhattan, NY</a>
            </h4>
            <div class="price">$80</div>
            <div class="meta">
                <figure>
                    <i class="fa fa-calendar-o"></i>02.05.2017
                </figure>
                <figure>
                    <a href="#">
                        <i class="fa fa-user"></i>Jane Doe
                    </a>
                </figure>
            </div>
            <!--end meta-->
            <div class="description">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis lobortis</p>
            </div>
            <!--end description-->
            <a href="single-listing-1.html" class="detail text-caps underline">Detail</a>
        </div>
    </div>
    <!--end item-->

    <div class="item">
        <div class="ribbon-featured">
            <div class="ribbon-start"></div>
            <div class="ribbon-content">Featured</div>
            <div class="ribbon-end">
                <figure class="ribbon-shadow"></figure>
            </div>
        </div>
        <!--end ribbon-->
        <div class="wrapper">
            <div class="image">
                <h3>
                    <a href="#" class="tag category">Home &amp; Decor</a>
                    <a href="single-listing-1.html" class="title">Furniture for sale</a>
                    <span class="tag">Offer</span>
                </h3>
                <a href="single-listing-1.html" class="image-wrapper background-image"
                   style="background-image: url(&quot;file:///Users/walterbarcelos/Documents/DEALERS%20LEAGUE/WORDPRESS%20PLUGIN/elements-craigs-directory-listing-template-J2GNYE-nnAKn1Iy-02-13/html/assets/img/image-01.jpg&quot;);">
                    <img src="assets/img/image-01.jpg" alt="">
                </a>
            </div>
            <!--end image-->
            <h4 class="location">
                <a href="#">Manhattan, NY</a>
            </h4>
            <div class="price">$80</div>
            <div class="meta">
                <figure>
                    <i class="fa fa-calendar-o"></i>02.05.2017
                </figure>
                <figure>
                    <a href="#">
                        <i class="fa fa-user"></i>Jane Doe
                    </a>
                </figure>
            </div>
            <!--end meta-->
            <div class="description">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis lobortis</p>
            </div>
            <!--end description-->
            <a href="single-listing-1.html" class="detail text-caps underline">Detail</a>
        </div>
    </div>
    <!--end item-->

</div>

<?php } else { ?>

    <div class="items grid-xl-3-items grid-lg-3-items grid-md-3-items grid">
        <div class="item">
            <div class="ribbon-featured"><div class="ribbon-start"></div><div class="ribbon-content">Featured</div><div class="ribbon-end"><figure class="ribbon-shadow"></figure></div></div>
            <!--end ribbon-->
            <div class="wrapper">
                <div class="image">
                    <h3>
                        <a href="#" class="tag category">Home &amp; Decor</a>
                        <a href="single-listing-1.html" class="title">Furniture for sale</a>
                        <span class="tag">Offer</span>
                    </h3>
                    <a href="single-listing-1.html" class="image-wrapper background-image" style="background-image: url(&quot;file:///Users/walterbarcelos/Documents/DEALERS%20LEAGUE/WORDPRESS%20PLUGIN/elements-craigs-directory-listing-template-J2GNYE-nnAKn1Iy-02-13/html/assets/img/image-01.jpg&quot;);">
                        <img src="assets/img/image-01.jpg" alt="">
                    </a>
                </div>
                <!--end image-->
                <h4 class="location">
                    <a href="#">Manhattan, NY</a>
                </h4>
                <div class="price">$80</div>
                <div class="meta">
                    <figure>
                        <i class="fa fa-calendar-o"></i>02.05.2017
                    </figure>
                    <figure>
                        <a href="#">
                            <i class="fa fa-user"></i>Jane Doe
                        </a>
                    </figure>
                </div>
                <!--end meta-->
                <div class="description">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis lobortis</p>
                </div>
                <!--end description-->
                <a href="single-listing-1.html" class="detail text-caps underline">Detail</a>
            </div>
        </div>
        <!--end item-->

        <div class="item">
            <div class="ribbon-featured"><div class="ribbon-start"></div><div class="ribbon-content">Featured</div><div class="ribbon-end"><figure class="ribbon-shadow"></figure></div></div>
            <!--end ribbon-->
            <div class="wrapper">
                <div class="image">
                    <h3>
                        <a href="#" class="tag category">Home &amp; Decor</a>
                        <a href="single-listing-1.html" class="title">Furniture for sale</a>
                        <span class="tag">Offer</span>
                    </h3>
                    <a href="single-listing-1.html" class="image-wrapper background-image" style="background-image: url(&quot;file:///Users/walterbarcelos/Documents/DEALERS%20LEAGUE/WORDPRESS%20PLUGIN/elements-craigs-directory-listing-template-J2GNYE-nnAKn1Iy-02-13/html/assets/img/image-01.jpg&quot;);">
                        <img src="assets/img/image-01.jpg" alt="">
                    </a>
                </div>
                <!--end image-->
                <h4 class="location">
                    <a href="#">Manhattan, NY</a>
                </h4>
                <div class="price">$80</div>
                <div class="meta">
                    <figure>
                        <i class="fa fa-calendar-o"></i>02.05.2017
                    </figure>
                    <figure>
                        <a href="#">
                            <i class="fa fa-user"></i>Jane Doe
                        </a>
                    </figure>
                </div>
                <!--end meta-->
                <div class="description">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis lobortis</p>
                </div>
                <!--end description-->
                <a href="single-listing-1.html" class="detail text-caps underline">Detail</a>
            </div>
        </div>
        <!--end item-->

        <div class="item">
            <div class="ribbon-featured"><div class="ribbon-start"></div><div class="ribbon-content">Featured</div><div class="ribbon-end"><figure class="ribbon-shadow"></figure></div></div>
            <!--end ribbon-->
            <div class="wrapper">
                <div class="image">
                    <h3>
                        <a href="#" class="tag category">Home &amp; Decor</a>
                        <a href="single-listing-1.html" class="title">Furniture for sale</a>
                        <span class="tag">Offer</span>
                    </h3>
                    <a href="single-listing-1.html" class="image-wrapper background-image" style="background-image: url(&quot;file:///Users/walterbarcelos/Documents/DEALERS%20LEAGUE/WORDPRESS%20PLUGIN/elements-craigs-directory-listing-template-J2GNYE-nnAKn1Iy-02-13/html/assets/img/image-01.jpg&quot;);">
                        <img src="assets/img/image-01.jpg" alt="">
                    </a>
                </div>
                <!--end image-->
                <h4 class="location">
                    <a href="#">Manhattan, NY</a>
                </h4>
                <div class="price">$80</div>
                <div class="meta">
                    <figure>
                        <i class="fa fa-calendar-o"></i>02.05.2017
                    </figure>
                    <figure>
                        <a href="#">
                            <i class="fa fa-user"></i>Jane Doe
                        </a>
                    </figure>
                </div>
                <!--end meta-->
                <div class="description">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis lobortis</p>
                </div>
                <!--end description-->
                <a href="single-listing-1.html" class="detail text-caps underline">Detail</a>
            </div>
        </div>
        <!--end item-->

    </div>

<?php } ?>

