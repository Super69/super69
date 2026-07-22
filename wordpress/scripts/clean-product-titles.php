<?php
/**
 * Permanently strip emoji from stored product and post titles.
 *
 * The mu-plugin cleans titles at render time; this cleans the database itself so
 * the raw post_title is emoji-free everywhere (admin, feeds, exports).
 *
 * Usage (from the WordPress root, e.g. over SSH on Hostinger):
 *   wp eval-file wp-content/scripts/clean-product-titles.php            # dry run, prints changes
 *   wp eval-file wp-content/scripts/clean-product-titles.php --apply    # actually update
 *
 * Requires WP-CLI. Take a database backup before running with --apply.
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	echo "Run this with: wp eval-file <path> [--apply]\n";
	return;
}

$apply = in_array( '--apply', (array) ( $args ?? array() ), true )
	|| ( isset( $assoc_args['apply'] ) && $assoc_args['apply'] );

function super_seo_cli_strip_emoji( $text ) {
	$patterns = array(
		'/[\x{1F300}-\x{1FAFF}]/u',
		'/[\x{2600}-\x{27BF}]/u',
		'/[\x{2B00}-\x{2BFF}]/u',
		'/[\x{1F1E6}-\x{1F1FF}]/u',
		'/[\x{FE00}-\x{FE0F}]/u',
		'/\x{200D}/u',
	);
	$text = preg_replace( $patterns, '', $text );
	$text = preg_replace( '/[ \t]{2,}/', ' ', $text );
	$text = preg_replace( '/\s+([,.!?;:])/u', '$1', $text );
	return trim( $text );
}

$query = new WP_Query( array(
	'post_type'      => array( 'product', 'post', 'page' ),
	'post_status'    => 'any',
	'posts_per_page' => -1,
	'fields'         => 'ids',
) );

$changed = 0;
foreach ( $query->posts as $post_id ) {
	$old = get_the_title( $post_id );
	$new = super_seo_cli_strip_emoji( $old );
	if ( $old !== $new ) {
		$changed++;
		WP_CLI::log( sprintf( "#%d\n  - %s\n  + %s", $post_id, $old, $new ) );
		if ( $apply ) {
			wp_update_post( array( 'ID' => $post_id, 'post_title' => $new ) );
		}
	}
}

if ( 0 === $changed ) {
	WP_CLI::success( 'No emoji found in any product/post/page title.' );
} elseif ( $apply ) {
	WP_CLI::success( sprintf( 'Updated %d title(s).', $changed ) );
} else {
	WP_CLI::warning( sprintf( '%d title(s) would change. Re-run with --apply to save.', $changed ) );
}
