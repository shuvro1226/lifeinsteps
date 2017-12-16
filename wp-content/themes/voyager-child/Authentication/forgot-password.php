<?php
/**
 * Created by PhpStorm.
 * User: shuvr
 * Date: 10/24/2017
 * Time: 12:36 PM
 * Template Name: Forgot Password
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

						<form action="" method="post" class="wpcf7-form" name="reset-request-form" id="reset-request-form" novalidate="novalidate">
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
								<label for="user_login">Enter E-mail Address</label><br>
								<span class="wpcf7-form-control-wrap username">
									<input type="email" name="user_email" id="user_email" value class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
								</span>
							</p>
							<p class="form-submit">
								<input name="reset-request-submit" type="submit" id="reset-request-submit" class="submit" value="Send Request">
								<input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>">
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
