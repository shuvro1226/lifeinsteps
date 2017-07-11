<?php
	
	echo '<i class="fa fa-twitter"></i>';
	echo '<div class="post_format_twitter clearfix text-center owl-carousel">';
		
        $username 				= get_post_meta($post->ID, 'voyager_pf_twitter_username', true);
		$consumer_key 			= get_post_meta($post->ID, 'voyager_pf_twitter_consumer_key', true);
		$consumer_secret 		= get_post_meta($post->ID, 'voyager_pf_twitter_consumer_secret', true);
        $access_token 			= get_post_meta($post->ID, 'voyager_pf_twitter_access_token', true);
        $access_token_secret 	= get_post_meta($post->ID, 'voyager_pf_twitter_access_token_secret', true);
        $count 					= get_post_meta($post->ID, 'voyager_pf_twitter_count', true);

        $twitter_data = evatheme_get_tweets( $access_token, $access_token_secret, $consumer_key, $consumer_secret, $count);
		
		//convert links to clickable format
        if(!function_exists('convert_links')){
            function convert_links($status,$targetBlank=true,$linkMaxLen=250){
                // convert link to url
                $status = preg_replace('/(https?:\/\/\S+)/','<a href="\1">\1</a>',$status);
                // convert @ to follow
                $status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" target=\"_blank\" >$1</a>",$status);
                // convert # to search
                $status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" target=\"_blank\" >$1</a>",$status);
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
				echo '<span class="twitter-time">' . date('F j, Y', $time) . '</span>';
				echo '<span class="twitter-text">' . convert_links($text) . '</span></div>';

                ?>
               
            <?php $i++;
            }
        endif;
		
	echo '</div>';


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
    function evatheme_get_tweets( $oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret, $count){

        $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

        $oauth = array( 'oauth_consumer_key' => $consumer_key,
            'oauth_nonce' => time(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_token' => $oauth_access_token,
            'oauth_timestamp' => time(),
            'count' => $count,
            'oauth_version' => '1.0');

        $base_info = buildBaseString($url, 'GET', $oauth);
        $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
        $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature'] = $oauth_signature;


        $header = array(buildAuthorizationHeader($oauth), 'Expect:');
        $options = array( CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $url . '?count='.$count,
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