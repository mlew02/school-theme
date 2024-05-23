<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

        <div class="test-aos" data-aos="fade-up">
            <h2>Test AOS</h2>
            <p>
                This should fade when the page loads. If it doesn't, then check functions.php to make sure that AOS is properly enqueued. Or maybe you missed it, in which case reload the page.
            </p>
        </div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();