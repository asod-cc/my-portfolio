<?php
/**
 * Title: Skills and stack
 * Slug: aurora/skills
 * Categories: aurora
 * Description: Two columns: intro text and skill chips.
 */
$aurora_skills = array( 'WordPress', 'Block themes / FSE', 'Gutenberg blocks', 'Elementor Pro', 'Bricks Builder', 'WooCommerce', 'ACF Pro', 'Custom post types', 'PHP 8', 'JavaScript', 'React', 'REST & GraphQL', 'WPML / Polylang', 'LearnDash', 'MemberPress', 'Technical SEO', 'Core Web Vitals', 'Cloudflare', 'OpenAI & Claude APIs', 'Figma', 'Git & CI/CD', 'Accessibility (WCAG)' );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section ak-band","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section ak-band"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"40%","className":"ak-reveal"} -->
<div class="wp-block-column ak-reveal" style="flex-basis:40%"><!-- wp:paragraph {"className":"ak-kicker"} -->
<p class="ak-kicker">Toolbox</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">All types of WordPress, <em>mastered.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"ak-lead"} -->
<p class="ak-lead">Corporate sites, stores, memberships, LMS, directories, multilingual and headless. If it runs on WordPress, I've built it.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"ak-reveal"} -->
<div class="wp-block-column is-vertically-aligned-center ak-reveal"><!-- wp:list {"className":"ak-chips"} -->
<ul class="wp-block-list ak-chips"><?php foreach ( $aurora_skills as $aurora_skill ) : ?><!-- wp:list-item -->
<li><?php echo esc_html( $aurora_skill ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
