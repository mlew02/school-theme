<?php
get_header();
?>

<main id="primary" class="site-main">
	<?php
	while (have_posts()):
		the_post();

		get_template_part('template-parts/content', 'page');

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()):
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="page">
		<div class="entry-content">


			<?php
			// Faculty
			$faculty_args = array(
				'post_type' => 'fwd-staff',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'fwd-department',
						'field' => 'slug',
						'terms' => 'faculty', // Change to your Faculty term slug
					)
				)
			);

			$faculty_query = new WP_Query($faculty_args);

			if ($faculty_query->have_posts()):
				echo '<h2>Faculty</h2>';
				while ($faculty_query->have_posts()):
					$faculty_query->the_post();
					?>
					<div class="staff">
						<h3><?php the_title(); ?></h3>
						<div class="staff-content">
							<?php the_content(); ?>
						
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;

			// Administrative
			$admin_args = array(
				'post_type' => 'fwd-staff',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'fwd-department',
						'field' => 'slug',
						'terms' => 'administrative', // Change to your Administrative term slug
					)
				)
			);

			$admin_query = new WP_Query($admin_args);

			if ($admin_query->have_posts()):
				echo '<h2>Administrative</h2>';
				while ($admin_query->have_posts()):
					$admin_query->the_post();
					?>
					<div class="staff">
						<h3><?php the_title(); ?></h3>
						<div class="staff-content">
							<?php the_content(); ?>
							<?php
							// Add any additional fields or content here
							?>
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div><!-- .entry-content -->

	</article><!-- #post-<?php the_ID(); ?> -->

</main><!-- #primary -->
<?php

get_footer();
?>