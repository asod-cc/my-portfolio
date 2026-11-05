<?php
/**
 * Title: Experience timeline
 * Slug: aurora/timeline
 * Categories: aurora, about
 * Description: Career milestones.
 */
$aurora_tl = array(
	array( '2016', 'First theme, first clients', 'Started freelancing with custom WordPress themes for local businesses and quickly grew through referrals.' ),
	array( '2018', 'Agency partner & lead developer', 'Led WordPress development for digital agencies, shipping dozens of corporate and campaign sites a year.' ),
	array( '2020', 'WooCommerce specialist', 'Focused on e-commerce: stores, subscriptions and bookings for brands moving their sales online.' ),
	array( '2022', 'Page-builder systems', 'Built reusable Elementor and Bricks design systems that let marketing teams launch pages in minutes.' ),
	array( '2024', 'AI-assisted workflow', 'Integrated AI into discovery, design and QA, and started shipping AI assistants and smart search for clients.' ),
	array( 'Today', 'Independent studio', 'Partnering directly with founders, marketing teams and agencies on websites that look premium and perform.' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section ak-band","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section ak-band"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"40%","className":"ak-reveal"} -->
<div class="wp-block-column ak-reveal" style="flex-basis:40%"><!-- wp:paragraph {"className":"ak-kicker"} -->
<p class="ak-kicker">Experience</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Ten years, <em>one craft.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"ak-muted"} -->
<p class="ak-muted">From hand-coded themes to AI-powered experiences, every year added new tools to the same goal: websites that work beautifully.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"ak-timeline ak-stagger","layout":{"type":"default"}} -->
<div class="wp-block-group ak-timeline ak-stagger"><?php foreach ( $aurora_tl as $aurora_t ) : ?><!-- wp:group {"className":"ak-tl-item","layout":{"type":"default"}} -->
<div class="wp-block-group ak-tl-item"><!-- wp:paragraph {"className":"ak-kicker"} -->
<p class="ak-kicker"><?php echo esc_html( $aurora_t[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $aurora_t[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $aurora_t[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
