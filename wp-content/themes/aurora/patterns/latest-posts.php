<?php
/**
 * Title: Latest journal posts
 * Slug: aurora/latest-posts
 * Categories: aurora, query
 * Description: Three most recent blog posts.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section"><!-- wp:columns {"align":"wide","className":"ak-section-head ak-reveal"} -->
<div class="wp-block-columns alignwide ak-section-head ak-reveal"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"ak-kicker"} -->
<p class="ak-kicker">Journal</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Notes on the web, <em>design &amp; AI.</em></h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom"} -->
<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-ghost"} -->
<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Read the journal</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:query {"queryId":21,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"280px"}} -->
<!-- wp:group {"className":"ak-card ak-post-card","layout":{"type":"default"}} -->
<div class="wp-block-group ak-card ak-post-card"><!-- wp:post-featured-image {"isLink":true,"sizeSlug":"large"} /-->

<!-- wp:post-date /-->

<!-- wp:post-title {"level":3,"isLink":true} /-->

<!-- wp:post-excerpt {"excerptLength":18} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
