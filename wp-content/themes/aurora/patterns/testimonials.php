<?php
/**
 * Title: Testimonials
 * Slug: aurora/testimonials
 * Categories: aurora, testimonials
 * Description: Three client quotes. Replace the sample quotes with real client feedback.
 */
$aurora_quotes = array(
	array( 'Asad rebuilt our store from the ground up. Pages load instantly, the checkout is effortless, and our team can finally edit everything ourselves.', 'Client name', 'Founder, Retail brand', 'CN' ),
	array( 'The rare developer who cares about design as much as code. Our new site looks premium, ranks better and the AI assistant handles half our enquiries.', 'Client name', 'Marketing Director, SaaS company', 'CN' ),
	array( 'We have worked with Asad on more than twenty agency projects. Reliable, fast, and every build is clean enough to hand straight to the client.', 'Client name', 'Partner, Digital agency', 'CN' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section"><!-- wp:group {"align":"wide","className":"ak-section-head ak-reveal","layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group alignwide ak-section-head ak-reveal"><!-- wp:paragraph {"align":"center","className":"ak-kicker"} -->
<p class="has-text-align-center ak-kicker">Kind words</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Clients who <em>stay</em> for years.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"ak-grid ak-stagger","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide ak-grid ak-stagger"><?php foreach ( $aurora_quotes as $aurora_q ) : ?><!-- wp:group {"className":"ak-card ak-testimonial","layout":{"type":"default"}} -->
<div class="wp-block-group ak-card ak-testimonial"><!-- wp:paragraph {"className":"ak-stars"} -->
<p class="ak-stars">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"ak-quote"} -->
<p class="ak-quote">“<?php echo esc_html( $aurora_q[0] ); ?>”</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="ak-author"><span class="ak-avatar"><?php echo esc_html( $aurora_q[3] ); ?></span><div><p><strong><?php echo esc_html( $aurora_q[1] ); ?></strong></p><p class="ak-muted" style="font-size:.88rem"><?php echo esc_html( $aurora_q[2] ); ?></p></div></div>
<!-- /wp:html --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
