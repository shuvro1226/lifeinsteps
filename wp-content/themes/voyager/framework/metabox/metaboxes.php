<?php
require_once ( get_template_directory() . '/framework/metabox/page-options.php' );
require_once ( get_template_directory() . '/framework/metabox/post-format.php' );


add_action('admin_print_scripts', 'postsettings_admin_scripts');
add_action('admin_print_styles', 'postsettings_admin_styles');
if (!function_exists('postsettings_admin_scripts')) {
    function postsettings_admin_scripts(){
        global $post,$pagenow;

        if (current_user_can('edit_posts') && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {
            if( isset($post) ) {
                wp_localize_script( 'jquery', 'script_data', array(
                    'post_id' => $post->ID,
                    'nonce' => wp_create_nonce( 'cstheme-ajax' ),
                    'image_ids' => get_post_meta( $post->ID, 'gallery_image_ids', true ),
                    'label_create' => esc_html__("Create Featured Gallery", "voyager"),
                    'label_edit' => esc_html__("Edit Featured Gallery", "voyager"),
                    'label_save' => esc_html__("Save Featured Gallery", "voyager"),
                    'label_saving' => esc_html__("Saving...", "voyager")
                ));
            }

            wp_enqueue_script('post-colorpicker', get_template_directory_uri() . '/framework/assets/js/colorpicker.js');       
            wp_enqueue_script('post-metaboxes', get_template_directory_uri() . '/framework/assets/js/metaboxes.js');        

        }
    }
}

if (!function_exists('postsettings_admin_styles')) {
    function postsettings_admin_styles(){
        global $pagenow;
        if (current_user_can('edit_posts') && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {
            wp_enqueue_style('post-colorpicker', get_template_directory_uri() . '/framework/assets/css/colorpicker.css', false, '1.00', 'screen');
            wp_enqueue_style('post-metaboxes', get_template_directory_uri() . '/framework/assets/css/metaboxes.css', false, '1.00', 'screen');
        }
    }
}

if (!function_exists('settings_checkbox')) {
    function settings_checkbox($settings){
        $default = $settings['value'];
        $datashow = $datahide = $klass = "";
        if (!empty($settings['hide'])) {
            $klass = " check-show-hide";
            $datahide = $settings['hide'];
        }
        if (!empty($settings['show'])) {
            $klass = " check-show-hide";
            $datashow = $settings['show'];
        } ?>
        <tr id="field_<?php echo $settings['id']; ?>">
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>
            </th>
            <td>
                <input type="hidden" name="<?php echo $settings['id']; ?>" id="<?php echo $settings['id']; ?>" value="0"/>
                <input type="checkbox" class="yesno<?php echo $klass;?>" id="<?php echo $settings['id']; ?>" data-show="<?php echo $datashow;?>" data-hide="<?php echo $datahide;?>" name="<?php echo $settings['id']; ?>" value="1" <?php echo checked($default, 1, false);?> />           
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_textarea')) {
    function settings_textarea($settings){ ?>
        <tr id="<?php echo $settings['id']; ?>">
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>
            </th>
            <td>
                <textarea rows="5" name="<?php echo $settings['id']; ?>"><?php echo $settings['value']; ?></textarea>
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_text')) {
    function settings_text($settings){ ?>
        <tr id="<?php echo $settings['id']; ?>">
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>
            </th>
            <td>
                <input type="text" name="<?php echo $settings['id']; ?>" id="<?php echo $settings['id']; ?>" value="<?php echo $settings['value']; ?>" />
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_number')) {
    function settings_number($settings){ ?>
        <tr id="<?php echo $settings['id']; ?>">
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>
            </th>
            <td>
                <input type="number" name="<?php echo $settings['id']; ?>" id="<?php echo $settings['id']; ?>" value="<?php echo $settings['value']; ?>" style="width:60px;" />
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_file')) {
    function settings_file($settings){ ?>
        <tr id="<?php echo $settings['id']; ?>">
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>
            </th>
            <td>
                <input type="text" id="<?php echo $settings['id']; ?>" name="<?php echo $settings['id']; ?>" value="<?php echo $settings['value']; ?>" placeholder="Your Custom BG Image URL" size=""/>
                <a href="#" class="button insert-images theme_button format" onclick="browseimage('<?php echo $settings['id']; ?>')"><?php esc_html_e('Insert image', "voyager"); ?></a>
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_selectbox')) {
    function settings_selectbox($settings){
        $settings['options'] = array('true', 'default', 'false'); ?>
        <tr id="<?php echo $settings['id']; ?>">
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>
            </th>
            <td>
                <select class="selectbox" name="<?php echo $settings['id']; ?>" data-value="<?php print $settings['value'];?>"><?php
                    foreach ($settings['options'] as $meta) {
                        echo '<option value="' . $meta . '" ';
                        echo $meta == $settings['value'] ? 'selected ' : '';
                        echo '>' . $meta . '</option>';
                    } ?>
                </select>
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_layoutpage')) {
    function settings_layoutpage($settings){}
}
if (!function_exists('settings_layout')) {
    function settings_layout($settings){ ?>
        <tr id="<?php echo $settings['id']; ?>">
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>
            </th>
            <td>
                <div class="type_layout">
                    <a href="javascript:;" data-value="left" class="left-sidebar"></a>
                    <a href="javascript:;" data-value="right" class="right-sidebar"></a>
                    <a href="javascript:;" data-value="full" class="without-sidebar"></a>
                    <input name="<?php echo $settings['id'];?>" type="hidden" value="<?php echo $settings['value'];?>" />
                </div>
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_radio')) {
    function settings_radio($settings){ ?>
        <tr id="<?php echo $settings['id']; ?>">
            <td>
                <label for="<?php echo $settings['id']; ?>"><?php echo $settings['name']; ?></label>
                <div class="type_radio"><?php
                    foreach ($settings['options'] as $option) {
                        print '<input type="radio" style="margin-right:5px;" name="' . $settings['name'] . '" value="' . $option . '" ';
                        print $option == $settings['value'] ? 'checked ' : '';
                        print '><span style="margin-right:20px;">' . $option . '</span><br />';
                    } ?>
                </div>
            </td>
            <td>
                <span>
                    <?php echo $settings['desc']; ?>
                </span>
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_color')) {
    function settings_color($settings){ ?>
        <tr id="<?php echo $settings['id']; ?>">
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>            
            </th>
            <td>
                <div class="color_selector">
                    <div class="color_picker"><div style="background-color: <?php echo $settings['value']; ?>;" class="color_picker_inner"></div></div>
                    <input type="text" class="color_picker_value" id="<?php echo $settings['id']; ?>" name="<?php echo $settings['id']; ?>" value="<?php echo $settings['value']; ?>" />
                </div>
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_select')) {
    function settings_select($settings){ ?>
        <tr id="<?php echo $settings['id']; ?>">
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>
            </th>
            <td>
                <div class="type_select add_item_medium">
                    <select class="medium" name="<?php echo $settings['id']; ?>" data-value="<?php print $settings['value'];?>"><?php
                        foreach($settings['options'] as $key=>$value) { 
                                echo '<option value="'.$key.'">'.$value.'</option>';
                        } ?>
                    </select>
                </div>
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_gallery')) {
    function settings_gallery($settings){
        global $post;
        $meta = get_post_meta( $post->ID, 'gallery_image_ids', true );
        $gallery_thumbs = '';
        $button_text = ($meta) ? esc_html__('Edit Gallery', 'voyager') : esc_html__('Upload Images', 'voyager');
        if( $meta ) {
            $thumbs = explode(',', $meta);
            foreach( $thumbs as $thumb ) {
                $gallery_thumbs .= '<li>' . wp_get_attachment_image( $thumb, array(32,32) ) . '</li>';
            }
        } ?>
        <tr id="<?php //echo $settings['id']; ?>">
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>
            </th>
            <td>
                <input type="button" class="button" id="gallery_images_upload" value="<?php echo $button_text; ?>" />
                <input type="hidden" name="gallery_image_ids" id="gallery_image_ids" value="<?php echo $meta ? $meta : 'false'; ?>" />
                <ul class="gallery-thumbs"><?php echo $gallery_thumbs;?></ul>
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_slideshow')) {
    function settings_slideshow($settings){
        global $wpdb;
        $table_name = $wpdb->prefix . "layerslider";
        $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        WHERE flag_hidden = '0' AND flag_deleted = '0'
                                        ORDER BY date_c ASC LIMIT 100" ); ?>
        <tr id="<?php echo $settings['id']; ?>">            
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>
            </th>
            <td>
                <select class="medium" name="<?php echo $settings['id']; ?>" data-value="<?php print $settings['value'];?>"><?php
                    if(!empty($sliders)) {
                            foreach($sliders as $key => $item) {
                                    $name = empty($item->name) ? ('Unnamed('.$item->id.')') : $item->name;
                                    echo '<option value="[layerslider id=\''.$item->id.'\']">'.$name.'</option>';
                            }
                    } ?>
                </select>
            </td>
        </tr><?php
    }
}
if (!function_exists('settings_menu')) {
    function settings_menu($settings){ ?>
        <tr id="<?php echo $settings['id']; ?>">            
            <th>
                <label for="<?php echo $settings['id']; ?>">
                    <strong><?php echo $settings['name']; ?></strong>
                    <span><?php echo $settings['desc']; ?></span>
                </label>
            </th>
            <td>
                <?php $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
                        if ( !$menus ) {
                                echo '<p>'. sprintf( esc_html__('No menus have been created yet. <a href="%s">Create some</a>.','voyager'), admin_url('nav-menus.php') ) .'</p>';
                        } else {
                            echo '<select name="'.$settings['id'].'" data-value="'.$settings['value'].'">';
									echo '<option value="">'. esc_html__('Default', 'voyager') . '</option>';
                            foreach ( $menus as $menu ) {
                                    echo '<option value="' . $menu->term_id . '">'. $menu->name . '</option>';
                            }
                            echo '</select>';
                        } ?>
            </td>
        </tr><?php
    }
}


/*
 * Metabox Render
 */
 
function metabox_render($post, $metabox) {
    $options = get_post_meta($post->ID, 'cstheme_'.strtolower(THEMENAME).'_options', true);?>
        <input type="hidden" name="cstheme_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__));?>" />
        <table class="form-table cs-metaboxes">
            <tbody>
                    <?php	                              
                    foreach ($metabox['args'] as $settings) {
                        $settings['value'] = isset($options[$settings['id']]) ? $options[$settings['id']] : (isset($settings['std']) ? $settings['std'] : '');
                        call_user_func('settings_'.$settings['type'], $settings);	
                    }
                    ?>
            </tbody>
        </table>
<?php 
}

add_action('save_post', 'savePostMeta');
function savePostMeta($post_id) {
    global $cs_custom_layout_settings, $cs_page_settings, $cs_post_settings, $cs_page_portfolio_settings, $cs_portfolio_single, $cs_portfolio_single_gallery, $cs_portfolio_single_video, $cs_portfolio_single_audio, $cs_comingsoon_settings;

    $meta = 'cstheme_'.strtolower(THEMENAME).'_options';
    
    // verify nonce
    if (!isset($_POST['cstheme_meta_box_nonce']) || !wp_verify_nonce($_POST['cstheme_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
    }
    
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    // check permissions
    if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                    return $post_id;
            }
    } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
    }
    
    if($_POST['post_type']=='post') {
        $metaboxes = $cs_post_settings;
	} elseif($_POST['post_type']=='page') {
        $metaboxes = array_merge( $cs_custom_layout_settings, $cs_page_settings, $cs_page_portfolio_settings, $cs_comingsoon_settings );
	} elseif($_POST['post_type']=='portfolio') {
        $metaboxes = array_merge($cs_portfolio_single, $cs_portfolio_single_gallery, $cs_portfolio_single_video, $cs_portfolio_single_audio);
    }
    
    if(!empty($metaboxes)) {
        $myMeta = array();

        foreach ($metaboxes as $metabox) {
            $myMeta[$metabox['id']] = isset($_POST[$metabox['id']]) ? $_POST[$metabox['id']] : "";
        }

        update_post_meta($post_id, $meta, $myMeta);        

    }
}

/* ================================================================================== */
/*      Save gallery images
/* ================================================================================== */

function cstheme_save_images() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['ids']) || !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], 'cstheme-ajax' ) )
		return;
	
	if ( !current_user_can( 'edit_posts' ) ) return;
 
	$ids = strip_tags(rtrim($_POST['ids'], ','));
	update_post_meta($_POST['post_id'], 'gallery_image_ids', $ids);

	// update thumbs
	$thumbs = explode(',', $ids);
	$gallery_thumbs = '';
	foreach( $thumbs as $thumb ) {
		$gallery_thumbs .= '<li>' . wp_get_attachment_image( $thumb, array(32,32) ) . '</li>';
	}

	echo $gallery_thumbs;

	die();
}
add_action('wp_ajax_cstheme_save_images', 'cstheme_save_images');
?>