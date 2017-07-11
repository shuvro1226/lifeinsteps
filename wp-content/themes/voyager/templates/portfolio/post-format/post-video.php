<?php

$portfolio_single_video = get_metabox( 'portfolio_single_video' );
?>

		<div class="portfolio_video">
			<?php echo apply_filters("the_content", htmlspecialchars_decode( $portfolio_single_video )) ?>
		</div>