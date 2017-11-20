<?php
/**
 * Created by PhpStorm.
 * User: shuvr
 * Date: 10/24/2017
 * Time: 12:36 PM
 * Template Name: Login
 */

get_header();

?>

	<div id="default_page">

		<div class="container">
			<div class="row">
				<div class="<?php echo $page_content_class ?>">
					<div class="page_title text-center">
						<h1><?php the_title(); ?></h1>
					</div>

					<div class="contentarea clearfix">

						<?php
						$args = array(
							'redirect' => home_url(),
							'id_username' => 'user',
							'id_password' => 'pass',
						);
						//wp_login_form();
						?>

						<form action="<?php echo home_url(); ?>/wp-login.php" method="post" class="wpcf7-form" name="loginform" id="loginform" novalidate="novalidate">
                            <label class="login-msg" style="color: #f53034">
								<?php
								$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
								if ( $login === "failed" ) {
									echo '<i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Invalid username and/or password.';
								} elseif ( $login === "empty" ) {
									echo '<i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Username and/or Password is empty.';
								} elseif ( $login === "false" ) {
									echo '<i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;You are logged out.';
								}
								?>
                            </label>
							<p>
								<label for="user_login">Username/E-mail</label><br>
								<span class="wpcf7-form-control-wrap username">
									<input type="text" name="log" id="user_login" value class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
								</span>
							</p>
							<p>
								<label for="user_pass">Password</label><br>
								<span class="wpcf7-form-control-wrap password">
									<input type="password" id="user_pass" name="pwd" value class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
								</span>
							</p>
							<p class="login-remember">
								<label>
									<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="wpcf7-form-control wpcf7-validates-as-required"> Remember Me
								</label>
							</p>
							<p class="form-submit">
								<input name="wp-submit" type="submit" id="wp-submit" class="submit" value="Log In">
								<input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>/login">
							</p>
                            <!--<label>Not a member yet? <a href="<?php /*echo home_url(); */?>/register">Register here</a></label>-->
                            <label>Registration is closed at this moment! :(</label>
						</form>

					</div>
				</div>

			</div>
		</div>
	</div>

<?php get_footer(); ?>