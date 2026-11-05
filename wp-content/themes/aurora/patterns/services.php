<?php
/**
 * Title: Services grid
 * Slug: aurora/services
 * Categories: aurora, services
 * Description: Six service cards with icons.
 */
$aurora_services = array(
	array( 'layout', 'Custom WordPress themes', 'Pixel-perfect, hand-coded block themes and classic themes built for speed, accessibility and easy editing.' ),
	array( 'blocks', 'Elementor & Bricks builds', 'Design-system driven page builder sites with global styles, reusable templates and clean, lean output.' ),
	array( 'cart', 'WooCommerce stores', 'Online shops, subscriptions, bookings and memberships with smooth checkouts that actually convert.' ),
	array( 'sparkles', 'AI-powered features', 'On-site assistants, smart search, AI content workflows and automations that save your team hours every week.' ),
	array( 'gauge', 'Speed & Core Web Vitals', 'Audits and fixes that take slow sites to 90+ scores: caching, image pipelines, CDN and code clean-up.' ),
	array( 'shield', 'Care plans & security', 'Updates, daily backups, uptime monitoring, malware scans and priority support so you never worry.' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section"><!-- wp:group {"align":"wide","className":"ak-section-head ak-reveal","layout":{"type":"constrained","contentSize":"720px","justifyContent":"left"}} -->
<div class="wp-block-group alignwide ak-section-head ak-reveal"><!-- wp:paragraph {"className":"ak-kicker"} -->
<p class="ak-kicker">What I do</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Everything your website needs, <em>under one roof.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"ak-lead"} -->
<p class="ak-lead">From a single landing page to a multilingual store, I cover strategy, design, development and long-term care.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"ak-grid ak-stagger","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide ak-grid ak-stagger"><?php foreach ( $aurora_services as $aurora_s ) : ?><!-- wp:group {"className":"ak-card","layout":{"type":"default"}} -->
<div class="wp-block-group ak-card"><!-- wp:html -->
<div class="ak-icon"><?php echo aurora_icon( $aurora_s[0] ); // phpcs:ignore ?></div>
<!-- /wp:html -->

<!-- wp:heading {"level":3,"className":"ak-card-title"} -->
<h3 class="wp-block-heading ak-card-title"><?php echo esc_html( $aurora_s[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $aurora_s[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
