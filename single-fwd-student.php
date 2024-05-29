<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package School_Theme
 */

get_header();
// Function to display related students
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();

		// Display the single post content
		get_template_part('template-parts/content', get_post_type());

		// get the taxonomy terms of current post
		$terms = get_the_terms(get_the_ID(), 'fwd-role');
	
		// if we have terms, display students
		if ($terms) {
			foreach ($terms as $term) {
				$args = array(
					'post_type' => 'fwd-student',
					'tax_query' => array(
						array(
							'taxonomy' => 'fwd-role',
							'field' => 'slug',
							'terms' => $term->slug,
						),
					),
				);
	
				$query = new WP_Query($args);
	
				// will need the current student ID to skip it later
				$current_id = get_the_ID();
	
				// if we have students posts, display their title and link
				if ($query->have_posts()) {
					
					echo "<h2>Meet other " . $term->name . " students</h2>";
					echo "<div class='related-students'>";

					while ($query->have_posts()) {
						$query->the_post();
						if ($current_id == get_the_ID()) {
							// skips the current student
							continue;
						} else {
							// else, display the title and link of related students
							echo "<h3><a href='" . get_the_permalink() . "'>" . get_the_title() . "</a></h3>";
						}
					}

					echo '</div>';
					wp_reset_postdata();
				}
			}
		}

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();


