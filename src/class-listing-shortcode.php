<?php

namespace dealersleague\marine\wordpress;

class Listing_Shortcode {

	public function init(): void {

		add_shortcode( 'listing_archive', array( $this, 'shortcode_listing_archive' ) );

	}

	/**
	 * Usage: [listing_archive category="my category" manufacturer="my manufacturer" country="DE" condition="new|used" range="my range" hide_order_by="true|false"]
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

		$search_range = $attr[ 'range' ] ?? $_GET['range'] ?? '';
		if ( ! empty( $search_range ) ) {
			$conditions[] = array(
				'key'     => 'listing_range',
				'value'   => strtolower( $search_range ),
				'compare' => '=',
			);
		}

		$search_manufacturer = $attr[ 'manufacturer' ] ?? $_GET['manufacturer'] ?? '';
		if ( ! empty( $search_manufacturer ) ) {
			$conditions[] = array(
				'key'     => 'listing_manufacturer',
				'value'   => strtolower( $search_manufacturer ),
				'compare' => '=',
			);
		}

		$search_category = $attr[ 'category' ] ?? $_GET['category'] ?? '';
		if ( ! empty( $search_category ) ) {
			$conditions[] = array(
				'key'     => 'listing_category',
				'value'   => strtolower( $search_category ),
				'compare' => '=',
			);
		}

		$search_condition = $attr[ 'condition' ] ?? $_GET['condition'] ?? '';

		if ( strtolower( $search_condition == 'used' ) ) {
			$condition_array = array( 'used', 'used-excharter', 'demo-inwater', 'demo-exhibition' );
		} elseif ( strtolower( $search_condition == 'new' ) ) {
			$condition_array = array( 'new', 'new-inorder', 'new-onorder', 'new-instock' );
		}

		if ( ! empty( $search_condition ) ) {
			$conditions[] = array(
				'key'     => 'listing_sale_class',
				'value'   => $condition_array,
				'compare' => 'IN',
			);
		}

		$search_country = $attr[ 'country' ] ?? $_GET['country'] ?? '';
		if ( ! empty( $search_country ) && $search_country != 'all' ) {
			$conditions[] = array(
				'key'     => 'listing_location_country',
				'value'   => strtolower( $search_country ),
				'compare' => '=',
			);
		}

		$search_fuel = $_GET['fuel'] ?? '';
		if ( ! empty( $search_fuel ) ) {

			if ( $search_fuel == 'other' ) {
				$conditions[] = array(
					'key'     => 'listing_fuel',
					'value'   => array( 'diesel', 'gasoline' ),
					'compare' => 'NOT IN',
				);
			} else {
				$conditions[] = array(
					'key'     => 'listing_fuel',
					'value'   => strtolower( $search_fuel ),
					'compare' => '=',
				);
			}
		}

		$search_colour = $_GET['colour'] ?? '';
		if ( ! empty( $search_colour ) && $search_colour != 'all' ) {
			$conditions[] = array(
				'key'     => 'listing_fuel',
				'value'   => strtolower( $search_colour ),
				'compare' => '=',
			);
		}

		$search_age = $_GET['age'] ?? '';
		if ( ! empty( $search_age ) ) {

			if ( $search_age == 'new' ) {
				$conditions[] = array(
					'key'     => 'listing_sale_class',
					'value'   => array( 'new', 'new-instock', 'new-onorder', 'new-inorder' ),
					'compare' => 'IN',
				);
			} elseif ( $search_age == '1999' ) {
				$conditions[] = array(
					'key'     => 'listing_year_built',
					'value'   => $search_age,
					'type'    => 'numeric',
					'compare' => '<=',
				);
			} else {
				$age = explode( '-', str_replace( ' ', '', $search_age ) );
				if ( count( $age ) == 2 ) {
					$conditions[] = array(
						'key'     => 'listing_year_built',
						'value'   => $age,
						'type'    => 'numeric',
						'compare' => 'BETWEEN',
					);
				}
			}

		}

		$search_price = $_GET['price'] ?? '';
		if ( ! empty( $search_price ) ) {
			if ( $search_price == 100000 ) {
				$conditions[] = array(
					'key'     => 'listing_price',
					'value'   => $search_price,
					'type'    => 'numeric',
					'compare' => '>=',
				);
			} elseif ( $search_price != 'all' ) {
				$price = explode( '-', str_replace( ' ', '', $search_price ) );
				if ( count( $price ) == 2 ) {
					$conditions[] = array(
						'key'     => 'listing_price',
						'value'   => $price,
						'type'    => 'numeric',
						'compare' => 'BETWEEN',
					);
				}
			}
		}

		$hide_order_by = $attr[ 'hide_order_by' ] ?? $settings->get_web_settings_option_val( 'hide_orderby' ) ?? '';

		$default_sorting = $settings->get_web_settings_option_val( 'default_sorting' );
		$sort = ! empty( $_GET['sort'] ) ? $_GET['sort'] : strtolower( $default_sorting );

		$posts_per_page = $settings->get_web_settings_option_val( 'items_per_page' );
		$args = array(
			'post_type'      => Boat_Post_Type::get_post_type_name(),
			'post_status'    => 'publish',
			'posts_per_page' => empty( $posts_per_page ) ? 10 : $posts_per_page,
			'paged'          => $paged,
		);

		$conditions[] = array(
			'key'     => 'listing_external_id',
			'value'   => '',
			'compare' => '!='
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
				$args[ 'orderby' ]  = 'meta_value_num';
				$args[ 'meta_key' ] = 'listing_price';

			} else {
				//$args['orderby'] = 'publish_date';

				$args['orderby']  = 'meta_value';
				$args['meta_key'] = 'listing_publish_date';
			}
			$args['order'] = strtoupper( $sort_params[1] ); // ASC, DESC
			$args['suppress_filters'] = true;
		}

		ob_start();
		// Get template file output
		$layout_type = strtolower( $settings->get_web_settings_option_val( 'listing_layout' ) );
		$listings    = new \WP_Query( $args );
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

		if ( $pages == '' && ! empty( $the_query->max_num_pages ) ) {
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