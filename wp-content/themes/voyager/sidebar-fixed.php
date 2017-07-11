<?php
/**
 * The fixed sidebar containing the main widget area
 */
?>

	<?php if ( is_active_sidebar( 'sidebar-fixed' ) ) { ?>
		<?php dynamic_sidebar('sidebar-fixed') ?>
	<?php } ?>