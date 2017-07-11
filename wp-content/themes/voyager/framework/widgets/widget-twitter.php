<?php

/**
 * Widget Name: Tweets
 */

class cstheme_widget_last_tweets extends WP_Widget
{
    function cstheme_widget_last_tweets() {
		$widget_ops = array( 
            'classname' => 'cstheme_widget_last_tweets', 
            'description' => esc_html__('Retrieve the last tweets.', 'voyager') 
        );

		$control_ops = array( 'id_base' => 'cstheme_widget_last_tweets' );

		parent::__construct( 'cstheme_widget_last_tweets', esc_html__('Evatheme Last Tweets', 'voyager'), $widget_ops, $control_ops );
	}
	
	function form( $instance ) {
		$defaults = array( 
            'title' => esc_html__('Recent tweets', 'voyager'),
            'username' => '',
            'consumer_key' => '',
            'consumer_secret' => '',
            'access_token' => '',
            'access_token_secret' => '',
			'type' => 'grid',
			'limit' => 3,
            'time' => 'true',
            'follow' => 'true'
        );
        
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		if (isset($instance['type'])) {
			$type = $instance['type'];
		} else {
			$type = 'grid';
		}
		
		?>
		
		<p>
			<label>
				<?php esc_html_e('Title', 'voyager'); ?>:<br />
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>

        <p>
            <label>
                <?php esc_html_e('Username', 'voyager'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php esc_html_e('Consumer key', 'voyager'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" value="<?php echo $instance['consumer_key']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php esc_html_e('Consumer secret', 'voyager'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" value="<?php echo $instance['consumer_secret']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php esc_html_e('Access token', 'voyager'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" value="<?php echo $instance['access_token']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <?php esc_html_e('Access token secret', 'voyager'); ?>:<br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'access_token_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_token_secret' ); ?>" value="<?php echo $instance['access_token_secret']; ?>" />
            </label>
        </p>
		
		<p>
			<label>
				<?php esc_html_e('View Type', 'voyager'); ?>:
				<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>"  value="<?php echo esc_attr($type); ?>" >
					<option value ='grid' <?php if (esc_attr($type) == 'grid') echo 'selected'; ?>>Grid</option>
					<option value = 'carousel' <?php if (esc_attr($type) == 'carousel') echo 'selected'; ?>>Carousel</option>
				</select>
			</label>
		</p>
		
		<p>
			<label>
				<?php esc_html_e('Limit', 'voyager'); ?>:
				<select id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>">
					
					<?php for( $i = 1; $i <= 10; $i++ ) : $selected = ( $instance['limit'] == $i ) ? ' selected="selected"' : '' ?>
					<option value="<?php echo $i ?>"<?php echo $selected ?>><?php echo $i ?></option>
					<?php endfor ?>
				
				</select>
			</label>
		</p>
		
		<p>
			<label>
				<?php $checked = ( $instance['time'] == 'true' ) ? ' checked=""' : '' ?>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'time' ); ?>" name="<?php echo $this->get_field_name( 'time' ); ?>" value="true"<?php echo $checked ?> />
				<?php esc_html_e('Show Time', 'voyager'); ?>
			</label>
		</p>
        
        <p>
			<label>
				<?php $checked = ( $instance['follow'] == 'true' ) ? ' checked=""' : '' ?>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'follow' ); ?>" name="<?php echo $this->get_field_name( 'follow' ); ?>" value="true"<?php echo $checked ?> />
				<?php esc_html_e('Show Follow link', 'voyager'); ?>
			</label>
		</p>
		<?php
	}
	
	function widget( $args, $instance )	{
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		$type = $instance['type'];
		
		$carousel_class = '';
		if( isset($type) && $type == 'carousel' ){
			$carousel_class = 'owl-carousel';
		}
		
		echo $before_widget;
		if ($title !== '') {
			echo $before_title . $title . $after_title;
		}
		
		echo '<div class="cstheme-list-tweets' . '-' . $this->number . ' ' . $type . ' clearfix">';

        $username = ( isset($instance['username']) && $instance['username'] != '' ) ? $instance['username'] : evatheme_get_option('twitter-username');
        $access_token = ( isset($instance['access_token']) && $instance['access_token'] != '' ) ? $instance['access_token'] : evatheme_get_option('twitter-access-token');
        $access_token_secret = ( isset($instance['access_token_secret']) && $instance['access_token_secret'] != '' ) ? $instance['access_token_secret'] : evatheme_get_option('twitter-access-token-secret');
        $consumer_key = ( isset($instance['consumer_key']) && $instance['consumer_key'] != '' ) ? $instance['consumer_key'] : evatheme_get_option('twitter-consumer-key');
        $consumer_secret = ( isset($instance['consumer_secret']) && $instance['consumer_secret'] != '' ) ? $instance['consumer_secret'] : evatheme_get_option('twitter-consumer-secret');

        $twitter_data = evatheme_get_tweets( $access_token, $access_token_secret, $consumer_key, $consumer_secret, $instance['limit']);
		
		//convert links to clickable format
        if(!function_exists('convert_links')){
            function convert_links($status,$targetBlank=true,$linkMaxLen=250){
                // the target
                $target=$targetBlank ? " target=\"_blank\" " : "";
                // convert link to url
                $status = preg_replace('/(https?:\/\/\S+)/','<a href="\1">\1</a>',$status);
                // convert @ to follow
                $status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);
                // convert # to search
                $status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);
                // return the status
                return $status;
            }
        }
		
        if ( !isset($twitter_data->errors) ) :
            $i = 1;
            foreach ($twitter_data as $tweet){
                if (!empty($tweet)) {
                    $text = $tweet->text;
                    $text_in_tooltip = str_replace('"', '', $text); // replace " to avoid conflicts with title="" opening tags
                    $id = $tweet->id;
                    $time = strtotime($tweet->created_at);
					$h_time = ( ( abs( time() - $time) ) < 86400 ) ? sprintf( esc_html__('%s ago','voyager'), human_time_diff( $time )) : date('F j, Y', $time);
                    //$username = $tweet->user->name;
                }
                echo '<div class="item tweet_' . $i . '">';
				if ( $instance['time'] ) echo '<span class="twitter-time">' . date('F j, Y H:i a', $time) . '</span>';
				echo '<span class="twitter-text">' . convert_links($text) . '</span></div>';

                ?>
               
            <?php $i++;
            }
        endif;
        echo '</div>';

        if( isset($instance['follow']) && $instance['follow'] == 'true' ){
            echo '<p id="follow-twitter"><a href="https://twitter.com/intent/user?screen_name=' . $username . '" target="_blank">' . apply_filters( 'evatheme_follow_us_twitter_widget', esc_html__( 'Follow us on Twitter &rarr;', 'voyager' ) ) . '</a>';
        }

		echo $after_widget;
	}                     

    function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

        $instance['username'] = strip_tags( $new_instance['username'] );

        $instance['consumer_key'] = $new_instance['consumer_key'];

        $instance['consumer_secret'] = $new_instance['consumer_secret'];

        $instance['access_token'] = $new_instance['access_token'];

        $instance['access_token_secret'] = $new_instance['access_token_secret'];
		
		$instance['type'] = strip_tags($new_instance['type']);
		
		$instance['time'] = $new_instance['time'];

		$instance['limit'] = strip_tags( $new_instance['limit'] );

        $instance['follow'] = $new_instance['follow'];

		return $instance;
	}
}
	
function tweets_register_widgets() { register_widget( 'cstheme_widget_last_tweets' ); } 
add_action( 'widgets_init', 'tweets_register_widgets' );



/*
 *  Twitter API
 */
if( !function_exists( 'buildBaseString' ) ) {
    function buildBaseString($baseURI, $method, $params){
        $r = array();
        ksort($params);
        foreach($params as $key=>$value){
            $r[] = "$key=" . rawurlencode($value);
        }

        return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r)); //return complete base string
    }
}

if( !function_exists( 'buildAuthorizationHeader' ) ) {
    function buildAuthorizationHeader($oauth){
        $r = 'Authorization: OAuth ';
        $values = array();
        foreach($oauth as $key=>$value)
            $values[] = "$key=\"" . rawurlencode($value) . "\"";

        $r .= implode(', ', $values);
        return $r;
    }
}

if( !function_exists( 'evatheme_get_tweets' ) ) {
    function evatheme_get_tweets( $oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret, $limit){

        $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

        $oauth = array( 'oauth_consumer_key' => $consumer_key,
            'oauth_nonce' => time(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_token' => $oauth_access_token,
            'oauth_timestamp' => time(),
            'count' => $limit,
            'oauth_version' => '1.0');

        $base_info = buildBaseString($url, 'GET', $oauth);
        $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
        $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature'] = $oauth_signature;


        $header = array(buildAuthorizationHeader($oauth), 'Expect:');
        $options = array( CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $url . '?count='.$limit,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false);

        $feed = curl_init();

        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);
        return json_decode($json);
    }
}

?>