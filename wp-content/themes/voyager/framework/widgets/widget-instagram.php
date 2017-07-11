<?php

/**
 * Widget Name: Instagram
 */

class cstheme_widget_instagram extends WP_Widget {

	function cstheme_widget_instagram()
	{
		/* Widget settings. */
		$widget_options = array('classname' => 'cstheme_widget_instagram', 'description' => 'Displays your latest photos from Instagram.');
		$control_options = array('id_base' => 'cstheme_widget_instagram-widget');
		
		/* Create the widget. */
		parent::__construct('cstheme_widget_instagram-widget', 'Evatheme Instagram', $widget_options, $control_options);
	}

	function widget($args, $instance)
	{
		extract($args);

		$user_name = $instance['user_name'];
		if( $user_name == '' ) {
			$user_name = 'google';
		}
		$photo_count = isset($instance['photo_count']) ? $instance['photo_count'] : 6;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'] );

		echo $before_widget;
		
		if($title) {
			echo $before_title . $title . $after_title;
		}
		
		if ($user_name != '') {
		
			// Get Photos Array 
			$media_array = $this->scrape_instagram($user_name, $photo_count); 
			
			if ( is_wp_error( $media_array ) ) {

				echo $media_array->get_error_message();

			} else {
				
				// filter for images only?
				$media_array = array_filter( $media_array, array( $this, 'cstheme_images_only' ) ); ?>
			
				<ul class="cstheme_widget_instagram_list clearfix">
					<?php foreach($media_array as $item) {
						echo '<li class="instagram-item"><a href="'. esc_url( $item['link'] ) .'" target="_blank"><img src="'. esc_url($item['thumbnail']) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"/></a></li>';
						}
					?>
				</ul>			
		<?php }
		}
		
		echo $after_widget;
	}
	
	// code modified from https://gist.github.com/cosmocatalano/4544576
	function scrape_instagram($user_name, $photos_count) {
	
		$user_name = strtolower( $user_name );
	
		if(false === ($instagram = get_transient('cstheme-instagram-'.sanitize_title_with_dashes($user_name)))) {
			
			// Get media array for user name
			$remote = wp_remote_get('http://instagram.com/'.trim($user_name));
			
			if ( is_wp_error( $remote ) ) {
				return new WP_Error( 'site_down', esc_attr__( 'Unable to communicate with Instagram.', 'voyager' ) );
			}
			
			if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
				return new WP_Error( 'invalid_response', esc_attr__( 'Instagram did not return a 200.', 'voyager' ) );
			}
			
			$shards = explode('window._sharedData = ', $remote['body']);
			$insta_json = explode(';</script>', $shards[1]);
			$insta_array = json_decode($insta_json[0], TRUE);
			
			if ( ! $insta_array ) {
				return new WP_Error( 'bad_json', esc_attr__( 'Instagram has returned invalid data.', 'voyager' ) );
			}
			
			// old style
			if ( isset( $insta_array['entry_data']['UserProfile'][0]['userMedia'] ) ) {
				$images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];
				$type = 'old';
			// new style
			} else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
				$type = 'new';
			} else {
				return new WP_Error( 'bad_josn_2', esc_attr__( 'Instagram has returned invalid data.', 'voyager' ) );
			}
			
			if ( !is_array( $images ) ) {
				return new WP_Error( 'bad_array', esc_attr__( 'Instagram has returned invalid data.', 'voyager' ) );
			}

			$instagram = array();
			
			switch ( $type ) {
				case 'old':
					foreach ( $images as $image ) {

						if ( $image['user']['username'] == $user_name ) {

							$image['link']						  	= preg_replace( "/^http:/i", "", $image['link'] );
							$image['images']['thumbnail']		   	= preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
							$image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );
							$image['images']['low_resolution']	  	= preg_replace( "/^http:/i", "", $image['images']['low_resolution'] );

							$instagram[] = array(
								'description'   => $image['caption']['text'],
								'link'		  	=> $image['link'],
								'time'		  	=> $image['created_time'],
								'comments'	  	=> $image['comments']['count'],
								'likes'		 	=> $image['likes']['count'],
								'thumbnail'	 	=> $image['images']['thumbnail'],
								'large'		 	=> $image['images']['standard_resolution'],
								'medium'		=> $image['images']['low_resolution'],
								'type'		  	=> $image['type']
							);
						}
					}
				break;
				default:
					foreach ( $images as $image ) {

						$image['display_src'] = preg_replace( "/^http:/i", "", $image['display_src'] );

						if ( $image['is_video']  == true ) {
							$type = 'video';
						} else {
							$type = 'image';
						}
						
						$instagram[] = array(
							'description'   => esc_attr__( 'Instagram Image', 'voyager' ),
							'link'		  	=> '//instagram.com/p/' . $image['code'],
							'time'		  	=> $image['date'],
							'comments'	  	=> $image['comments']['count'],
							'likes'		 	=> $image['likes']['count'],
							'thumbnail'	 	=> $image['display_src'],
							'dimensions'	=> $image['dimensions'],
							'type'		  	=> $type
						);
					}
				break;
			}
			
			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				$instagram = base64_encode( serialize( $instagram ) );
				set_transient( 'cstheme-instagram-'.sanitize_title_with_dashes( $user_name ), $instagram, HOUR_IN_SECONDS * 2 );
			}
			
		}
		
		if ( ! empty( $instagram ) ) {

			$instagram = unserialize( base64_decode( $instagram ) );
			return array_slice( $instagram, 0, $photos_count );

		} else {

			return new WP_Error( 'no_images', esc_attr__( 'Instagram did not return any images.', 'voyager' ) );

		}
		
	}
	
	function cstheme_images_only( $media_item ) {

		if ( $media_item['type'] == 'image' )
			return true;

		return false;
	}


	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['user_name'] = $new_instance['user_name'];
		$instance['photo_count'] = $new_instance['photo_count'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => '', 'user_name' => '', 'photo_count' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
		
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_attr_e('Title:', 'voyager'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('user_name') ); ?>"><?php esc_attr_e('User name:', 'voyager'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('user_name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('user_name') ); ?>" value="<?php echo esc_attr( $instance['user_name'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('photo_count') ); ?>"><?php esc_attr_e('Number of Photos to show:', 'voyager'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('photo_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('photo_count') ); ?>" value="<?php echo esc_attr( $instance['photo_count'] ); ?>" />
		</p>
	<?php }
}

function cstheme_instagram_load()
{
	register_widget('cstheme_widget_instagram');
}

add_action('widgets_init', 'cstheme_instagram_load');
?>