<?php

namespace dealersleague\marine\wordpress;

class Listing_Shortcode {

	public function init(): void {

		add_shortcode( 'listing_archive', array( $this, 'shortcode_listing_archive' ) );

	}

	/**
	 * Usage: [listing_archive category="my category" manufacturer="my manufacturer" location="my location"]
	 *
	 * @param mixed $attr
	 *
	 * @return string
	 */
	public function shortcode_listing_archive( $attr ): string {

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$settings = new Settings_Page();
		$settings->refresh_options();

		$conditions = [];

		if ( ! empty( $attr[ 'category' ] ) ) {
			$conditions[] = array(
				'key'     => 'listing_category',
				'value'   => $attr[ 'category' ],
				'compare' => '=',
			);
		}
		if ( ! empty( $attr[ 'manufacturer' ] ) ) {
			$conditions[] = array(
				'key'     => 'listing_manufacturer',
				'value'   => $attr[ 'manufacturer' ],
				'compare' => '=',
			);
		}
		if ( ! empty( $attr[ 'location' ] ) ) {
			$conditions[] = array(
				'key'     => 'listing_location',
				'value'   => $attr[ 'location' ],
				'compare' => '=',
			);
		}

		$default_sorting = $settings->get_web_settings_option_val( 'default_sorting' );
		$sort = ! empty( $_GET['sort'] ) ? $_GET['sort'] : strtolower( $default_sorting );

		$posts_per_page = $settings->get_web_settings_option_val( 'items_per_page' );
		$args = array(
			'post_type'      => Boat_Post_Type::get_post_type_name(),
			'post_status'    => 'publish',
			'posts_per_page' => empty( $posts_per_page ) ? 10 : $posts_per_page,
			'paged'          => $paged,
		);

		if ( ! empty( $conditions ) ) {
			if ( count( $conditions ) > 1 ) {
				$conditions[ 'relation' ] = 'AND';
			}
			$args['meta_query'] = $conditions;
		}

		if ( ! empty( $sort ) ) {
			$sort_params = explode( '_', $sort );
			if ( $sort_params[0] == 'price' ) {
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'listing_price';
			} else {
				$args['orderby'] = 'date';
			}
			$args['order'] = strtoupper( $sort_params[1] ); // ASC, DESC
			$args['suppress_filters'] = true;
		}

		ob_start();
		// Get template file output
		$layout_type = strtolower( $settings->get_web_settings_option_val( 'listing_layout' ) );
		$listings    = new \WP_Query( $args );
		include plugin_dir_path( __FILE__ ) . '../templates/content-archive-search.php';
		include plugin_dir_path( __FILE__ ) . '../templates/content-archive-listing.php';
		echo $this->render_pagination( $listings->max_num_pages );
		return ob_get_clean();

	}

	/**
	 * @param string $pages
	 * @param int $range
	 *
	 * @return string
	 */
	public function render_pagination( $pages = '' , $range = 4 ) {
		global $paged, $the_query;

		$show_items = ( $range * 2 ) + 1;

		$paged = empty( $paged ) ? 1 : $paged;

		if ( $pages == '' ) {
			$pages = $the_query->max_num_pages;
		}

		$pages = empty( $pages ) ? 1 : $pages;

		$html = '';

		if ( $pages != 1 ) {

			$html .= '<div class="page-pagination">';
			$html .= '<nav aria-label="Pagination">';
			$html .= '<ul class="pagination">';

			if ( $paged > 2 && $paged > $range + 1 && $show_items < $pages ) {
				$html .= '<li class="page-item">';
				$html .= '<a class="page-link" href="'. get_pagenum_link(1) .'">1</a>';
				$html .= '</li>';
			}

			if ( $paged > 1 && $show_items < $pages ) {
				$html .= '<li class="page-item">';
				$html .= '<a class="page-link" href="'.get_pagenum_link($paged - 1 ).'" aria-label="Previous">';
				$html .= '<span aria-hidden="true">';
                $html .= '<i class="fa fa-chevron-left"></i>';
                $html .= '</span>';
				$html .= '<span class="sr-only">'. __( 'Previous', 'dlmarine' ).'</span>';
				$html .= '</a>';
				$html .= '</li>';
			}

			for ( $i = 1; $i <= $pages; $i++ ) {

				if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $show_items ) ) {
					$active = $paged == $i ? 'active' : '';
					$html   .= '<li class="page-item ' . $active . '">';
					$html   .= '<a class="page-link" href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';
					$html   .= '</li>';
				}

			}

			if ( $paged < $pages && $show_items < $pages ) {
				$html .= '<li class="page-item">';
				$html .= '<a class="page-link" href="'. get_pagenum_link($paged + 1 ) . '" aria-label="Next">';
				$html .= '<span aria-hidden="true">';
				$html .= '<i class="fa fa-chevron-right"></i>';
				$html .= '</span>';
				$html .= '<span class="sr-only">'. __( 'Next', 'dlmarine' ) . '</span>';
				$html .= '</a>';
				$html .= '</li>';
			}

			$html .= '</ul>';
			$html .= '</nav>';
			$html .= '</div>';

		}

		return $html;

	}


}