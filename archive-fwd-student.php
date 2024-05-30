<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();

// creating reusable function to display students
function displayStudents($role) {
    $args = array(
        'post_type' => 'fwd-student',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'fwd-role',
                'field' => 'slug',
                'terms' => $role
            )
        )
    );

    $query = new WP_Query($args);
    
    if ($query->have_posts()) :
        while ($query->have_posts()) {
            $query->the_post();
            ?>
                <article>
                    <a href="<?php the_permalink(); ?>">
                        <h2><?php the_title(); ?></h2>
                    </a>
    
                    <?php 
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('portrait-student');  
                    }
                    
                    the_excerpt(); 

                    $terms = get_the_terms(get_the_ID(), 'fwd-role');

                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            $role = '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
                        }
                        echo "<p>Specialty: $role</p>";
                    }
                    ?>
                </article>

            <?php
        }

        wp_reset_postdata();

        endif;
    }
?>

<main id="primary" class="site-main">

    <?php if (have_posts()) : ?>

        <header class="page-header">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </header><!-- .page-header -->

        <div class="article-wrapper">
            <?php
            // get all terms in taxonomy fwd-role
            $terms = get_terms(array(
                'taxonomy' => 'fwd-role',
                'hide_empty' => false
            ));

            // loop through all terms if we have them
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    displayStudents($term->slug);
                }
            }
            ?>
        </div>

        <!-- Display navigation to next/previous set of posts -->
        <?php 
        
        the_posts_navigation(); 
        
        else : 

        get_template_part('template-parts/content', 'none'); 
        
        endif; 
        ?>

</main><!-- #main -->

<?php
get_footer();

