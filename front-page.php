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
        
        // Display the page content
        get_template_part( 'template-parts/content', 'page' );

        // Display the recent news posts
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
        );

        $recent_news = new WP_Query($args);

        if ($recent_news->have_posts()) :
            ?>
            <section class="recent-news">
                <h2>Recent News</h2>
                <div class="recent-news-container">
                    <?php
                    while ($recent_news->have_posts()) :
                        $recent_news->the_post();
                        ?>
                        <article class="recent-news-post">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('portrait-student'); ?>
                                <h3><?php the_title(); ?></h3>
                            </a>
                        </article>
                    <?php 
                    endwhile;
                    wp_reset_postdata(); 
                    ?>
                </div>
            </section>
            <?php
        endif;

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
get_footer();