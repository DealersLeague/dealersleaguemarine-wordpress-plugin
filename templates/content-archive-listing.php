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

<div class="items grid-xl-4-items grid-lg-4-items grid-md-4-items <?php echo $layout_type; ?>">

    <?php foreach ( $listings as $listing ) {

        if ( $layout_type == 'grid' ) {
            include 'item-listing-grid.php';
         } else {
	        include 'item-listing-list.php';
        }

    } ?>


</div>

