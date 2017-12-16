<?php
/**
 * Created by PhpStorm.
 * User: shuvr
 * Date: 10/24/2017
 * Time: 12:36 PM
 * Template Name: Reset Password
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
                        $key = "";
                        if(isset($_GET['user_id']) and isset($_GET['key'])) {
	                        $user_id = trim( $_GET['user_id'] );
	                        $key     = trim( $_GET['key'] );
                        }
                        if(!empty($user_id) && !empty($key) && $key == get_user_meta($user_id, 'pwd_reset_key', true)) {
                        ?>
                            <form action="" method="post" class="wpcf7-form" name="pwd-reset-form" id="reset-request-form" novalidate="novalidate">
                                <label class="error-msg" style="color: #f53034">
	                                <?php
	                                if(isset($_SESSION['message'])) {
		                                $messages = $_SESSION['message'];
		                                foreach ($messages as $message) {
			                                echo "<i class='fa fa-info-circle' aria-hidden='true'></i>&nbsp;$message<br/>";
		                                }
	                                }
	                                ?>
                                </label>
                                <p>
                                    <label for="old_password">Old Password</label><br>
                                    <span class="wpcf7-form-control-wrap old_password">
                                    <input type="password" name="old_password" id="old_password" value class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                </span>
                                </p>
                                <p>
                                    <label for="new_password">New Password</label><br>
                                    <span class="wpcf7-form-control-wrap new_password">
                                    <input type="password" name="new_password" id="new_password" value class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                </span>
                                </p>
                                <p>
                                    <label for="confirm_password">Confirm New Password</label><br>
                                    <span class="wpcf7-form-control-wrap confirm_password">
                                    <input type="password" name="confirm_password" id="confirm_password" value class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                </span>
                                </p>
                                <p class="form-submit">
                                    <input name="pwd-reset-submit" type="submit" id="reset-request-submit" class="submit" value="Reset Password">
                                    <input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>">
                                    <input type="hidden" name="user_id" value="<?php echo !empty($user_id) ? $user_id : ''; ?>">
                                </p>
                            </form>
                        <?php
                        } else {
                            echo "<p>The provided key is not valid. Please request password reset again.</p>";
                        }
                        ?>
					</div>
				</div>

			</div>
		</div>
	</div>

<?php get_footer(); ?>

<?php
unset($_SESSION['message']);
?>
