<?php
/**
 * Title: Process
 * Slug: aurora/process
 * Categories: aurora
 * Description: Four-step working process.
 */
$aurora_steps = array(
	array( '01', 'Discover', 'A focused call to understand your goals, audience and must-haves. You get a clear scope, timeline and fixed quote.' ),
	array( '02', 'Design', 'Moodboards, wireframes and high-fidelity designs in Figma. AI speeds up exploration; taste makes the final call.' ),
	array( '03', 'Build', 'Clean, component-based development in your builder of choice, with staging links so you can review as it grows.' ),
	array( '04', 'Launch & grow', 'Speed, SEO and accessibility checks, a smooth launch, training videos, and ongoing care when you need it.' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section ak-band","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section ak-band"><!-- wp:columns {"align":"wide","className":"ak-section-head ak-reveal"} -->
<div class="wp-block-columns alignwide ak-section-head ak-reveal"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"ak-kicker"} -->
<p class="ak-kicker">How we work</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">A calm, proven <em>process.</em></h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom"} -->
<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:paragraph {"className":"ak-lead"} -->
<p class="ak-lead">No surprises, no endless back-and-forth. Just clear milestones and a website you're proud to share.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","className":"ak-grid ak-grid-4 ak-stagger","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide ak-grid ak-grid-4 ak-stagger"><?php foreach ( $aurora_steps as $aurora_s ) : ?><!-- wp:group {"className":"ak-step","layout":{"type":"default"}} -->
<div class="wp-block-group ak-step"><!-- wp:paragraph {"className":"ak-step-num"} -->
<p class="ak-step-num"><?php echo esc_html( $aurora_s[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $aurora_s[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $aurora_s[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
