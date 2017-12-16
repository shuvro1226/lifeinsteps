<?php
/**
 * Created by PhpStorm.
 * User: shuvr
 * Date: 10/24/2017
 * Time: 2:00 AM
 */

session_start();

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

function new_user_registration() {

	if(isset($_POST['registration_submit'])) {
		$message = array();
		$_SESSION['first_name'] = $first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : "";
		$_SESSION['last_name'] = $last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : "";
		$_SESSION['username'] = $username = (isset($_POST['username'])) ? $_POST['username'] : "";
		$_SESSION['email'] = $email = (isset($_POST['email'])) ? $_POST['email'] : "";
		$password = (isset($_POST['user_pass'])) ? $_POST['user_pass'] : "";
		$message = checkPassword($password);
		$confirm_password = (isset($_POST['confirm_user_pass'])) ? $_POST['confirm_user_pass'] : "";
		if(empty($first_name) || empty($last_name) || empty($username) || empty($email) || empty($password)) {
			$message[] = "You must provide all necessary information!";
		}
		if(!empty($password) && $password != $confirm_password) {
			$message[] = "Password didn't match!";
		}
		if(!is_email($email)) {
			$message[] = "Please provide a valid email address!";
		}
		if(username_exists($username)) {
			$message[] = "The selected username is already used!";
		}
		if(email_exists($email)) {
			$message[] = "The provided Email is already registered!";
		}
		if(empty($message)) {
			$user_data = array(
				'user_login'    => $username,
				'user_email'    => $email,
				'user_pass'     => $password,
				'first_name'    => $first_name,
				'last_name'     => $last_name,
				'nickname'      => $username,
			);
			$user_id = wp_insert_user( $user_data );

			if( !is_wp_error($user_id) ) {
				$to = $email;
				$headers = "From: Life In Steps <noreply@lifeinsteps.com>\r\n";
				$headers .= "Reply-To: Life In Steps <noreply@lifeinsteps.com>\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$subject = 'Welcome to Life In Steps';
				$full_name = empty($last_name) ? $first_name : $first_name.' '.$last_name;
				$body = "<p>Dear $full_name,</p>".
				        "<p>Thank you for registering in Life In Steps.</p>".
				        "<p>Regards,</p>".
				        "<p>Life In Steps Team</p>";
				wp_mail( $to, $subject, $body, $headers );

				unset($_SESSION['first_name']);
				unset($_SESSION['last_name']);
				unset($_SESSION['username']);
				unset($_SESSION['email']);

				$creds                  = array();
				$creds['user_login']    = $email;
				$creds['user_password'] = $password;
				$creds['remember']      = '';
				wp_signon($creds);

				wp_safe_redirect(home_url());
				exit;
			} else {
				$message[] = "User registration failed. Please try again!";
			}
		}

		$_SESSION['message'] = $message;
		return true;

	}
}
add_action( 'init', 'new_user_registration' );

function user_login() {
	if(isset($_POST['login-submit'])) {
		$creds                  = array();
		$creds['user_login']    = stripslashes( trim( $_POST['user_login'] ) );
		$creds['user_password'] = stripslashes( trim( $_POST['user_pass'] ) );
		$creds['remember']      = isset( $_POST['rememberme'] ) ? sanitize_text_field( $_POST['rememberme'] ) : '';
		$redirect_to            = esc_url_raw( $_POST['redirect_to'] );
		$login_page             = home_url() . '/login';
		$secure_cookie          = null;

		if($redirect_to == '') {
			$redirect_to= get_site_url();
		}

		if ( ! force_ssl_admin() ) {
			$user = is_email( $creds['user_login'] ) ? get_user_by( 'email', $creds['user_login'] ) : get_user_by( 'login', sanitize_user( $creds['user_login'] ) );

			if ( $user && get_user_option( 'use_ssl', $user->ID ) ) {
				$secure_cookie = true;
				force_ssl_admin( true );
			}
		}

		if ( force_ssl_admin() ) {
			$secure_cookie = true;
		}

		if ( is_null( $secure_cookie ) && force_ssl_admin() ) {
			$secure_cookie = false;
		}

		$user = wp_signon( $creds, $secure_cookie );

		if ( $secure_cookie && strstr( $redirect_to, 'wp-admin' ) ) {
			$redirect_to = str_replace( 'http:', 'https:', $redirect_to );
		}

		if ( ! is_wp_error( $user ) ) {
			wp_safe_redirect( $redirect_to );
		} else {
			if ( $user->errors ) {
				wp_safe_redirect( $login_page.'/login=failed' );
			} else {
				wp_safe_redirect( $login_page.'/login=empty' );
			}
		}
		exit;
	}
}
add_action( 'init', 'user_login' );

// Disable admin bar for all users except administrators
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'remove_admin_bar');

function send_password_reset_request() {
	if(isset($_POST['reset-request-submit'])) {
		$email = $_POST['user_email'];
		$message = array();
		if(!is_email($email)) {
			$message[] = "Please provide a valid email address";
		} elseif(get_user_by('email', $email) == false) {
			$message[] = "No user found with the provided email address";
		}
		if(empty($message)) {
			$randomString = substr(str_shuffle(md5(time())),0,24);
			$user = get_user_by('email', $email);
			update_user_meta($user->ID, 'pwd_reset_key', $randomString);
			$redirect_url = home_url()."/reset-password/?user_id=$user->ID&key=$randomString";

			$to = $email;
			$headers = "From: Life In Steps <noreply@lifeinsteps.com>\r\n";
			$headers .= "Reply-To: Life In Steps <noreply@lifeinsteps.com>\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$subject = 'Password Reset Request in Life In Steps';
			$full_name = empty($user->last_name) ? $user->first_name : $user->first_name.' '.$user->last_name;
			$body = "Dear $full_name,<br/>".
			        "We have received a password reset request. If it is requested by you please click on the following link to reset your password.<br/>".
			        "<a href='$redirect_url'>$redirect_url</a><br/>".
			        "If you haven't requested for a password reset please ignore this email. <br/>".
			        "Regards,<br/>".
			        "Life In Steps Team";
			wp_mail( $to, $subject, $body, $headers );
			$message[] = "We have sent a link to your email. Please click on the link to reset your password.";
		}
		$_SESSION['message'] = $message;
		return true;
	}
}
add_action('init', 'send_password_reset_request');

function reset_user_password() {
	if(isset($_POST['pwd-reset-submit'])) {
		$message = array();
		$user_id = trim($_POST['user_id']);
		$old_password = trim($_POST['old_password']);
		$new_password = trim($_POST['new_password']);
		$confirm_password = trim($_POST['confirm_password']);

		if(!empty($old_password) && !empty($new_password)) {
			$message = checkPassword($new_password);
			if(empty($message)) {
				$user = get_user_by('id', $user_id);
				if($user && wp_check_password($old_password, $user->data->user_pass, $user_id)) {
					if($new_password == $confirm_password) {
						wp_set_password($new_password, $user_id);
						delete_user_meta($user_id, 'pwd_reset_key');
						$message[] = "Password has been successfully reset. You can login now using your new password.";
						$_SESSION['message'] = $message;
						wp_safe_redirect(home_url() . '/login');
						exit;
					} else {
						$message[] = "New password did not match with the confirmation field.";
					}
				} else {
					$message[] = "Either the user does not exist or the provided password did not match. Please try again.";
				}
			}
		} else {
			$message[] = "Please provide your old and new passwords";
		}
		$_SESSION['message'] = $message;
		return true;
	}
}
add_action('init', 'reset_user_password');

function checkPassword($pwd) {
	$errors = array();

	if (strlen($pwd) < 8) {
		$errors[] = "Password too short(minimum 8)!";
	}

	if (strlen($pwd) > 20) {
		$errors[] = "Password too long(maximum 20)!";
	}

	if (!preg_match("#[0-9]+#", $pwd)) {
		$errors[] = "Password must include at least one number!";
	}

	if (!preg_match("#[a-zA-Z]+#", $pwd)) {
		$errors[] = "Password must include at least one letter!";
	}

	return $errors;
}
?>