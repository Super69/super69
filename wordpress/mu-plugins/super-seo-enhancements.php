<?php
/**
 * Plugin Name: Super Rollforming – SEO Enhancements
 * Description: Product schema, emoji-clean titles, fixed OG title, and LocalBusiness schema for superrollforming.com.
 * Version:     1.0.0
 * Author:      OpenSEO setup
 *
 * Drop this file into wp-content/mu-plugins/ (create the folder if missing).
 * mu-plugins auto-activate with no admin step. Safe to remove by deleting the file.
 *
 * Everything is guarded so it degrades gracefully if WooCommerce or Yoast is absent,
 * and it never fakes data — offers only appear when a real price is set, ratings only
 * when real reviews exist.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ---------------------------------------------------------------------------
 * 0. Business profile — edit here if any detail changes.
 * ---------------------------------------------------------------------------
 */
function super_seo_profile() {
	return array(
		'name'         => 'Super Rollforming',
		'legal_name'   => 'Super Rollforming',
		'founded'      => '1969',
		'url'          => home_url( '/' ),
		'phones'       => array( '+91-9829-023-969', '+91-9352-503-186' ),
		'emails'       => array( 'superrollforming@gmail.com', 'info@superrollforming.com' ),
		'address'      => array(
			// Factory (primary manufacturing location).
			'streetAddress'   => 'F-176, RIICO Industrial Area Gudli',
			'addressLocality' => 'Udaipur',
			'addressRegion'   => 'Rajasthan',
			'postalCode'      => '313001',
			'addressCountry'  => 'IN',
		),
		// Approximate — refine from your Google Business Profile pin.
		'geo'          => array( 'latitude' => '24.4536', 'longitude' => '73.8100' ),
		'opening'      => array( 'days' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ), 'opens' => '10:00', 'closes' => '17:00' ),
		'same_as'      => array(
			'https://www.facebook.com/superrollforming1',
			'https://www.instagram.com/superrollform',
			'https://www.youtube.com/@SuperRollForming',
		),
		'og_home_title' => 'Roll Forming Machine Manufacturer Since 1969 | Super Rollforming',
	);
}

/**
 * ---------------------------------------------------------------------------
 * 1. Emoji stripping for titles and social meta.
 * ---------------------------------------------------------------------------
 * Removes emoji from rendered titles / meta so SERP and share snippets stay clean.
 * This is a render-time filter (reversible). To also clean the stored post titles
 * permanently, run wordpress/scripts/clean-product-titles.php with WP-CLI.
 */
function super_seo_strip_emoji( $text ) {
	if ( ! is_string( $text ) || '' === $text ) {
		return $text;
	}
	$patterns = array(
		'/[\x{1F300}-\x{1FAFF}]/u', // symbols, pictographs, emoji (incl. supplemental + extended-A)
		'/[\x{2600}-\x{27BF}]/u',   // misc symbols + dingbats
		'/[\x{2B00}-\x{2BFF}]/u',   // misc symbols and arrows used as emoji
		'/[\x{1F1E6}-\x{1F1FF}]/u', // regional indicators (flag emoji)
		'/[\x{FE00}-\x{FE0F}]/u',   // variation selectors
		'/\x{200D}/u',              // zero-width joiner
	);
	$text = preg_replace( $patterns, '', $text );
	$text = preg_replace( '/[ \t]{2,}/', ' ', $text );          // collapse gaps the removal leaves
	$text = preg_replace( '/\s+([,.!?;:])/u', '$1', $text );    // tidy space-before-punctuation
	return trim( $text );
}

foreach ( array( 'the_title', 'single_post_title', 'wpseo_title', 'wpseo_opengraph_title', 'wpseo_twitter_title' ) as $super_seo_title_hook ) {
	add_filter( $super_seo_title_hook, 'super_seo_strip_emoji', 20 );
}
add_filter( 'document_title_parts', function ( $parts ) {
	foreach ( $parts as $key => $value ) {
		$parts[ $key ] = super_seo_strip_emoji( $value );
	}
	return $parts;
}, 20 );

/**
 * ---------------------------------------------------------------------------
 * 2. Fix the generic homepage Open Graph title ("Home").
 * ---------------------------------------------------------------------------
 */
add_filter( 'wpseo_opengraph_title', function ( $title ) {
	if ( is_front_page() || is_home() ) {
		$profile = super_seo_profile();
		return $profile['og_home_title'];
	}
	return $title;
}, 30 );

/**
 * ---------------------------------------------------------------------------
 * 3. Product schema (JSON-LD) on WooCommerce product pages.
 * ---------------------------------------------------------------------------
 * Yoast (without the WooCommerce SEO add-on) does not emit Product schema, so
 * this fills the gap. Quote-based products get valid Product markup; `offers`
 * is added automatically the moment a real price is set, and `aggregateRating`
 * only when real reviews exist.
 */
add_action( 'wp_footer', function () {
	if ( ! function_exists( 'is_product' ) || ! is_product() || ! function_exists( 'wc_get_product' ) ) {
		return;
	}
	$product = wc_get_product( get_the_ID() );
	if ( ! $product ) {
		return;
	}
	$profile = super_seo_profile();

	$name = super_seo_strip_emoji( wp_strip_all_tags( $product->get_name() ) );

	$images = array();
	if ( $product->get_image_id() ) {
		$src = wp_get_attachment_image_url( $product->get_image_id(), 'full' );
		if ( $src ) {
			$images[] = $src;
		}
	}
	foreach ( $product->get_gallery_image_ids() as $gid ) {
		$src = wp_get_attachment_image_url( $gid, 'full' );
		if ( $src ) {
			$images[] = $src;
		}
	}

	$description = super_seo_strip_emoji( wp_strip_all_tags( $product->get_short_description() ?: $product->get_description() ) );

	$schema = array(
		'@context'     => 'https://schema.org/',
		'@type'        => 'Product',
		'name'         => $name,
		'url'          => get_permalink( $product->get_id() ),
		'description'  => $description,
		'brand'        => array( '@type' => 'Brand', 'name' => $profile['name'] ),
		'manufacturer' => array( '@type' => 'Organization', 'name' => $profile['name'], 'url' => $profile['url'] ),
	);

	if ( $images ) {
		$schema['image'] = array_values( array_unique( $images ) );
	}
	if ( $product->get_sku() ) {
		$schema['sku'] = $product->get_sku();
		$schema['mpn'] = $product->get_sku();
	}
	$terms = wp_get_post_terms( $product->get_id(), 'product_cat', array( 'fields' => 'names' ) );
	if ( ! is_wp_error( $terms ) && $terms ) {
		$schema['category'] = super_seo_strip_emoji( $terms[0] );
	}

	// Offers — only when a genuine price exists (this catalogue is quote-based today).
	$price = $product->get_price();
	if ( '' !== $price && is_numeric( $price ) && (float) $price > 0 ) {
		$schema['offers'] = array(
			'@type'         => 'Offer',
			'url'           => get_permalink( $product->get_id() ),
			'priceCurrency' => get_woocommerce_currency(),
			'price'         => (string) $price,
			'availability'  => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
			'seller'        => array( '@type' => 'Organization', 'name' => $profile['name'] ),
		);
	}

	// Aggregate rating — only when real reviews exist.
	if ( $product->get_rating_count() > 0 && $product->get_average_rating() ) {
		$schema['aggregateRating'] = array(
			'@type'       => 'AggregateRating',
			'ratingValue' => (string) $product->get_average_rating(),
			'reviewCount' => (string) $product->get_review_count(),
		);
	}

	echo "\n<script type=\"application/ld+json\">" . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}, 99 );

/**
 * ---------------------------------------------------------------------------
 * 4. LocalBusiness / Organization schema.
 * ---------------------------------------------------------------------------
 * Preferred path: enrich Yoast's existing Organization node (no duplication).
 * Fallback path: if Yoast is not active, output a standalone node on the front page.
 */
function super_seo_organization_fields( $data ) {
	$profile = super_seo_profile();

	$types = isset( $data['@type'] ) ? (array) $data['@type'] : array( 'Organization' );
	if ( ! in_array( 'LocalBusiness', $types, true ) ) {
		$types[] = 'LocalBusiness';
	}
	$data['@type']       = array_values( array_unique( $types ) );
	$data['name']        = $profile['name'];
	$data['telephone']   = $profile['phones'][0];
	$data['email']       = $profile['emails'][0];
	$data['foundingDate'] = $profile['founded'];
	$data['address']     = array_merge( array( '@type' => 'PostalAddress' ), $profile['address'] );
	$data['geo']         = array_merge( array( '@type' => 'GeoCoordinates' ), $profile['geo'] );
	$data['openingHoursSpecification'] = array(
		'@type'     => 'OpeningHoursSpecification',
		'dayOfWeek' => $profile['opening']['days'],
		'opens'     => $profile['opening']['opens'],
		'closes'    => $profile['opening']['closes'],
	);

	$existing_same_as = isset( $data['sameAs'] ) ? (array) $data['sameAs'] : array();
	$data['sameAs']   = array_values( array_unique( array_merge( $existing_same_as, $profile['same_as'] ) ) );

	return $data;
}
add_filter( 'wpseo_schema_organization', 'super_seo_organization_fields' );

add_action( 'wp_footer', function () {
	if ( defined( 'WPSEO_VERSION' ) ) {
		return; // Yoast active — handled by the filter above, avoid duplicate node.
	}
	if ( ! is_front_page() && ! is_home() ) {
		return;
	}
	$profile = super_seo_profile();
	$schema  = super_seo_organization_fields( array(
		'@context' => 'https://schema.org',
		'@type'    => array( 'Organization' ),
		'url'      => $profile['url'],
	) );
	echo "\n<script type=\"application/ld+json\">" . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}, 98 );
