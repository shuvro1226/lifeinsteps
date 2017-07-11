<?php

wp_enqueue_script('cstheme_owlcarousel_js', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), false, true);

$top_slider_style 				= get_metabox('top_slider_style');
$top_slider_category 			= get_metabox('top_slider_category');
$top_slider_count 				= get_metabox('top_slider_count');
$voyager_top_slider_orderby 	= get_metabox('top_slider_orderby');

$args = array(
	'posts_per_page' 		=> ((isset($top_slider_count) && $top_slider_count) ? $top_slider_count : '6'),
	'post_type' 			=> 'post',
	'cat' 					=> ((isset($top_slider_category) && $top_slider_category) ? $top_slider_category : 'all'),
	'orderby' 				=> ((isset($voyager_top_slider_orderby) && $voyager_top_slider_orderby) ? $voyager_top_slider_orderby : 'DESC'),
	'post_status' 			=> 'publish',
	'ignore_sticky_posts' 	=> 1
);
$wp_query_2 = new WP_Query();
$wp_query_2->query($args);
	
	if ($top_slider_style == 'type2') {
		
		echo '<div class="container">
				<div class="top_slider_blog_wrap">
					<div class="top_slider_preloader">
						<div class="top_slider_preloader_in"></div>
					</div>
			';
				echo '<div class="top_slider_blog owl-carousel clearfix ' . $top_slider_style . '">';
					while ($wp_query_2->have_posts()) {
						$wp_query_2->the_post();
						echo '
							<div class="item">
								<div class="top_slider_blog_item">';
								if (has_post_thumbnail()) {
									echo '<a class="top_slider_blog_thumb" href="' . get_permalink() . '"><img src="' . aq_resize(wp_get_attachment_url(get_post_thumbnail_id()), 1170, 630, true, true, true) . '" alt="" /></a>';
								}
								echo '
									<div class="top_slider_blog_descr">
										<div class="top_slider_blog_meta_category">' . get_the_category_list(', ') . '</div>
										<span class="post-meta-date">' . get_the_time('M j, Y') . '</span>
										<h2 class="top_slider_blog_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
										<div class="top_slider_blog_post_author">
											<span>' . esc_html__('posted by','voyager') . '</span>
											<a class="post-author-name heading_font" href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">' . get_the_author() . '</a>
										</div>
									</div>
								</div>
							</div>
						';
					}
					wp_reset_postdata();
				echo '</div>
				</div>';
		echo '</div>';
		
	} else if ($top_slider_style == 'type3') {
		
		echo '<div class="top_slider_blog_wrap">
			<div class="top_slider_preloader">
				<div class="top_slider_preloader_in"></div>
			</div>
			<div class="top_slider_blog owl-carousel clearfix ' . $top_slider_style . '">';
				while ($wp_query_2->have_posts()) {
					$wp_query_2->the_post();
					echo '
						<div class="item">
							<div class="top_slider_blog_item">';
							if (has_post_thumbnail()) {
								echo '<div class="top_slider_blog_thumb" style="background-image:url(' . wp_get_attachment_url(get_post_thumbnail_id()) . ')"></div>';
							}
							echo '
								<div class="top_slider_blog_descr container">
									<div class="top_slider_blog_post_author">
										<div class="post-author-image">
											<a href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">' . get_avatar( get_the_author_meta('user_email'), '70', '' ) . '</a>
										</div>   
										<div class="top_slider_blog_post_author_descr">
											<span>' . esc_html__('posted by','voyager') . '</span>
											<a class="post-author-name heading_font" href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">' . get_the_author() . '</a>
										</div>
									</div>
									<h2 class="top_slider_blog_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
									<span class="post-meta-date">' . get_the_time('M j, Y') . '</span>
									<div class="top_slider_blog_meta_category">' . get_the_category_list(', ') . '</div>
								</div>
							</div>
						</div>
					';
				}
				wp_reset_postdata();
			echo '</div>
		</div>';
		
	} else if ($top_slider_style == 'type4') {
		
		echo '<div class="container">
				<div class="top_slider_blog_wrap">
					<div class="top_slider_preloader">
						<div class="top_slider_preloader_in"></div>
					</div>
				<div class="top_slider_blog owl-carousel clearfix ' . $top_slider_style . '">';
					while ($wp_query_2->have_posts()) {
						$wp_query_2->the_post();
						echo '
							<div class="item">
								<div class="top_slider_blog_item text-center">';
								if (has_post_thumbnail()) {
									echo '<a class="top_slider_blog_thumb" href="' . get_permalink() . '"><img src="' . aq_resize(wp_get_attachment_url(get_post_thumbnail_id()), 1170, 630, true, true, true) . '" alt="" /></a>';
								}
								echo '
									<div class="top_slider_blog_descr">
										<div class="top_slider_blog_meta_category">' . get_the_category_list(', ') . '</div>
										<span class="post-meta-date">' . get_the_time('M j, Y') . '</span>
										<h2 class="top_slider_blog_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
										<div class="top_slider_blog_post_author">
											<span>' . esc_html__('posted by','voyager') . '</span>
											<a class="post-author-name heading_font" href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">' . get_the_author() . '</a>
										</div>
									</div>
								</div>
							</div>
						';
					}
					wp_reset_postdata();
				echo '</div>
			</div>
		</div>';
		
	} else if ($top_slider_style == 'type5') {
		
		echo '<div class="top_slider_blog_wrap">
				<div class="top_slider_preloader">
					<div class="top_slider_preloader_in"></div>
				</div>
			<div class="top_slider_blog owl-carousel clearfix ' . $top_slider_style . '">';
				while ($wp_query_2->have_posts()) {
					$wp_query_2->the_post();
					echo '
						<div class="item">
							<div class="top_slider_blog_item">';
							if (has_post_thumbnail()) {
								echo '<div class="top_slider_blog_thumb" style="background-image:url(' . wp_get_attachment_url(get_post_thumbnail_id()) . ')"><img src="' . aq_resize(wp_get_attachment_url(get_post_thumbnail_id()), 1920, 630, true, true, true) . '" alt="" /></div>';
							}
							echo '
								<div class="top_slider_blog_descr">
									<div class="container">
										<div class="top_slider_blog_meta_category">' . get_the_category_list(', ') . '</div>
										<h2 class="top_slider_blog_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
										<span class="post-meta-date">' . get_the_time('M j, Y') . '</span>
									</div>
								</div>
								<div class="top_slider_blog_post_author">
									<div class="container">
										<div class="post-author-image">
											<a href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">' . get_avatar( get_the_author_meta('user_email'), '70', '' ) . '</a>
										</div>   
										<div class="top_slider_blog_post_author_descr">
											<span>' . esc_html__('posted by','voyager') . '</span>
											<a class="post-author-name heading_font" href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">' . get_the_author() . '</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					';
				}
				wp_reset_postdata();
			echo '</div>
			</div>';
		
	} else if ($top_slider_style == 'type6') {
	
		echo '<div class="top_slider_blog_wrap">
				<div class="top_slider_preloader">
					<div class="top_slider_preloader_in"></div>
				</div>
			<div class="top_slider_blog owl-carousel clearfix ' . $top_slider_style . '">';
				while ($wp_query_2->have_posts()) {
					$wp_query_2->the_post();
					echo '
						<div class="item">
							<div class="top_slider_blog_item text-center">';
							if (has_post_thumbnail()) {
								echo '<div class="top_slider_blog_thumb" style="background-image: url(' . wp_get_attachment_url(get_post_thumbnail_id()) . ');"></div>';
							}
							echo '
								<div class="top_slider_blog_descr">
									<div class="top_slider_blog_meta_category">' . get_the_category_list(', ') . '</div>
									<h2 class="top_slider_blog_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
									<div class="top_slider_blog_post_meta">
										<span class="post-meta-date">' . get_the_time('M j, Y') . '</span>
										<a class="post-author-name" href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">' . get_the_author() . '</a>
									</div>
								</div>
							</div>
						</div>
					';
				}
				wp_reset_postdata();
			echo '</div>
		</div>';
		
	} else {
		
		echo '<div class="container">
				<div class="top_slider_blog_wrap">
					<div class="top_slider_preloader">
						<div class="top_slider_preloader_in"></div>
					</div>
				<div class="top_slider_blog owl-carousel clearfix ' . $top_slider_style . '">';
					
					while ($wp_query_2->have_posts()) {
						$wp_query_2->the_post();
						echo '
							<div class="item">
								<div class="top_slider_blog_item">';
								if (has_post_thumbnail()) {
									echo '<a class="top_slider_blog_thumb" href="' . get_permalink() . '"><img src="' . aq_resize(wp_get_attachment_url(get_post_thumbnail_id()), 1170, 630, true, true, true) . '" alt="" /></a>';
								}
								echo '
									<span class="top_slider_blog_meta_category">' . get_the_category_list(', ') . '</span>
									<div class="top_slider_blog_descr">
										<span class="post-meta-date">' . get_the_time('M j, Y') . '</span>
										<h2 class="top_slider_blog_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
									</div>
									<div class="top_slider_blog_post_author">
										<div class="post-author-image">
											<a href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">' . get_avatar( get_the_author_meta('user_email'), '70', '' ) . '</a>
										</div>   
										<span>' . esc_html__('posted by','voyager') . '</span>
										<a class="post-author-name heading_font" href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">' . get_the_author() . '</a>
									</div>
								</div>
							</div>
						';
					}
					wp_reset_postdata();
					
				echo '</div>
			</div>
		</div>';
	
	}
?>