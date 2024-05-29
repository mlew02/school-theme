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

		$args = array(
            'post-type' => 'fwd-student',
            'posts_per_page' => -1,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            ?>
            <div>
            <h2>Students</h2>
            <?php
            while ($query->have_posts()) {
                $query->the_post();
                
                the_content();
            }
            wp_reset_postdata();
            ?>
            </div>
            <?php
        }



		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
