<?php
/**
 * Created by PhpStorm.
 * User: shuvr
 * Date: 10/24/2017
 * Time: 2:00 AM
 */

function enqueue_parent_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function redirect_login_page() {
	$login_page  = home_url( '/login/' );
	$page_viewed = basename($_SERVER['REQUEST_URI']);

	if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
		wp_redirect($login_page);
		exit;
	}
}
add_action('init','redirect_login_page');

function login_failed() {
	$login_page  = home_url( '/login/' );
	wp_redirect( $login_page . '?login=failed' );
	exit;
}
add_action( 'wp_login_failed', 'login_failed' );

function verify_username_password( $user, $username, $password ) {
	$login_page  = home_url( '/login/' );
	if( $username == "" || $password == "" ) {
		wp_redirect( $login_page . "?login=empty" );
		exit;
	}
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

function logout_page() {
	$login_page  = home_url( '/login/' );
	wp_redirect( $login_page . "?login=false" );
	exit;
}
add_action('wp_logout','logout_page');

function restrict_pages_to_logged_in_users() {

	if( (is_page( 'login' ) || is_page( 'register' )) && is_user_logged_in() ) {
		wp_redirect( home_url() );
		exit;
	}

}
add_action( 'template_redirect', 'restrict_pages_to_logged_in_users' );

function my_wp_nav_menu_args( $args = '' ) {

	if( is_user_logged_in() ) {
		$args['menu'] = 'logged-in';
	} else {
		$args['menu'] = 'logged-out';
	}
	return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

?>