<?php

$portfolio_single_audio = get_metabox( 'portfolio_single_audio' );
?>
		
		<div class="portfolio_audio">
			<?php echo apply_filters("the_content", htmlspecialchars_decode( $portfolio_single_audio )) ?>
		</div>
	