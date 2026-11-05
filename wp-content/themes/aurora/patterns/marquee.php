<?php
/**
 * Title: Tools marquee
 * Slug: aurora/marquee
 * Categories: aurora
 * Description: Scrolling band of tools and platforms.
 */
$aurora_tools = array( 'WordPress', 'WooCommerce', 'Elementor Pro', 'Bricks Builder', 'Gutenberg', 'Advanced Custom Fields', 'WPML', 'Yoast SEO', 'Cloudflare', 'OpenAI', 'Figma', 'Stripe' );
$aurora_items = '';
foreach ( array_merge( $aurora_tools, $aurora_tools ) as $aurora_tool ) {
	$aurora_items .= '<span>' . esc_html( $aurora_tool ) . '</span>';
}
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section-tight ak-band","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section-tight ak-band"><!-- wp:paragraph {"align":"center","className":"ak-kicker"} -->
<p class="has-text-align-center ak-kicker">The stack behind 350+ launches</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="ak-marquee" aria-label="Tools I work with"><div class="ak-marquee-track"><?php echo $aurora_items; // phpcs:ignore WordPress.Security.EscapeOutput ?></div></div>
<!-- /wp:html --></section>
<!-- /wp:group -->
