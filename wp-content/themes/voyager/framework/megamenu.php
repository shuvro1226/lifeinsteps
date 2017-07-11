<?php

/* Mega Menu */
class cstheme_MegaMenu_menu {

    /*--------------------------------------------*
     * Constructor
     *--------------------------------------------*/

    /**
     * Initializes the plugin by setting localization, filters, and administration functions.
     */
    function __construct() {

        
        // add custom menu fields to menu
        add_filter( 'wp_setup_nav_menu_item', array( $this, 'cstheme_add_custom_nav_fields' ) );

        // save menu custom fields
        add_action( 'wp_update_nav_menu_item', array( $this, 'cstheme_update_custom_nav_fields'), 10, 3 );
        
        // edit menu walker
        add_filter( 'wp_edit_nav_menu_walker', array( $this, 'cstheme_edit_walker'), 10, 2 );
		
		// Addition style
		add_action( 'admin_enqueue_scripts', array( $this, 'cstheme_add_megamenu_css' ) );

    } // end constructor
    

    /**
     * Add custom fields to $item nav object
     * in order to be used in custom Walker
     *
     * @access      public
     * @since       1.0 
     * @return      void
    */
    function cstheme_add_custom_nav_fields( $menu_item ) {
    	
        $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
        return $menu_item;
    }
    
    /**
     * Save menu custom fields
     *
     * @access      public
     * @since       1.0 
     * @return      void
    */
    function cstheme_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

        if (!isset($_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id] = '';
        }
        $menu_mega_enabled_value = $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id];        
        update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $menu_mega_enabled_value );
    }
    
    /**
     * Define new Walker edit
     *
     * @access      public
     * @since       1.0 
     * @return      void
    */
    function cstheme_edit_walker($walker,$menu_id) {
    
        return 'cstheme_Walker_Nav_Menu_Edit_Custom'; 
    }
	
	public function cstheme_add_megamenu_css() {
		$css = "
			.menu-item.menu-item-depth-0 .cstheme_menu_options { display: block; }
			.menu-item.menu-item-depth-1 .cstheme_menu_options { display: none; }
			.menu-item.menu-item-depth-2 .cstheme_menu_options { display: none; }
			.menu-item.menu-item-depth-3 .cstheme_menu_options { display: none; }
		";
		wp_add_inline_style('wp-admin', $css);
	}
}

// instantiate plugin's class
$GLOBALS['cstheme_custom_menu'] = new cstheme_MegaMenu_menu();

/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class cstheme_Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker_Nav_Menu::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 * @param int    $id     Not used.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( esc_attr__( '%s (Invalid)', 'voyager' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_attr__('%s (Pending)', 'voyager'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php esc_attr_e( 'sub item', 'voyager' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up', 'voyager' ); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'voyager' ); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e( 'Edit Menu Item', 'voyager' ); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php esc_attr_e( 'Edit Menu Item', 'voyager' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php esc_attr_e( 'URL', 'voyager' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php esc_attr_e( 'Navigation Label', 'voyager' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php esc_attr_e( 'Title Attribute', 'voyager' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<div class="cstheme_menu_options">
					<p class="field-link-mega">
						<h3><?php esc_attr_e( 'Mega Menu', 'voyager' ); ?></h3>
						<?php 
							$value = get_post_meta( $item_id, '_menu_item_megamenu', true);
						?>
						<label for="edit-menu-item-megamenu-<?php echo $item_id; ?>">
							<input type="checkbox" value="1" id="edit-menu-item-megamenu-<?php echo $item_id; ?>" name="edit-menu-item-megamenu[<?php echo $item_id; ?>]"<?php checked($value, '1'); ?> />
							<?php esc_attr_e( 'Make this item Mega Menu?', 'voyager' ); ?>
						</label>
					</p>
				</div>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php esc_attr_e( 'Open link in a new window/tab', 'voyager' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php esc_attr_e( 'CSS Classes (optional)', 'voyager' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php esc_attr_e( 'Link Relationship (XFN)', 'voyager' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php esc_attr_e( 'Description', 'voyager' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php esc_attr_e( 'The description will be displayed in the menu if the current theme supports it.', 'voyager' ); ?></span>
					</label>
				</p>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php esc_attr_e( 'Move', 'voyager' ); ?></span>
						<a href="#" class="menus-move menus-move-up" data-dir="up"><?php esc_attr_e( 'Up one', 'voyager' ); ?></a>
						<a href="#" class="menus-move menus-move-down" data-dir="down"><?php esc_attr_e( 'Down one', 'voyager' ); ?></a>
						<a href="#" class="menus-move menus-move-left" data-dir="left"></a>
						<a href="#" class="menus-move menus-move-right" data-dir="right"></a>
						<a href="#" class="menus-move menus-move-top" data-dir="top"><?php esc_attr_e( 'To the top', 'voyager' ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( esc_attr__('Original: %s', 'voyager'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php esc_attr_e( 'Remove', 'voyager' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php esc_attr_e( 'Cancel', 'voyager' ); ?></a>
				</div>
				<div class="clear"></div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}

}
/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class cstheme_MegaMenu_Walker extends Walker_Nav_Menu {
	private $in_sub_menu = 0;
	var $active_megamenu = 0;
	var $mega_menu_content;
	
	/**
	* @see Walker::start_lvl()
	*
	* @param string $output Passed by reference. Used to append additional content.
	* @param int $depth Depth of page. Used for padding.
	*/
	function start_lvl(&$output, $depth = 0, $args = array()) {
	  $indent = str_repeat("\t", $depth);
	  if($depth === 0) $output .= "\n{replace_one}\n";
	  $output .= "\n$indent<ul class=\"sub-menu ".(($depth === 0) ? "{locate_class}": "")."\">\n";
	}
	
	/**
	* @see Walker::end_lvl()
	*
	* @param string $output Passed by reference. Used to append additional content.
	* @param int $depth Depth of page. Used for padding.
	*/
	function end_lvl(&$output, $depth = 0, $args = array()) {
	  $indent = str_repeat("\t", $depth);
	  $output .= "$indent</ul>\n";
	  if($depth === 0 && $this->active_megamenu) {
	  	$output.= '<div class="category-children">'.$this->mega_menu_content.'</div>';
	  	$this->mega_menu_content = '';
	  }
		if($depth === 0) {
			if($this->active_megamenu) {
				$output = str_replace("{replace_one}", '<div class="container cstheme_mega_menu_wrap">', $output);
				$output = str_replace("{locate_class}", "cstheme_mega_menu", $output);
			}
			else {
			  $output = str_replace("{locate_class}", "", $output);
			  $output = str_replace("{replace_one}", "", $output);
			}
		} 
	}
	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {      
	  $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	  
	  $classes = empty( $item->classes ) ? array() : (array) $item->classes;
	  $classes[] = 'menu-item-' . $item->ID;
	  
	  if( $depth == 1 ) {
	      if( ! $this->in_sub_menu ) {
	          $this->in_sub_menu = 1;
	          array_push($classes, 'active');
	      }
	  }
	  if( $depth == 0 ) {
	      $this->in_sub_menu = 0;
	      $this->active_megamenu = get_post_meta( $item->ID, '_menu_item_megamenu', true);
	  }
	  
	  if($depth === 0 && $this->active_megamenu) 
	  {
	  	 array_push($classes, 'menu-item-mega-parent');
	  }
	  
	  $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
	  $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	  
	  
	   
	  $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	
		$output .= $indent . '<li' . $id . $class_names .'>';
		
	    $atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
	    
	    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
	    
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
	  $item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$this->in_sub_menu = 1;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
	
	  $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		global $post;
		
		if( $depth == 1 && $this->in_sub_menu ) {
			if (in_array($item->object, array('post_tag','category'))) {
				if ($item->object == 'post_tag') {
					
					$args = array(
					    'tag_id' => $item->object_id,
					    'posts_per_page' => 4,
					    'no_found_rows' => true
					);
					
				} else {
					$args = array(
					    'cat' => $item->object_id,
					    'posts_per_page' => 4,
					    'no_found_rows' => true					
					);
				}
				$query = new WP_Query($args);
				
				ob_start();
					if ($query->have_posts()) {
						echo '<div class="category-children-wrap clearfix menu-item-' . $item->ID . '">';
						while ($query->have_posts()) : $query->the_post();
							
							$class = '';
							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
							
							echo '<div class="category-children-item">';
								if (!empty($featured_image)) {
									$class = 'with_featured_img';
									echo '<a class="category_post_img" href="'. get_permalink() .'"><img src="' . aq_resize($featured_image[0], "235", "120", true) . '" alt="'. get_the_title() .'" /></a>';
								}
								echo '
									<div class="category_post_content ' . $class . '">
										<span class="category_post_date">' . get_the_time('M j, Y') . '</span>
										<h6 class="category_post_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h6>
									</div>
								</div>
							';
						endwhile;
						echo '</div>';
					}
				$this->mega_menu_content .= ob_get_contents();
				ob_end_clean();
				wp_reset_query();
				wp_reset_postdata();
			}
		}
		if( $depth == 0 && $this->active_megamenu){
			$output .= '</div>';
		}
		$output .= "</li>\n";
	}
	
	/* Menu Fallback */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;
			
			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo wp_kses_post( $fb_output );
		}
	}
	
}