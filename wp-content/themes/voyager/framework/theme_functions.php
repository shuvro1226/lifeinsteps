<?php
/**
 * Custom functions and definitions
 */


//	if WooCommerce Plugin Active
function cstheme_woo_enabled() {
    if ( class_exists( 'woocommerce' ) )
        return true;
    return false;
}

//	if Evatheme CPT Plugin Active
function evatheme_cpt_enabled() {
    if ( class_exists( 'evatheme_cpt' ) )
        return true;
    return false;
}


//	Add specific CSS class by filter
add_filter( 'body_class', 'cstheme_body_class' );
function cstheme_body_class( $classes ) {
	
	global $post;
	
	//	If Site Boxed
	$theme_layout = cstheme_option('theme_layout');
	if ($theme_layout == 'boxed') {
		$classes[] = 'boxed';
	}
	
	//	If Top Slider Enabled
	$top_slider = get_metabox('top_slider');
	if ( is_page_template( 'page-custom-blog.php' ) && $top_slider != 'disabled' ) {
		$classes[] = 'top_slider_enabled';
	} else {
		$classes[] = 'top_slider_disable';
	}
	
	//	Header Layout
	$header_layout = cstheme_option('header_layout');
	$classes[] = 'header_' . $header_layout;
	
	//	if Page have Featured Image
	if( is_page() ){
		$featured_image_url = wp_get_attachment_url(get_post_thumbnail_id());
		if ( !empty( $featured_image_url ) ) {
			$classes[] = 'page_has_featured_img';
		}
	}
	if ( is_single() ) {
		$single_post_featured_img = cstheme_option( 'single_post_featured_img' );
		if ( $single_post_featured_img != '' ) {
			$classes[] = 'single_featured_img_fullwidth';
		}
	}
	
	return $classes;
}
 
//	Theme Options
function cstheme_option($index1, $index2 = false) {
    global $smof_data;
    if ($index2) {
        $output = isset($smof_data[$index1][$index2]) ? $smof_data[$index1][$index2] : false;
        return $output;
    }
    $output = isset($smof_data[$index1]) ? $smof_data[$index1] : false;
    
	$output = !empty( $output ) ? $output : '';
	
	return $output;
}


/**
 * Page, Post custom metaboxes
 */
function get_metabox($name) {
    global $post;
    if ($post) {
        $metabox = get_post_meta($post->ID, 'cstheme_' . strtolower(THEMENAME) . '_options', true);
        return isset($metabox[$name]) ? $metabox[$name] : "";
    }
    return false;
}

function set_metabox($name, $val) {
    global $post;
    if ($post) {
        $metabox = get_post_meta($post->ID, 'cstheme_' . strtolower(THEMENAME) . '_options', true);
        $metabox[$name] = $val;
        return update_post_meta($post->ID, 'cstheme_' . strtolower(THEMENAME) . '_options', $metabox);
    }
    return false;
}


/**
 * Theme Logo
 */
function cstheme_logo() {
    echo '<div class="cstheme-logo">';
    if (cstheme_option("theme_logo") == "") {
        echo '<h1 class="site-name">';
			echo '<a class="logo" href="'. esc_url( home_url( '/' ) ) .'">';
				bloginfo('name');
			echo '</a>';
        echo '</h1>';
    } else {
        echo '<a class="logo" href="' . esc_url( home_url( '/' ) ) . '">';
        if (cstheme_option("logo_retina")) {
            echo '<img class="logo-img" src="'. cstheme_option( 'theme_logo_retina' ) .'" style="width:'. cstheme_option('logo_width') .'px" alt="'. get_bloginfo( 'name' ) .'"/>';
        } else {
            echo '<img class="logo-img" src="'. cstheme_option( 'theme_logo' ) .'" alt="'. get_bloginfo( 'name' ) .'"/>';
        }
        echo '</a>';        
    }
    echo '</div>';
}


/**
 *	Theme Favicon
 */
function cstheme_favicon() {
	
	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		if (cstheme_option('theme_favicon') == "") {
			echo '<link rel="shortcut icon" href="'. get_template_directory_uri() . '/favicon.ico" />';
		} else {
			echo '<link rel="shortcut icon" href="' . esc_url( cstheme_option('theme_favicon') ) . '"/>';
		}
		
		echo cstheme_option('favicon_iphone') != "" ? ('<link rel="apple-touch-icon" href="' . esc_url( cstheme_option('favicon_iphone') ) . '"/>') : '';
        echo cstheme_option('favicon_iphone_retina') != "" ? ('<link rel="apple-touch-icon" sizes="114x114" href="' . esc_url( cstheme_option('favicon_iphone_retina') ) . '"/>') : '';
        echo cstheme_option('favicon_ipad') != "" ? ('<link rel="apple-touch-icon" sizes="72x72" href="' . esc_url( cstheme_option('favicon_ipad') ) . '"/>') : '';
	}
	
}



/**
 * Social Links
 */
global $cstheme_social_links;
$cstheme_social_links = array(
    'facebook' => array(
        'name' => 'facebook_username',
        'link' => '*',
    ),
    'flickr' => array(
        'name' => 'flickr_username',
        'link' => '*'
    ),
    'google-plus' => array(
        'name' => 'googleplus_username',
        'link' => '*'
    ),
    'twitter' => array(
        'name' => 'tweets_username',
        'link' => '*',
    ),
    'instagram' => array(
        'name' => 'instagram_username',
        'link' => '*',
    ),
    'pinterest' => array(
        'name' => 'pinterest_username',
        'link' => '*',
    ),
    'skype' => array(
        'name' => 'skype_username',
        'link' => '*'
    ),
    'youtube' => array(
        'name' => 'youtube_username',
        'link' => '*',
    ),
    'dribbble' => array(
        'name' => 'dribbble_username',
        'link' => '*',
    ),
    'linkedin' => array(
        'name' => 'linkedin_username',
        'link' => '*'
    ),
    'rss' => array(
        'name' => 'rss_username',
        'link' => '*'
    ),
	'vk' => array(
        'name' => 'vk_username',
        'link' => '*'
    ),
	'tumblr' => array(
        'name' => 'tumblr_username',
        'link' => '*'
    ),
	'vimeo' => array(
        'name' => 'vimeo_username',
        'link' => '*'
    )
);

function cstheme_social_links() {
    global $cstheme_social_links;
    foreach ($cstheme_social_links as $key => $social) {
        if (cstheme_option($social['name']) != "") {
            echo '<a href="'. (str_replace('*', cstheme_option($social['name']), $social['link'])) .'" target="_blank" class="social_link '. $key .'"><i class="fa fa-'. $key .'"></i></a>';
        }
    }
}


/**
 * Post excerpt
 */
if (!function_exists('cstheme_smarty_modifier_truncate')) {
    function cstheme_smarty_modifier_truncate($string, $length = 80, $etc = '... ',
		$break_words = false)
    {
        if ($length == 0)
            return '';

        if (mb_strlen($string, 'utf8') > $length) {
            $length -= mb_strlen($etc, 'utf8');
            if (!$break_words) {
                $string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $length + 1, 'utf8'));
            }
            return mb_substr($string, 0, $length, 'utf8') . $etc;
        } else {
            return $string;
        }
    }
}


/**
 * Single Post Comments List
 */

if (!function_exists('cstheme_comment')) {
    function cstheme_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		$comment_author_url = get_comment_author_url(); ?>
	
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
				<div class="comment-avatar">
					<?php if( $comment_author_url != '' ){ ?>
						<a href="<?php echo esc_url( $comment_author_url ); ?>" target="_blank">
					<?php } ?>
							<?php echo get_avatar($comment, $size = '70'); ?>
					<?php if( $comment_author_url != '' ){ ?>
						</a>
					<?php } ?>
				</div>
				<div class="comment-meta clearfix">
					<span><?php echo esc_html__('posted by','voyager') ?></span>
					<h6 class="comment_author">
						<?php if( $comment_author_url != '' ){ ?>
							<a href="<?php echo esc_url( $comment_author_url ); ?>" target="_blank">
						<?php } ?>
								<?php comment_author(); ?>
						<?php if( $comment_author_url != '' ){ ?>
							</a>
						<?php } ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'voyager'),' ','' ) ?>
					</h6>
					<span class="comment-date"><?php comment_date('M j, Y'); ?></span>
					<?php comment_reply_link(array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => esc_attr__('Reply', 'voyager') ))) ?>
				</div>
				<div class="comment-content">
					<div class="comment-text clearfix">
						<?php comment_text() ?>
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'voyager') ?></em>
							<br>
						<?php endif; ?>
					</div>
				</div>
			</div>
	<?php
	}
}


//	Pagination
if (!function_exists('cstheme_pagination')) {
    function cstheme_pagination($type = "") {
		
		global $wp_query;
		
		$text_prev = esc_html__('Older Posts','voyager');
		$text_next = esc_html__('Newer Posts','voyager');
		if (cstheme_woo_enabled() && is_shop()) {
			$text_prev = esc_html__('Next','voyager');
			$text_next = esc_html__('Prev','voyager');
		}
		
		if ($type == "query2") {
			
			$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
			
			echo "<div class='eva-pagination container'>";
				echo "<div class='eva_pagination_wrap heading_font'>";

					$pagination = paginate_links( array(
						'base' 			=> @add_query_arg('page','%#%'),
						'format' 		=> '',
						'total' 		=> $wp_query->max_num_pages,
						'current' 		=> $current,
						'show_all' 		=> false,
						'type' 			=> '',
						'prev_text' 	=> '<i class="fa fa-chevron-left"></i>' . $text_next,
						'next_text' 	=> $text_prev . '<i class="fa fa-chevron-right"></i>'
					) );

					echo $pagination;

				echo "</div>";
			echo "</div>";
			
		} else {
			
			$pages = $wp_query->max_num_pages;
			if (empty($pages)) {
				$pages = 1;
			}
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}
			
			if (1 != $pages) {
				$big = 9999; // need an unlikely integer
				echo "<div class='eva-pagination container heading_font'>";
					echo "<div class='eva_pagination_wrap heading_font'>";
						$pagination = paginate_links(
							array(
								'base' 			=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
								'format' 		=> '',
								'current' 		=> max(1, $paged),
								'total' 		=> $pages,
								'type' 			=> '',
								'prev_text' 	=> '<i class="fa fa-chevron-left"></i>' . $text_next,
								'next_text' 	=> $text_prev . '<i class="fa fa-chevron-right"></i>'
							)
						);
						echo $pagination;
					echo "</div>";
				echo "</div>";
			}	
		}
    }
}


/**
 *	Load More button
 */

if (!function_exists('cstheme_infinite_scroll')) {
	function cstheme_infinite_scroll($type = "") {
		if ($type == "query2") {
            global $paged, $wp_query;
        } else {
            global $paged, $wp_query;
        }
        $range = 3;

        if (empty($paged)) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }
		$pages = intval($wp_query->max_num_pages);
		if (empty($pages)) {
			$pages = 1;
		}
		if (1 != $pages) {
			echo '<div class="eva-infinite-scroll" data-has-next="' . ( $paged === $pages ? 'false' : 'true' ) . '">';
				echo '<a class="btn btn-infinite-scroll no-more hide" href="#">' . esc_html__('No more posts', 'voyager') . '</a>';
				echo '<a class="btn btn-infinite-scroll loading" href="#">' . esc_html__('Loading', 'voyager') . '</a>';
				echo '<a class="btn btn-infinite-scroll next" href="' . esc_url( get_pagenum_link($paged + 1) ) . '">' . esc_html__('Load More Posts', 'voyager') . '</a>';
			echo '</div>';
		}
	}
}


/**
 *	Display Instagram
 */

function cstheme_instagram_jquery() {
 	
	$instagram_type = cstheme_option( 'page_instagram_type' );
	if ( is_home() || is_category() || is_tag() || is_search() || is_day() || is_month() || is_year() ) {
		$instagram_type = cstheme_option( 'blog_instagram_type' );
	} else if ( is_single() ){
		$instagram_type = cstheme_option( 'single_post_instagram_type' );
	} else if ( is_page() ){
		$instagram_type = get_metabox('instagram_type');
	}
	$instagram_enable = cstheme_option( 'instagram_enable' );
	$instagram_userId = cstheme_option( 'instagram_userId' );
	$instagram_accessToken = cstheme_option( 'instagram_accessToken' );
	
	if ( $instagram_type == 'type3' || is_404() ) {
		$limit = 8;
	} else {
		$limit = 6;
	}
	if (cstheme_woo_enabled() && ( is_shop() || is_product() || is_product_category() || is_product_tag() ) ) {
		$limit = 8;
	}
	
	if( !empty( $instagram_userId ) && ( $instagram_enable ) ) {
	?>
		
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/instafeed.min.js"></script>
		<script type="text/javascript">
			if (jQuery("#instafeed").size() > 0) {
				var feed = new Instafeed({
					userId: <?php if( !empty( $instagram_userId ) ) { echo esc_attr( $instagram_userId ); } ?>,
					accessToken: '<?php if( !empty( $instagram_accessToken ) ) { echo esc_attr( $instagram_accessToken ); } ?>',
					get: 'user',
					link: 'true',
					resolution: 'low_resolution',
					// low_resolution - 306x306
					// standard_resolution - 612x612
					// thumbnail (default) - 150x150
					limit: <?php echo $limit ?>,
					sortBy: 'random' // least-commented - most-commented - least-liked - most-liked - least-recent - most-recent - random
				});
				feed.run();
				jQuery(document).ready(function($) {
					"use strict";
					jQuery("#instafeed").hide();
				});
				jQuery(window).load(function () {
					"use strict";
					var loadedtimer = setTimeout(function () {
						jQuery('#instafeed a').wrap('<div class="instafeed_item"></div>');
						jQuery('#instafeed a').attr('target','_blank');
						jQuery('#instafeed a').append('<span class="overlay_border"></span>');
						clearTimeout(loadedtimer);
						jQuery("#instafeed").show();
						jQuery('.instagram_preloader').hide();
					}, 4000);
				});
			}
		</script>
	
	<?php
	}
}
 
add_action( 'wp_footer', 'cstheme_instagram_jquery' );


/**
 *	Post Likes
 */
function cstheme_likes()
{
    wp_enqueue_script('cstheme_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
    $all_likes = get_post_meta(get_the_ID(), 'cstheme_likes', true);
    if (!isset($all_likes) || absint($all_likes) < 1) {
        $all_likes = 0;
    }
    echo '
    <span class="cstheme_likes ' . (isset($_COOKIE['like' . get_the_ID()]) ? "already_liked" : "cstheme_add_like") . '" data-postid="' . get_the_ID() . '">
        <i class="fa ' . (isset($_COOKIE['like' . get_the_ID()]) ? "fa-heart" : "fa-heart-o") . '"></i>
        <span class="likes_count">' . $all_likes . '</span>
    </span>
    ';
}

add_action('wp_ajax_add_like_post', 'cstheme_add_like_post');
add_action('wp_ajax_nopriv_add_like_post', 'cstheme_add_like_post');
function cstheme_add_like_post()
{
    $post_id = absint($_POST['post_id']);
    $all_likes = get_post_meta($post_id, 'cstheme_likes', true);
    $all_likes = (isset($all_likes) ? $all_likes : 0) + 1;
    update_post_meta($post_id, 'cstheme_likes', $all_likes);
    echo $all_likes;
    die();
}


/**
 *	Author Social Icons
 */

function cstheme_social_author_profile( $contactmethods ) {

	$contactmethods['evatheme_author_google_profile'] = 'Google Profile URL';
	$contactmethods['evatheme_author_twitter_profile'] = 'Twitter Profile URL';
	$contactmethods['evatheme_author_facebook_profile'] = 'Facebook Profile URL';
	$contactmethods['evatheme_author_linkedin_profile'] = 'Linkedin Profile URL';
	$contactmethods['evatheme_author_instagram_profile'] = 'Instagram Profile URL';
	$contactmethods['evatheme_author_tumblr_profile'] = 'Tumblr Profile URL';
   
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'cstheme_social_author_profile', 10, 1);


/**
 *	Add thumbnails to post admin dashboard
 */
add_filter( 'manage_post_posts_columns', 'eva_posts_columns' );
add_action( 'manage_posts_custom_column', 'eva_posts_custom_columns', 10, 2 );

add_filter( 'manage_page_posts_columns', 'eva_posts_columns' );
add_action( 'manage_pages_custom_column', 'eva_posts_custom_columns', 10, 2 );

if ( ! function_exists( 'eva_posts_columns' ) ) {
	function eva_posts_columns( $defaults ){
		$defaults['eva_post_thumbs'] = esc_html__( 'Featured Image', 'voyager' );
		return $defaults;
	}
}

if ( ! function_exists( 'eva_posts_custom_columns' ) ) {
	function eva_posts_custom_columns( $column_name, $id ){
		if( $column_name != 'eva_post_thumbs' ) {
			return;
		}
		if ( has_post_thumbnail( $id ) ) {
			$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'thumbnail', false );
			if( ! empty( $img_src[0] ) ) { ?>
					<img src="<?php echo $img_src[0]; ?>" alt="<?php the_title(); ?>" style="max-width:100%;max-height:90px;" />
				<?php
			}
		} else {
			echo '&mdash;';
		}
	}
}

//	Posts per author posts page
add_filter( 'pre_option_posts_per_page', 'evatheme_author_posts_per_page' );
function evatheme_author_posts_per_page( $posts_per_page ) {
	global $wp_query;
	if ( is_author() ) {
		return 9;
	}
	
	if ( is_search() ) {
		return 20;
	} 

	return $posts_per_page;
}


//	Add OpenGraph Meta
function cstheme_add_opengraph() {
    global $post; // Ensures we can use post variables outside the loop
    if(!$post) return;
    
    // Start with some values that don't change.
    echo "<meta property='og:site_name' content='". get_bloginfo('name') ."'/>"; // Sets the site name to the one in your WordPress settings
    echo "<meta property='og:url' content='" . get_permalink() . "'/>"; // Gets the permalink to the post/page

    if (is_singular()) { // If we are on a blog post/page
        echo "<meta property='og:title' content='" . get_the_title() . "'/>"; // Gets the page title
        echo "<meta property='og:type' content='article'/>"; // Sets the content type to be article.
    } elseif(is_front_page() or is_home()) { // If it is the front page or home page
        echo "<meta property='og:title' content='" . get_bloginfo("name") . "'/>"; // Get the site title
        echo "<meta property='og:type' content='website'/>"; // Sets the content type to be website.
    }

    if(has_post_thumbnail( $post->ID )) { // If the post has a featured image.
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        echo "<meta property='og:image' content='" . esc_attr( $thumbnail[0] ) . "'/>"; // If it has a featured image, then display this for Facebook
    } 

}
add_action( 'wp_head', 'cstheme_add_opengraph', 5 );


//	Custom Post Formats
function voyager_rename_post_formats( $safe_text ) {
    if ( $safe_text == 'Aside' )
        return 'Twitter';
	
	if ( $safe_text == 'Status' )
        return 'Instagram';

    return $safe_text;
}
add_filter( 'esc_html', 'voyager_rename_post_formats' );

//	rename Aside, Status in posts list table
function voyager_live_rename_formats() { 
    global $current_screen;

    if ( $current_screen->id == 'edit-post' ) { ?>
        <script type="text/javascript">
        jQuery('document').ready(function() {

            jQuery("span.post-state-format").each(function() { 
                if ( jQuery(this).text() == "Aside" )
                    jQuery(this).text("Twitter");
				
				if ( jQuery(this).text() == "Status" )
                    jQuery(this).text("Instagram");
            });

        });      
        </script>
<?php }
}
add_action('admin_head', 'voyager_live_rename_formats');