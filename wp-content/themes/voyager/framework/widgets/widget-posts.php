<?php

/**
 * Widget Name: Recent Post
 */

class cstheme_widget_posts extends WP_Widget {

	function cstheme_widget_posts() {
		parent::__construct( false, esc_html__('Evatheme Latest Posts','voyager') );
	}

	function widget( $args, $instance ) {
		extract($args);

        echo $before_widget;
		if ($instance['widget_title'] !== '') {
			echo $before_title . $instance['widget_title'] . $after_title;
		}
		
		$type = $instance['type'];
		$orderby = $instance['orderby'];
		$carousel_class_item = $carousel_class_carousel = '';
		if( isset($type) && $type == 'carousel' ){
			$carousel_class_item = 'item';
			$carousel_class_carousel = 'owl-carousel';
		}
		
		$postsArgs = array(
			'showposts'     	=> $instance['posts_widget_number'],
			'offset'          	=> 0,
			'orderby'         	=> $orderby,
			'order'           	=> 'DESC',
			'post_type'       	=> 'post',
			'post_status'     	=> 'publish',
			'ignore_sticky_posts' => 1
        );

        if( $instance['category'] ) $postsArgs['category_name'] = $instance['category'];
        $compilepopular = '';

		$wp_query_posts = new WP_Query();
		$wp_query_posts->query($postsArgs);
		while ($wp_query_posts->have_posts()) : $wp_query_posts->the_post();
		$featured_image_latest = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
		$class = '';
		
		if( isset($type) && $type == 'grid' ){
			$compilepopular .= '<li class="clearfix ' . $carousel_class_item . '">';
				if (!empty($featured_image_latest)) {
					$class = 'with_featured_img';
					$compilepopular .= '<a class="recent_posts_img" href="'. get_permalink() .'"><img src="'. aq_resize($featured_image_latest[0], "120", "120", true) .'" alt="'. get_the_title() .'" /></a>';
				}
				$compilepopular .= '<div class="recent_posts_content '. $class .'">';
					$compilepopular .= '<span class="recent-post-meta-date">'. get_the_time('M j, Y') .'</span>';
					$compilepopular .= '<h6 class="recent_post_title"><a href="'. get_permalink() .'">'. get_the_title() .'</a></h6>';
				$compilepopular .= '</div>';
			$compilepopular .= '</li>';
		} else {
			$compilepopular .= '<li class="clearfix ' . $carousel_class_item . '">';
				if (!empty($featured_image_latest)) {
					$class = 'with_featured_img';
					$compilepopular .= '<a class="recent_posts_img" href="'. get_permalink() .'"><img src="'. aq_resize($featured_image_latest[0], "270", "290", true) .'" alt="'. get_the_title() .'" /></a>';
				}
				$compilepopular .= '<div class="recent_posts_content">';
					$compilepopular .= '<div class="recent_post_meta_category">' . get_the_category_list(', ') . '</div>';
					$compilepopular .= '<h6 class="recent_post_title"><a href="'. get_permalink() .'">'. get_the_title() .'</a></h6>';
					$compilepopular .= '<span class="recent-post-meta-date">'. get_the_time('M j, Y') .'</span>';
				$compilepopular .= '</div>';
			$compilepopular .= '</li>';
		}

		endwhile; wp_reset_postdata();

		echo '<ul class="recent_posts_list ' . $type . ' ' . $carousel_class_carousel . ' clearfix">'. $compilepopular .'</ul>';

		echo $after_widget;
	}


	function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['widget_title'] = strip_tags( $new_instance['widget_title'] );
        $instance['posts_widget_number'] = strip_tags( $new_instance['posts_widget_number'] );
        $instance['type'] = strip_tags( $new_instance['type'] );
		$instance['category'] 	= strip_tags( $new_instance['category'] );
		$instance['orderby'] = strip_tags( $new_instance['orderby'] );

        return $instance;
	}

	function form( $instance ) {
        $defaultValues = array(
            'widget_title' 			=> 'Recent Posts',
            'posts_widget_number' 	=> '2',
			'type' 					=> 'grid',
			'orderby'				=> 'date'
        );
        $instance = wp_parse_args((array) $instance, $defaultValues);
		$category	= isset( $instance['category']) ? esc_attr( $instance['category'] ) : '';
		
	?>
		<table class="fullwidth">
            <tr>
				<td><?php esc_html_e('Title:', 'voyager'); ?></td>
				<td><input type='text' class="fullwidth" name='<?php echo $this->get_field_name( 'widget_title' ); ?>' value='<?php echo $instance['widget_title']; ?>'/></td>
			</tr>
			<tr>
				<td><?php esc_html_e('View Type:', 'voyager'); ?></td>
				<td>
					<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>"  value="<?php echo $instance['type']; ?>" >
						<option value ='grid' <?php if ($instance['type'] == 'grid') echo 'selected'; ?>>Grid</option>
						<option value = 'carousel' <?php if ($instance['type'] == 'carousel') echo 'selected'; ?>>Carousel</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><?php esc_html_e('Category:', 'voyager'); ?></td>
				<td>
					<select id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>">
						<?php 
							$categories = cstheme_get_categories( 'category' );
							foreach( $categories as $k=>$v ){
								$selected = ( $category == $k ) ? 'selected="selected"' : false;
								echo '<option value="'. $k .'" '. $selected .'>'. $v .'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><?php esc_html_e('Order by:', 'voyager'); ?></td>
				<td>
					<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>"  value="<?php echo $instance['orderby']; ?>" >
						<option value ='rand' <?php if ($instance['orderby'] == 'rand') echo 'selected'; ?>><?php esc_html_e('Random', 'voyager'); ?></option>
						<option value ='date' <?php if ($instance['orderby'] == 'date') echo 'selected'; ?>><?php esc_html_e('Date', 'voyager'); ?></option>
						<option value ='date' <?php if ($instance['orderby'] == 'title') echo 'selected'; ?>><?php esc_html_e('Title', 'voyager'); ?></option>
						<option value ='date' <?php if ($instance['orderby'] == 'comment_count') echo 'selected'; ?>><?php esc_html_e('Comment count', 'voyager'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td><?php esc_html_e('Number:', 'voyager'); ?></td>
				<td><input type='text' class="fullwidth" name='<?php echo $this->get_field_name( 'posts_widget_number' ); ?>' value='<?php echo $instance['posts_widget_number']; ?>'/></td>
			</tr>
		</table>
	<?php
	}
}

function posts_register_widgets() { register_widget( 'cstheme_widget_posts' ); }
add_action( 'widgets_init', 'posts_register_widgets' );

function cstheme_get_categories( $category ) {
	$categories = get_categories( array( 'taxonomy' => $category ));
	
	$array = array( '' => esc_html__( 'All', 'voyager' ) );	
	foreach( $categories as $cat ){
		if( is_object($cat) ) $array[$cat->slug] = $cat->name;
	}
		
	return $array;
}

?>