<?php
/**
 * The footer sidebar containing the main widget area
 */
?>

	<?php

		$grid = cstheme_option( 'prefooter_area_layout' ) != '' ? cstheme_option( 'prefooter_area_layout' ) : '4-4-4';
		$i = 1;
		if (is_active_sidebar("footer-sidebar-$i")) {
			foreach (explode('-', $grid) as $g) {
				echo '<div class="col-md-' . $g . ' col' . $i . '">';
					dynamic_sidebar("footer-sidebar-$i");
				echo '</div>';
				$i++;
			}
		}

	?>