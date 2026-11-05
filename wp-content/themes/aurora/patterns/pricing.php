<?php
/**
 * Title: Pricing
 * Slug: aurora/pricing
 * Categories: aurora
 * Description: Three pricing tiers with a featured plan.
 */
$aurora_plans = array(
	array( 'Launch', '1,500', 'For new businesses that need a polished, fast presence.', array( 'Up to 6 custom-designed pages', 'Elementor, Bricks or Gutenberg', 'Mobile-first & accessible', 'On-page SEO setup', '2 weeks of post-launch support' ), false ),
	array( 'Growth', '3,500', 'For brands ready to generate leads and scale content.', array( 'Up to 15 pages + blog', 'Custom design system', 'AI assistant & smart search', 'Speed optimisation (90+ score)', 'Analytics, CRM & email integrations', '1 month of care included' ), true ),
	array( 'Commerce', '6,000', 'For stores, memberships and complex custom builds.', array( 'WooCommerce, bookings or LMS', 'Custom checkout & payment flows', 'Product import & automations', 'Multilingual & multi-currency', 'Priority support for 3 months' ), false ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section"><!-- wp:group {"align":"wide","className":"ak-section-head ak-reveal","layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group alignwide ak-section-head ak-reveal"><!-- wp:paragraph {"align":"center","className":"ak-kicker"} -->
<p class="has-text-align-center ak-kicker">Investment</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Clear packages, <em>fixed</em> quotes.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"ak-lead"} -->
<p class="has-text-align-center ak-lead">Every project is scoped individually. These starting points help you plan.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"ak-grid ak-stagger","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide ak-grid ak-stagger"><?php foreach ( $aurora_plans as $aurora_p ) : ?><!-- wp:group {"className":"ak-card ak-price<?php echo $aurora_p[5] ? ' is-featured' : ''; ?>","layout":{"type":"default"}} -->
<div class="wp-block-group ak-card ak-price<?php echo $aurora_p[5] ? ' is-featured' : ''; ?>"><?php if ( $aurora_p[5] ) : ?><!-- wp:paragraph {"className":"ak-badge"} -->
<p class="ak-badge">Most popular</p>
<!-- /wp:paragraph -->

<?php endif; ?><!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading"><?php echo esc_html( $aurora_p[0] ); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"ak-price-amount"} -->
<p class="ak-price-amount"><sup>from $</sup><?php echo esc_html( $aurora_p[1] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $aurora_p[2] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><?php foreach ( $aurora_p[3] as $aurora_f ) : ?><!-- wp:list-item -->
<li><?php echo esc_html( $aurora_f ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"<?php echo $aurora_p[5] ? 'is-style-glow' : 'is-style-ghost'; ?>"} -->
<div class="wp-block-button <?php echo $aurora_p[5] ? 'is-style-glow' : 'is-style-ghost'; ?>"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a quote</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
