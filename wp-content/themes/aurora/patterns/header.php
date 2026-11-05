<?php
/**
 * Title: Header
 * Slug: aurora/header
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 */
?>
<!-- wp:group {"align":"full","className":"ak-header-wrap","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull ak-header-wrap"><!-- wp:group {"align":"wide","className":"ak-header-inner","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide ak-header-inner"><!-- wp:paragraph {"className":"ak-logo"} -->
<p class="ak-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="ak-logo-mark">AK</span>Asad Khan</a></p>
<!-- /wp:paragraph -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:navigation {"overlayMenu":"mobile","className":"ak-nav","layout":{"type":"flex","justifyContent":"right"}} /-->

<!-- wp:buttons {"className":"ak-header-cta"} -->
<div class="wp-block-buttons ak-header-cta"><!-- wp:button {"className":"is-style-glow"} -->
<div class="wp-block-button is-style-glow"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Hire me</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
