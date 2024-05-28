<?php
get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'page');

        // Check if ACF Pro plugin is active and if the schedule field exists
        if (function_exists('get_field')) {
            $schedule = get_field('schedule');
            if ($schedule) :
    ?>
                <h2 class="sch-head" style="text-align:center;s">Weekly Course Schedule</h2>
                <div class="schedule">
                    <table>
                        <tr class="names">
                            <th>Date</th>
                            <th>Course</th>
                            <th>Instructor</th>
                        </tr>

                        <?php foreach ($schedule as $item) : ?>
                            <tr>
                                <td><?php echo isset($item['date']) ? esc_html($item['date']) : ''; ?></td>
                                <td><?php echo isset($item['course']) ? esc_html($item['course']) : ''; ?></td>
                                <td><?php echo isset($item['instructor']) ? esc_html($item['instructor']) : ''; ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                </div>
            <?php else : ?>
                <p>No schedule found.</p>
        <?php
            endif;
        } else {
            // ACF Pro plugin is not active
            echo "<p>Advanced Custom Fields Pro plugin is not active.</p>";
        }

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
?>