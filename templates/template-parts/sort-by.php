<?php //if ( empty( $hide_order_by ) ) { ?>
	<section id="dealers-league-marine-selector" class="dealers-league-marine dealers-league-marine-selector">
		<div class="form-group row justify-content-start">
			<label for="sorting" class="col-2 col-form-label"><?php _e('Sort by:', 'dlmarine'); ?></label>
			<div class="selector col-3">
				<select name="sorting" id="sorting" data-placeholder="<?php _e( 'Default Sorting', 'dlmarine');?>">
					<option value="<?php echo esc_url( remove_query_arg( 'sort' ) )?>"><?php _e( 'Default Sorting', 'dlmarine');?></option>
					<option <?php echo $sort == 'date_desc' ? 'selected="selected"' : '' ; ?> value="<?php echo esc_url( add_query_arg( 'sort', 'date_desc' ) )?>"><?php _e( 'Newest First', 'dlmarine');?></option>
					<option <?php echo $sort == 'date_asc' ? 'selected="selected"' : '' ; ?> value="<?php echo esc_url( add_query_arg( 'sort', 'date_asc' ) )?>"><?php _e( 'Oldest First', 'dlmarine');?></option>
					<option <?php echo $sort == 'price_asc' ? 'selected="selected"' : '' ; ?> value="<?php echo esc_url( add_query_arg( 'sort', 'price_asc' ) )?>"><?php _e( 'Lowest Price First', 'dlmarine');?></option>
					<option <?php echo $sort == 'price_desc' ? 'selected="selected"' : '' ; ?> value="<?php echo esc_url( add_query_arg( 'sort', 'price_desc' ) )?>"><?php _e( 'Highest Price First', 'dlmarine');?></option>
				</select>
			</div>                                    
		</div> 
	</section>
<?php //} ?>

 
    <!--<div class="float-right d-xs-none thumbnail-toggle">
        <a href="#" class="change-class <?php //echo ($layout_type == 'grid' ? 'active' : ''); ?>" data-change-from-class="list" data-change-to-class="grid"
           data-parent-class="items">
            <i class="fa fa-th"></i>
        </a>
        <a href="#" class="change-class <?php //echo ($layout_type == 'list' ? 'active' : ''); ?>" data-change-from-class="grid" data-change-to-class="list"
           data-parent-class="items">
            <i class="fa fa-th-list"></i>
        </a>
    </div> -->