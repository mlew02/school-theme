<?php
/*
Template Name: Schedule Page
*/

get_header();

// Check if ACF Pro plugin is active and if the schedule field exists
if ( function_exists( 'get_field' ) ) {
    $schedule = get_field('schedule');

    if( $schedule ): ?>
        <div class="schedule">
            <table>
                <tr>
                    <th>Date</th>
                    <th>Course</th>
                    <th>Instructor</th>
                </tr>

                <?php foreach( $schedule as $item ): ?>
                    <tr>
                        <td><?php echo isset($item['date']) ? esc_html( $item['date'] ) : ''; ?></td>
                        <td><?php echo isset($item['course']) ? esc_html( $item['course'] ) : ''; ?></td>
                        <td><?php echo isset($item['instructor']) ? esc_html( $item['instructor'] ) : ''; ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
    <?php else: ?>
        <p>No schedule found.</p>
    <?php endif;
} else {
    // ACF Pro plugin is not active
    echo "<p>Advanced Custom Fields Pro plugin is not active.</p>";
}

get_footer();
?>