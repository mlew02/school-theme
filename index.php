<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	if (have_posts()):

		if (is_home() && !is_front_page()):
			?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
			<?php
		endif;
		?>

		<section class="news">
			<h2 style="font-size:2.5rem;">Recent News</h2>
			<div class="news-container">
				<?php
				// Start the Loop
				while (have_posts()):
					the_post();
					?>
					<article class="news-post" data-aos="fade-up">
						<a href="<?php the_permalink(); ?>">
							<h3><?php the_title(); ?></h3>
							<p class="post-meta">Posted by <?php echo get_the_author(); ?> on <?php echo get_the_date(); ?></p>
							<?php the_post_thumbnail('portrait-student'); ?>
							<?php echo wp_trim_words(get_the_content(), 30); ?>
						</a>
						<footer class="entry-footer">
							<?php if (get_the_category_list()) : ?>
								<span class="cat-links">Posted in <?php echo get_the_category_list(', '); ?></span>
							<?php endif; ?>
							<?php if (get_the_tag_list()) : ?>
								<span class="tags-links">Tagged <?php echo get_the_tag_list('', ', '); ?></span>
							<?php endif; ?>
						</footer>
					</article>
					<?php
				endwhile;
				?>
			</div>
		</section>

		<?php
		the_posts_navigation();

		// Comments Template
		comments_template();

	else:

		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
