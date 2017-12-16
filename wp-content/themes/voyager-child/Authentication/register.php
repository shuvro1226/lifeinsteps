<?php
/**
 * Created by PhpStorm.
 * Template Name: Register
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

						<form action="" method="post" class="wpcf7-form registerform-form" name="registerform_form" id="registerform_form" novalidate="novalidate">
                            <label class="register-msg" style="color: #f53034">
								<?php
								if(isset($_SESSION['message'])) {
								    $messages = $_SESSION['message'];
								    foreach ($messages as $message) {
									    echo "<i class='fa fa-info-circle' aria-hidden='true'></i>&nbsp;$message<br/>";
                                    }
                                }
								?>
                            </label>
                            <div class="registration-form-fields">
                                <div class="registration-rows">
                                    <label class="registration-columns" for="first_name">First Name</label>
                                    <span class="wpcf7-form-control-wrap registration-columns">
                                        <input type="text" name="first_name" id="first_name" value="<?php echo isset($_SESSION['first_name']) ? $_SESSION['first_name'] : ''; ?>" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                    </span>
                                </div>
                                <div class="registration-rows">
                                    <label class="registration-columns" for="last_name">Last Name</label>
                                    <span class="wpcf7-form-control-wrap registration-columns">
                                        <input type="text" name="last_name" id="last_name" value="<?php echo isset($_SESSION['last_name']) ? $_SESSION['last_name'] : ''; ?>" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                    </span>
                                </div>
                                <div class="registration-rows">
                                    <label class="registration-columns" for="last_name">Username</label>
                                    <span class="wpcf7-form-control-wrap registration-columns">
                                        <input type="text" name="username" id="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                    </span>
                                </div>
                                <div class="registration-rows">
                                    <label class="registration-columns" for="email">E-mail</label>
                                    <span class="wpcf7-form-control-wrap registration-columns">
									<input type="email" name="email" id="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
								</span>
                                </div>
                                <div class="registration-rows">
                                    <label class="registration-columns" for="user_pass">Password</label>
                                    <span class="wpcf7-form-control-wrap registration-columns">
									<input type="password" id="user_pass" name="user_pass" value class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
								</span>
                                </div>
                                <div class="registration-rows">
                                    <label class="registration-columns" for="confirm_user_pass">Confirm Password</label>
                                    <span class="wpcf7-form-control-wrap registration-columns">
									<input type="password" id="confirm_user_pass" name="confirm_user_pass" value class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
								</span>
                                </div>
                            </div>

							<p class="form-submit">
								<input name="registration_submit" type="submit" id="registration_submit" class="submit" value="Register">
							</p>
                            <label>Already a member? <a href="<?php echo home_url(); ?>/login">Log In Now</a></label>
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
