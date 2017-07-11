<?php
/*
 *	Template Name: Page - Portfolio
 */

get_header();
the_post();

wp_enqueue_script('cstheme_isotope_js', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);

$featured_image_url 		= wp_get_attachment_url(get_post_thumbnail_id());
$portfolio_category 		= get_metabox('portfolio_category');
$portfolio_per_page 		= get_metabox('portfolio_per_page');
$portfolio_in_a_row 		= get_metabox('portfolio_in_a_row');
$portfolio_layout 			= get_metabox('portfolio_layout');
$portfolio_style 			= get_metabox('portfolio_style');
$portfolio_filter 			= get_metabox('portfolio_filter');
$portfolio_pagin_style 		= get_metabox('portfolio_pagin_style');


if ( !empty( $featured_image_url ) ) {
	echo '<div class="page_featured_image" style="background-image:url(' . $featured_image_url . ');"></div>';
}

$sidebar_layout = get_metabox( 'sidebar_layout' );
if( $sidebar_layout == 'left-sidebar' ) {
	$sidebar_class = 'pull-left ';
	$portfolio_wrap_class = 'left_sidebar ';
	$portfolio_class = 'col-md-9 pull-right';
} elseif( $sidebar_layout == 'right-sidebar' ) {
	$sidebar_class = 'pull-right';
	$portfolio_wrap_class = 'right_sidebar ';
	$portfolio_class = 'col-md-9 pull-left ';
} else {
	$sidebar_class = $portfolio_class = '';
	$portfolio_wrap_class = 'no_sidebar ';
}
?>


    <div id="portfolio_list" class="<?php echo $portfolio_wrap_class . ' ' . $portfolio_layout . ' ' . $portfolio_style . ' columns' . $portfolio_in_a_row; ?> clearfix">
		
		<?php
			
			the_content();
			
			echo '
				<div class="row">
			';
				
			if( ( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) && $portfolio_layout == 'container' ) {
				echo '
					<div class="' . $portfolio_class . '">
						<div class="row">
					';
			}
						
						$post_type_terms = array();
						if ( class_exists('evatheme_cpt') && $portfolio_filter == 'show' ) {
							cstheme_portfolio_filter($post_type_terms);
						}
						
						echo '
							<div class="isotope_container_wrap">
								<div class="isotope-container">
							';
						
						global $paged;

						if (get_query_var('paged'))
							$my_page = get_query_var('paged');
						else {
							if (get_query_var('page'))
								$my_page = get_query_var('page');
							else
								$my_page = 1;
							set_query_var('paged', $my_page);
						}
 
						$temp = $wp_query;  // re-sets query
						$wp_query = null;   // re-sets query
						$args = array(
							'post_type'				=> 'portfolio',
							'portfolio_category' 	=> $portfolio_category,
							'posts_per_page' 		=> ((isset($portfolio_per_page) && $portfolio_per_page) ? $portfolio_per_page : '6'),
							'paged' 				=> $paged,
							'post_status'			=> 'publish'
						);
						$wp_query = new WP_Query();
						$wp_query->query( $args );
						
							while ($wp_query->have_posts()) : $wp_query->the_post();
								get_template_part('templates/portfolio/loop');
							endwhile;
							
							echo '
								</div>
							</div>
						';
					
			if( ( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) && $portfolio_layout == 'container' ) {
					echo '
						</div>
					';
						
						if( $portfolio_pagin_style == 'infinite' ){
							cstheme_infinite_scroll();
						} else {
							cstheme_pagination($pages = '');
						}

				echo '
					</div>
				';
			}
				
			if( ( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) && $portfolio_layout == 'container' ) {
				echo '
					<div class="col-md-3 ' . $sidebar_class . '">
				';
						get_sidebar();
				echo '
					</div>
				';
			}
				
			echo '
				</div>
			';

			if( $sidebar_layout == 'no-sidebar' || $portfolio_layout == 'wide' ) {
				if( $portfolio_pagin_style == 'infinite' ){
					cstheme_infinite_scroll();
				} else {
					cstheme_pagination($pages = '');
				}
			}
			
			$wp_query = null;
			$wp_query = $temp; // Reset
			
			wp_reset_postdata();
		?>
    </div>
	
	<?php comments_template(); ?>
<?php
get_footer();