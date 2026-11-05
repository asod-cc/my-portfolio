<?php
/**
 * Title: FAQ
 * Slug: aurora/faq
 * Categories: aurora
 * Description: Frequently asked questions using the Details block.
 */
$aurora_faq = array(
	array( 'Which page builder do you recommend: Elementor, Bricks or Gutenberg?', 'It depends on who edits the site. Elementor is the most familiar for teams, Bricks produces the leanest code for performance-critical sites, and native Gutenberg blocks are the most future-proof. I recommend one after our discovery call and build with whichever you prefer.' ),
	array( 'How long does a website take?', 'A brochure website usually takes 2 to 4 weeks. Larger business sites take 4 to 6 weeks and WooCommerce or custom builds 6 to 10 weeks. You get a timeline with milestones before we start.' ),
	array( 'Will I be able to edit the website myself?', 'Yes. Every site is built so you can change text, images and pages visually without touching code. You also get recorded training videos for your site.' ),
	array( 'What do your AI features actually do?', 'Practical things: a site assistant that answers common customer questions, smart search that understands intent, AI-assisted content and product descriptions, and automated quality checks. You stay in control of everything that is published.' ),
	array( 'Do you work with agencies (white label)?', 'Absolutely. I have partnered with agencies for years: design-to-development builds, overflow development and maintenance under your brand, with NDAs available.' ),
	array( 'What happens after launch?', 'You get free support for a set period, then optional care plans covering updates, backups, security monitoring, speed checks and a monthly bank of edit time.' ),
);
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"38%","className":"ak-reveal"} -->
<div class="wp-block-column ak-reveal" style="flex-basis:38%"><!-- wp:paragraph {"className":"ak-kicker"} -->
<p class="ak-kicker">FAQ</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Questions, <em>answered.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"ak-muted"} -->
<p class="ak-muted">Can't find what you need? Ask the assistant in the corner, or send a message.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"ak-faq ak-reveal"} -->
<div class="wp-block-column ak-faq ak-reveal"><?php foreach ( $aurora_faq as $aurora_i => $aurora_item ) : ?><!-- wp:details<?php echo 0 === $aurora_i ? ' {"showContent":true}' : ''; ?> -->
<details class="wp-block-details"<?php echo 0 === $aurora_i ? ' open' : ''; ?>><summary><?php echo esc_html( $aurora_item[0] ); ?></summary><!-- wp:paragraph -->
<p><?php echo esc_html( $aurora_item[1] ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --><?php endforeach; ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
