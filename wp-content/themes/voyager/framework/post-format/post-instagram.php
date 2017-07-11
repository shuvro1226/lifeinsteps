<?php

/**
 * Post Format: Instagram
 */

global $post;

$username = get_post_meta($post->ID, 'voyager_pf_instagram_username', true);
$limit = '4';
$size = 'small';

if( $username !== '' ) {
	$media_array = voyager_scrape_instagram($username, $limit);
	if (is_wp_error($media_array)) {
		echo balanceTags($media_array->get_error_message());
	} else {
		
		// filter for images only?
		if ($images_only = apply_filters('voyager_images_only', FALSE)){
			$media_array = array_filter($media_array, array($post->ID, 'voyager_images_only'));
		}
		?>
		
		<ul class="clearfix instagram-pics"><?php
			foreach($media_array as $item){
				echo '<li><a href="' . esc_url($item['link']) . '" target="_blank" title="" ><img src="' . esc_url($item[$size]) . '"  alt="' . esc_attr($item['description']) . '" title="' . esc_attr($item['description']) . '"  /></a></li>';
			} ?>
		</ul><?php
	}
}

// based on https://gist.github.com/cosmocatalano/4544576
function voyager_scrape_instagram($username, $slice = 9) {

	$username = strtolower($username);
	$username = str_replace('@', '', $username);

	if (false === ( $instagram = get_transient('instagram-media-5-' . sanitize_title_with_dashes($username)) )) {

		$remote = wp_remote_get('http://instagram.com/' . trim($username));

		if (is_wp_error($remote))
			return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'voyager'));

		if (200 != wp_remote_retrieve_response_code($remote))
			return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'voyager'));

		$shards = explode('window._sharedData = ', $remote['body']);
		$insta_json = explode(';</script>', $shards[1]);
		$insta_array = json_decode($insta_json[0], TRUE);

		if (!$insta_array)
			return new WP_Error('bad_json', esc_html__('Instagram has returned invalid data.', 'voyager'));

		if (isset($insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'])) {
			$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
		} else {
			return new WP_Error('bad_json_2', esc_html__('Instagram has returned invalid data.', 'voyager'));
		}

		if (!is_array($images))
			return new WP_Error('bad_array', esc_html__('Instagram has returned invalid data.', 'voyager'));

		$instagram = array();

		foreach ($images as $image) {
			$image['thumbnail_src'] = preg_replace("/^https:/i", "", $image['thumbnail_src']);
			$image['thumbnail'] = str_replace('s640x640', 's160x160', $image['thumbnail_src']);
			$image['small'] = str_replace('s640x640', 's320x320', $image['thumbnail_src']);
			$image['large'] = $image['thumbnail_src'];
			$image['display_src'] = preg_replace("/^https:/i", "", $image['display_src']);

			if ($image['is_video'] == true) {
				$type = 'video';
			} else {
				$type = 'image';
			}

			$caption = esc_html__('Instagram Image', 'voyager');
			if (!empty($image['caption'])) {
				$caption = $image['caption'];
			}

			$instagram[] = array(
				'description' => $caption,
				'link' => '//instagram.com/p/' . $image['code'],
				'time' => $image['date'],
				'comments' => $image['comments']['count'],
				'likes' => $image['likes']['count'],
				'thumbnail' => $image['thumbnail'],
				'small' => $image['small'],
				'large' => $image['large'],
				'original' => $image['display_src'],
				'type' => $type
			);
		}

		// do not set an empty transient - should help catch private or empty accounts
		if (!empty($instagram)) {
			$instagram = serialize($instagram);
			set_transient('instagram-media-5-' . sanitize_title_with_dashes($username), $instagram, apply_filters('voyager_instagram_cache_time', HOUR_IN_SECONDS * 2));
		}
	}

	if (!empty($instagram)) {
		$instagram = unserialize($instagram);
		return array_slice($instagram, 0, $slice);
	} else {
		return new WP_Error('no_images', esc_html__('Instagram did not return any images.', 'voyager'));
	}
}
function voyager_images_only($media_item) {
	if ($media_item['type'] == 'image'){return true;}
	return false;
}