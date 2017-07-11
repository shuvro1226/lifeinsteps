<?php
defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );

// Hook importer into admin init
add_action( 'admin_init', 'ASW_importer' );
function ASW_importer() {
    global $wpdb;

    if ( current_user_can( 'manage_options' ) && isset( $_GET['import_data_content'] ) ) {
        if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); // we are loading importers

        if ( ! class_exists( 'WP_Importer' ) ) { // if main importer class doesn't exist
            $wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
            include $wp_importer;
        }

        if ( ! class_exists('WP_Import') ) { // if WP importer doesn't exist
            $wp_import = get_template_directory() . '/framework/importer/wordpress-importer.php';
            include $wp_import;
        }

        if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) {

            $importer = new WP_Import();
            /* Import Posts, Pages, Portfolio Content, FAQ, Images, Menus */
            if(isset( $_GET['demo'] )){
                switch ($_GET['demo']) {
                    case 'travel':
						if ( class_exists( 'WooCommerce' ) ) {
							$theme_xml = get_template_directory() . '/framework/importer/data/travel/demo_woo.xml.gz';
						} else {
							$theme_xml = get_template_directory() . '/framework/importer/data/travel/demo.xml.gz';
						}
                        $theme_options_txt = get_template_directory_uri() . '/framework/importer/data/travel/theme_options.txt';
                        break;
                    case 'fashion':
                        $theme_xml = get_template_directory() . '/framework/importer/data/fashion/demo.xml.gz';
                        $theme_options_txt = get_template_directory_uri() . '/framework/importer/data/fashion/theme_options.txt'; // theme options data file
                        break;
					case 'wedding':
                        $theme_xml = get_template_directory() . '/framework/importer/data/wedding/demo.xml.gz';
                        $theme_options_txt = get_template_directory_uri() . '/framework/importer/data/wedding/theme_options.txt';
                        break;
                    case 'building':
                        $theme_xml = get_template_directory() . '/framework/importer/data/building/demo.xml.gz';
                        $theme_options_txt = get_template_directory_uri() . '/framework/importer/data/building/theme_options.txt'; // theme options data file
                        break;
					case 'food':
                        $theme_xml = get_template_directory() . '/framework/importer/data/food/demo.xml.gz';
                        $theme_options_txt = get_template_directory_uri() . '/framework/importer/data/food/theme_options.txt';
                        break;
                    case 'photography':
                        $theme_xml = get_template_directory() . '/framework/importer/data/photography/demo.xml.gz';
                        $theme_options_txt = get_template_directory_uri() . '/framework/importer/data/photography/theme_options.txt'; // theme options data file
                        break;
					case 'magazine':
                        $theme_xml = get_template_directory() . '/framework/importer/data/magazine/demo.xml.gz';
                        $theme_options_txt = get_template_directory_uri() . '/framework/importer/data/magazine/theme_options.txt'; // theme options data file
                        break;
                    case 'voyager_2017':
                        $theme_xml = get_template_directory() . '/framework/importer/data/voyager_2017/demo.xml.gz';
                        $theme_options_txt = get_template_directory_uri() . '/framework/importer/data/voyager_2017/theme_options.txt'; // theme options data file
                        break;
                    default:
                        $theme_xml = get_template_directory() . '/framework/importer/data/travel/demo.xml.gz';
                        $theme_options_txt = get_template_directory_uri() . '/framework/importer/data/travel/theme_options.txt'; // theme options data file
                        break;
                }
            }
            $importer->fetch_attachments = true;
            ob_start();
            $importer->import($theme_xml);
            ob_end_clean();
            // Set imported menus to registered theme locations
            $locations = get_theme_mod( 'nav_menu_locations' ); // registered menu locations in theme
            $menus = wp_get_nav_menus(); // registered menus

            if($menus) {
                foreach($menus as $menu) { // assign menus to theme locations
                    if( $menu->name == 'Primary Menu' ) {
						$locations['primary'] = $menu->term_id;
					}
                }
            }

            set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations
            
			// Use a static front page
			$home_page = get_page_by_title( 'Home' );
			if ( ! empty( $home_page ) && is_object( $home_page ) ){
				update_option( 'page_on_front', $home_page->ID );
				update_option( 'show_on_front', 'page' );
			}
			
			// Set the blog page
			$blog_page = get_page_by_title( 'Blog Default' );
			if ( ! empty( $blog_page ) && is_object( $blog_page ) ){
				update_option( 'page_for_posts', $blog_page->ID );
			}
			
            // Import Theme Options
            $theme_options_txt = wp_remote_get( $theme_options_txt );
            $data = unserialize( base64_decode( $theme_options_txt['body'])  );
            of_save_options( $data ); // update theme options

            // finally redirect to success page
            wp_redirect( admin_url( 'themes.php?page=optionsframework&imported=success#of-option-general' ) );
            
        }
    }
}