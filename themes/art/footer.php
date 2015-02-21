			<footer class="footer" role="contentinfo">
				<div id="footer-sidebar" class="secondary">
					<div id="footer-sidebar1">
						<img class="footer-logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png"/>
						<?php
						//if(is_active_sidebar('footer-sidebar-1'))
						{
							dynamic_sidebar('footer-sidebar-1');
						}
						?>

					</div>
					<div id="footer-sidebar2">
						<div style="margin:10px;">
						<form role="search" method="get" id="searchform" class="searchform" action="<?=$_SERVER['REMOTE_HOST'];?>">
							<div style="line-height: 40px;">
								<input class="search_query" type="text" value="" name="s" id="s" placeholder="search rideart.org">
								<input type="submit" id="searchsubmit" value="Go »">
							</div>
						</form>
						</div>
						<div style="float:left; width:100%;">
						<?php
						//if(is_active_sidebar('footer-sidebar-2'))
						{
							dynamic_sidebar('footer-sidebar-2');
						}
						?>
						</div>
						<div id="footer-copyright" class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></div>
					</div>
				</div>

				<!--<div id="inner-footer" class="wrap cf">

					<nav role="navigation">
						<?php wp_nav_menu(array(
							'container' => '',                              // remove nav container
							'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
							'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
							'menu_class' => 'nav footer-nav cf',            // adding custom nav class
							'theme_location' => 'footer-links',             // where it's located in the theme
							'before' => '',                                 // before the menu
							'after' => '',                                  // after the menu
							'link_before' => '',                            // before each link
							'link_after' => '',                             // after each link
							'depth' => 0,                                   // limit the depth of the nav
							'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>


					<div id="footer-copyright" class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></div>
					<div id="footer-attributions"><a href="/">Design Attributions</a></div>
				</div>-->


			</footer>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

