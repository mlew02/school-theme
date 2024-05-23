<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header><!-- .page-header -->

        <?php

        // Display designers
        $args = array(
            'post_type' => 'fwd-student',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'tax_query' => array (
                array(
                    'taxonomy' => 'fwd-role',
                    'field' => 'slug',
                    'terms' => 'designer'
                )
            )
        );

        $designer_query = new WP_Query($args);

        if ($designer_query->have_posts()) :
            while( $designer_query->have_posts() ) :
                $designer_query->the_post(); 
                ?>
                <article>
                    <a href="<?php the_permalink(); ?>">
                        <h2><?php the_title(); ?></h2>
                    </a>
                    <!-- Display post image -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('portrait-student'); ?>
                    <?php endif; ?>

                    <!-- Display excerpt -->
                    <?php the_excerpt(); ?>

                    <!-- Read more link -->
                    <a href="<?php the_permalink(); ?>">Read more about the student...</a>

                    <!-- Display taxonomy terms -->
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'fwd-role');
                    if ($terms && !is_wp_error($terms)) :
                        echo '<p>Specialty: ';
                        $term_links = array();
                        foreach ($terms as $term) {
                            $term_links[] = '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
                        }
                        echo implode(', ', $term_links);
                        echo '</p>';
                    endif;
                    ?>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;

        // Display developers
        $args = array(
            'post_type' => 'fwd-student',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'tax_query' => array (
                array(
                    'taxonomy' => 'fwd-role',
                    'field' => 'slug',
                    'terms' => 'developer'
                )
            )
        );

        $developer_query = new WP_Query($args);

        if ($developer_query->have_posts()) :
            while( $developer_query->have_posts() ) :
                $developer_query->the_post(); 
                ?>
                <article>
                    <a href="<?php the_permalink(); ?>">
                        <h2><?php the_title(); ?></h2>
                    </a>
                    <!-- Display post image -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('portrait-student'); ?>
                    <?php endif; ?>

                    <!-- Display excerpt -->
                    <?php the_excerpt(); ?>

                    <!-- Read more link -->
                    <a href="<?php the_permalink(); ?>">Read more about the student...</a>

                    <!-- Display taxonomy terms -->
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'fwd-role');
                    if ($terms && !is_wp_error($terms)) :
                        echo '<p>Specialty: ';
                        $term_links = array();
                        foreach ($terms as $term) {
                            $term_links[] = '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
                        }
                        echo implode(', ', $term_links);
                        echo '</p>';
                    endif;
                    ?>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;

        // Display navigation to next/previous set of posts
        the_posts_navigation();

    else :

        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</main><!-- #main -->

<?php
get_footer();
?>
