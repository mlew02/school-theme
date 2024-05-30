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
		
		$department = 'fwd-department';
		$terms = get_terms(
			array(
				'taxonomy' => $department,
				'hide_empty' => false,
			)
		);

		if ($terms && !is_wp_error($terms)) {
			foreach ($terms as $term) {
				$args = array(
					'post_type' => 'fwd-staff',
					'posts_per_page' => -1,
					'tax_query' => array(
						array(
							'taxonomy' => $department,
							'field' => 'slug',
							'terms' => $term->slug
						)
					)
				);

				$query = new WP_Query($args);

				if ($query->have_posts()) {
					echo "<div class='staff-container'>";
					?>

					<h2><?php echo esc_html($term->name); ?></h2>

					<?php
					while($query->have_posts()) {
						$query->the_post();
						?>

						<article class="staff-post">

							<h3><?php the_title(); ?></h3>

							<?php
							// display acf fields
							if (function_exists('get_field')) {
                                if (get_field('bio')) {
									?>
									<p><?php the_field('bio');  ?></p>
									<?php
								}

								if (get_field('course')) {
									?>
									<p><?php the_field('course');  ?></p>
									<?php
								}

								if (get_field('link')) {
									?>
									<p><a href="<?php the_field('link'); ?>">Website</a></p>
									<?php
								}
                            }

							$departmentName = $term->name;
                            echo "<p>Department: $departmentName</p>";
                            ?>
                        </article>
						<?php
						
					}
					echo "</div>";
					wp_reset_postdata();
				}
			}
		}

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
