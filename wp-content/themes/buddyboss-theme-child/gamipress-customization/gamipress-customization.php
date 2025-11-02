<?php 

/**
 * GamiPress last 30 days point average and gamipress leaderboard integration
 */

/**
 * Shortcode: [gamipress_average_points type="credits" user_id="123"]
 * Calculates user's average earned points per day for the last 30 days.
 * Uses do_shortcode() and WordPress timezone.
 */
function gamipress_average_points_shortcode( $atts ) {

    // Default shortcode attributes
    $atts = shortcode_atts( array(
        'type'     => 'all', // GamiPress points type (e.g., credits, coins)
        'user_id'  => get_current_user_id(),
    ), $atts, 'gamipress_average_points' );

    if ( empty( $atts['user_id'] ) ) {
        return 'User not found';
    }

    // Get current timestamp in WordPress timezone
    $now = current_time( 'timestamp' );

    // Define 30-day period using WordPress timezone
    $period_start = date_i18n( 'Y-m-d', strtotime( '-30 days', $now ) );
    $period_end   = date_i18n( 'Y-m-d', $now );

    // Build the internal GamiPress shortcode
    // $inner_shortcode = sprintf(
    //     '[gamipress_points type="%s" user_id="%d" period="custom" period_start="%s" period_end="%s" inline="yes" label="no" thumbnail="no"]',
    //     esc_attr( $atts['type'] ),
    //     intval( $atts['user_id'] ),
    //     esc_attr( $period_start ),
    //     esc_attr( $period_end )
    // );

    // Execute GamiPress shortcode
    $output = do_shortcode( '[gamipress_user_points current_user="no" user_id="1" type="'.$atts['type'].'" user_id=1 period="custom" period_start="2025-10-02" period_end="2025-11-02" ]' );

    // Extract numeric value only (remove HTML, labels, etc.)
    $total_points = floatval( strip_tags( $output ) );

    echo '<pre>';
    var_dump( $output );
    var_dump( $total_points );
    var_dump( $total_points );
    var_dump( $period_start );
    var_dump( $period_end );

    // Calculate average per day
    $average_points = round( $total_points / 30, 2 );

    // Return formatted output
    return '<span class="gamipress-average-points">Average: ' . $average_points . '</span>';
}

add_shortcode( 'gamipress_average_points', 'gamipress_average_points_shortcode' );