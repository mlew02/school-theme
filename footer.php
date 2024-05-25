<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package School_Theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'school-theme' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'school-theme' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'school-theme' ), 'school-theme', '<a href="https://mlewebs.ca/school/">Matthew NIna</a>' );

				// display logo in footer
				if (has_custom_logo()) : ?>
					<div class="footer-logo">
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<?php the_custom_logo(); ?>
						</a>
					</div>
				<?php endif; ?>

				<section class="footer-credits">
					<h2>Credits</h2>
					<p>Created by: 
						<a href="https://wp.bcitwebdeveloper.ca/"><strong>Matthew Lew & Nina Weng</strong></a>
					</p>

					<p>
						Photos courtesy of:
						<a href="https://burst.shopify.com"><strong>Burst</strong></a>
					</p>
				</section>

				<?php
				// grab footer menu name dynamically and display it as h2 as title of m enu
				$menu_location = 'footer-menu';
				$locations = get_nav_menu_locations();
				$menu_id = $locations[$menu_location];
				$menu = wp_get_nav_menu_object($menu_id);
				$menu_name = $menu->name;

				// register footer menu
				wp_nav_menu(
					array(
						'items_wrap' => '<h2>' . esc_html($menu_name) . '</h2><ul id="%1$s" class="%2$s">%3$s</ul>',
						'theme_location' => $menu_location,
						'menu_id'        => 'footer-menu',
					)
				);
				
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
