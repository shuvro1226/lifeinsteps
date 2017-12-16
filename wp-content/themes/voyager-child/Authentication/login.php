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

						<form action="" method="post" class="wpcf7-form" name="loginform" id="loginform" novalidate="novalidate">
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
								if(isset($_SESSION['message'])) {
									$messages = $_SESSION['message'];
									foreach ($messages as $message) {
										echo "<i class='fa fa-info-circle' aria-hidden='true'></i>&nbsp;$message<br/>";
									}
								}
								?>
                            </label>
							<p>
								<label for="user_login">Username/E-mail</label><br>
								<span class="wpcf7-form-control-wrap username">
									<input type="text" name="user_login" id="user_login" value class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
								</span>
							</p>
							<p>
								<label for="user_pass">Password</label><br>
								<span class="wpcf7-form-control-wrap password">
									<input type="password" id="user_pass" name="user_pass" value class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
								</span>
							</p>
							<p class="login-remember">
								<label>
									<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="wpcf7-form-control wpcf7-validates-as-required"> Remember Me
								</label>
							</p>
							<p class="form-submit">
								<input name="login-submit" type="submit" id="login-submit" class="submit" value="Log In">
								<input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>">
							</p>
                            <p>
                                <label>Not a member yet? <a href="<?php echo home_url(); ?>/register">Register here</a></label>
                            </p>
                            <p>
                                <label><a href="<?php echo home_url(); ?>/forgot-password/">Forgot your password?</a></label>
                            </p>
						</form>

					</div>
				</div>

			</div>
		</div>
	</div>

<?php get_footer(); ?>

<?php
unset($_SESSION['message']);
?>
