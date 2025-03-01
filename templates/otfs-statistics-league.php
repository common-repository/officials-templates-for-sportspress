<?php
/**
 * Official Statistics for Single League.
 *
 * @author      savvasha
 * @package     OTFS/Templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// The first row should be column labels.
$labels = $data[0];

// Remove the first row to leave us with the actual data.
unset( $data[0] );

// Skip if there are no rows in the table.
if ( empty( $data ) ) {
	return;
}

$output = '<h4 class="sp-table-caption">' . $caption . '</h4>' .
	'<div class="sp-table-wrapper">' .
	'<table class="sp-player-statistics sp-data-table' . ( $scrollable ? ' sp-scrollable-table' : '' ) . '"><thead><tr>';

foreach ( $labels as $key => $label ) :
	if ( isset( $hide_teams ) && 'team' === $key ) {
		continue;
	}
	$output .= '<th class="data-' . $key . '">' . $label . '</th>';
endforeach;

$output .= '</tr></thead><tbody>';

$i = 0;

foreach ( $data as $season_id => $row ) :

	$output .= '<tr class="' . ( 0 === $i % 2 ? 'odd' : 'even' ) . '">';

	foreach ( $labels as $key => $value ) :
		if ( isset( $hide_teams ) && 'team' === $key ) {
			continue;
		}
		$output .= '<td class="data-' . $key . ( -1 === $season_id ? ' sp-highlight' : '' ) . '">' . sp_array_value( $row, $key, '' ) . '</td>';
	endforeach;

	$output .= '</tr>';

	++$i;

endforeach;

$output .= '</tbody></table></div>';
?>
<div class="sp-template sp-template-player-statistics">
	<?php echo wp_kses_post( $output ); ?>
</div>
