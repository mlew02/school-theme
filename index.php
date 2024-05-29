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
						</a>
						<p class="post-meta">Posted by <a><?php the_author(); ?></a> on <a><?php echo get_the_date(); ?></a></p>
						<?php the_post_thumbnail('portrait-blog'); ?>
						<?php echo "<p>" . wp_trim_words(get_the_content(), 30); "</p>" ?>
						<p>Posted in: <?php the_category(', '); ?> Tagged: <?php the_tags('', ', ', ''); ?></p> <p><a href="<?php comments_link(); ?>">Leave a Comment</a></p>
					</article>
					<?php
				endwhile;
				?>
			</div>
		</section>
		<?php

		the_posts_navigation();

	else:

		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
