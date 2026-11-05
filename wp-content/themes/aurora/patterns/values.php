<?php
/**
 * Title: Values
 * Slug: aurora/values
 * Categories: aurora, about
 * Description: Three principles cards.
 */
$aurora_values = array(
	array( 'target', 'Results over decoration', 'Beautiful is the baseline. Every design choice is measured against leads, sales and speed.' ),
	array( 'users', 'Built for the people who edit it', 'Your team should feel confident updating the site, so I build with clear structure and training.' ),
	array( 'heart', 'Long-term partnership', 'Most clients stay for years. I treat your website like a product that keeps improving.' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section"><!-- wp:group {"align":"wide","className":"ak-section-head ak-reveal","layout":{"type":"constrained","contentSize":"720px","justifyContent":"left"}} -->
<div class="wp-block-group alignwide ak-section-head ak-reveal"><!-- wp:paragraph {"className":"ak-kicker"} -->
<p class="ak-kicker">Principles</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">How I <em>think</em> about every project.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"ak-grid ak-stagger","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide ak-grid ak-stagger"><?php foreach ( $aurora_values as $aurora_v ) : ?><!-- wp:group {"className":"ak-card","layout":{"type":"default"}} -->
<div class="wp-block-group ak-card"><!-- wp:html -->
<div class="ak-icon"><?php echo aurora_icon( $aurora_v[0] ); // phpcs:ignore ?></div>
<!-- /wp:html -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $aurora_v[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $aurora_v[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
