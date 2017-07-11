<?php
/**
 * The template for displaying pages
 */

get_header();

$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());

$sidebar_layout = get_metabox( 'sidebar_layout' );
if( $sidebar_layout == 'left-sidebar' ) {
	$sidebar_class = 'pull-left';
	$page_content_class = 'col-md-9 pull-right ';
} elseif( $sidebar_layout == 'right-sidebar' ) {
	$sidebar_class = 'pull-right ';
	$page_content_class = 'col-md-9 pull-left ';
} else {
	$sidebar_class = '';
	$page_content_class = 'col-md-12 ';
}
?>
		
		<div id="default_page">
			
			<?php
				if (!empty($featured_image_url)) {
					echo '<div class="page_featured_image" style="background-image:url(' . $featured_image_url . ');"></div>';
				}
			?>
			
			<div class="container">
				<div class="row">
					<div class="<?php echo $page_content_class ?>">
						<div class="page_title text-center">
							<h1><?php the_title(); ?></h1>
						</div>
						
						<div class="contentarea clearfix">
							
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
								<?php the_content(esc_html__('Read more!', 'voyager')); ?>
								
								<?php wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'voyager') . ': ', 'after' => '</div>')); ?>
								
								<?php 
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
								?>
						
							<?php endwhile; ?>
							
							<?php endif; ?>
							
						</div>
					</div>
					
					<?php 
						if( $sidebar_layout == 'left-sidebar' || $sidebar_layout == 'right-sidebar' ) {
							echo '<div class="col-md-3 ' . $sidebar_class . '">';
								get_sidebar();
							echo '</div>';
						}
					?>
					
				</div>
			</div>
		</div>

<?php get_footer(); ?>