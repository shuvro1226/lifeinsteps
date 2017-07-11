		<div id="header_mobile_wrap">
			<header>
				<div class="container">
					<div class="mobile_elements_wrap">
						<?php cstheme_logo(); ?>
						<?php if( cstheme_option( 'social_icons_enabled') ) { ?>
							<div class="social_links_wrap">
								<?php echo cstheme_social_links(); ?>
							</div>
						<?php } ?>
						<?php if( cstheme_option( 'fixed_sidebar_enable') ) { ?>
							<div class="sidebar_btn">
								<i class="fa fa-info"></i>
							</div>
						<?php } ?>
						<?php if( cstheme_option( 'search_icon_enabled') ) { ?>
							<div class="header_search">
								<?php get_search_form(true) ?>
							</div>
						<?php } ?>
						<a class="mobile_menu_btn heading_font" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
					</div>
					<div class="menu-primary-menu-container-wrap heading_font">
						<?php wp_nav_menu( array( 'menu_class' => 'nav-menu', 'theme_location' => 'primary' ) ); ?>
					</div>
				</div>
			</header>
			<div class="header_wrap_bg"></div>
		</div>