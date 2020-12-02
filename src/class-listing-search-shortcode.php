<?php

namespace dealersleague\marine\wordpress;

class Listing_Search_Shortcode {

	public function init(): void {

		add_shortcode( 'listing_search', array( $this, 'shortcode_listing_search' ) );

	}

	/**
	 * Usage: [listing_search result_page="http://results.com"]
	 *
	 * @param mixed $attr
	 *
	 * @return string
	 */
	public function shortcode_listing_search( $attr ): string {

		$settings = new Settings_Page();
		$settings->refresh_options();

		ob_start();
		$action_url = empty( $attr[ 'result_page' ] ) ? '' : $attr[ 'result_page' ];
		// Get template file output
		include plugin_dir_path( __FILE__ ) . '../templates/content-archive-search.php';
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