<?php
/**
 * Title: Contact details and form
 * Slug: aurora/contact
 * Categories: aurora, contact
 * Description: Contact info cards next to the Aurora Core contact form (shortcode).
 */
$aurora_info = array(
	array( 'mail', 'Email', 'hello@example.com' ),
	array( 'clock', 'Response time', 'Within 24 hours, Mon–Sat' ),
	array( 'globe', 'Working with', 'Clients worldwide, remote-first' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section-tight","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section-tight"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"38%","className":"ak-stagger"} -->
<div class="wp-block-column ak-stagger" style="flex-basis:38%"><?php foreach ( $aurora_info as $aurora_c ) : ?><!-- wp:group {"className":"ak-card ak-contact-item","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group ak-card ak-contact-item"><!-- wp:html -->
<div class="ak-icon"><?php echo aurora_icon( $aurora_c[0] ); // phpcs:ignore ?></div>
<!-- /wp:html -->

<!-- wp:paragraph -->
<p><span class="ak-mono"><?php echo esc_html( $aurora_c[1] ); ?></span><br><strong><?php echo esc_html( $aurora_c[2] ); ?></strong></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:column -->

<!-- wp:column {"className":"ak-reveal"} -->
<div class="wp-block-column ak-reveal"><!-- wp:group {"className":"ak-card ak-glow-border","layout":{"type":"default"}} -->
<div class="wp-block-group ak-card ak-glow-border"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Tell me about your project</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A few details help me prepare a useful first call. Fields marked * are required.</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[aurora_contact_form]
<!-- /wp:shortcode --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
