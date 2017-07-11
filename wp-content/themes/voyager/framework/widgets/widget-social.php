<?php

/**
 * Widget Name: Social Links
 */

global $cs_widget_social_links;
$cs_widget_social_links = array(
    'facebook' => array(
        'name' => 'facebook_username',
        'link' => 'http://www.facebook.com/*',
    ),
    'flickr' => array(
        'name' => 'flickr_username',
        'link' => 'http://www.flickr.com/photos/*'
    ),
    'google-plus' => array(
        'name' => 'googleplus_username',
        'link' => 'https://plus.google.com/u/0/share?url=*'
    ),
    'twitter' => array(
        'name' => 'twitter_username',
        'link' => 'http://twitter.com/*',
    ),
    'instagram' => array(
        'name' => 'instagram_username',
        'link' => 'http://instagram.com/*',
    ),
    'pinterest' => array(
        'name' => 'pinterest_username',
        'link' => 'http://pinterest.com/*',
    ),
    'skype' => array(
        'name' => 'skype_username',
        'link' => 'skype:*'
    ),
    'youtube' => array(
        'name' => 'youtube_username',
        'link' => 'http://www.youtube.com/user/*',
    ),
    'dribbble' => array(
        'name' => 'dribbble_username',
        'link' => 'http://dribbble.com/*',
    ),
    'linkedin' => array(
        'name' => 'linkedin_username',
        'link' => '*'
    ),
    'rss' => array(
        'name' => 'rss_username',
        'link' => 'http://*/feed'
    ),
	'tumblr' => array(
        'name' => 'tumblr_username',
        'link' => '*'
    )
);

class cstheme_widget_sociallinks extends WP_Widget {

    function cstheme_widget_sociallinks() {
        $widget_ops = array(
			'classname' 	=> 'cstheme_widget_sociallinks',
			'description' 	=> 'Displays your social profile.'
		);

        parent::__construct(false, 'Evatheme Social Links', $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
            if ($title){echo $before_title . $title . $after_title;}
            global $cs_widget_social_links;
            echo '<div class="social_links_wrap text-center clearfix">';
            foreach ($cs_widget_social_links as $key => $social) {
                if(!empty($instance[$social['name']])){
                    echo '<a class="social_link ' . $key . '" href="' . str_replace('*',$instance[$social['name']],$social['link']) . '" target="_blank" title="' . $key . '"><i class="fa fa-' . $key . '"></i></a>';
                }
            }
            echo '</div>';
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance = $new_instance;
        /* Strip tags (if needed) and update the widget settings. */
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form($instance) {
        global $cs_widget_social_links; ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'voyager'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo isset($instance['title']) ? $instance['title'] : ''; ?>"  />
        </p> <?php
        foreach ($cs_widget_social_links as $key => $social) { ?>
            <p>
                <label for="<?php echo $this->get_field_id($social['name']); ?>"><?php echo $key; if($key==='linkedin'){echo ' URL';} ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id($social['name']); ?>" type="text" name="<?php echo $this->get_field_name($social['name']); ?>" value="<?php echo isset($instance[$social['name']]) ? $instance[$social['name']] : ''; ?>"  />
            </p><?php
        }
    }
}

add_action('widgets_init', create_function('', 'return register_widget("cstheme_widget_sociallinks");'));
?>
