<?php
/**
 * Title: Featured work
 * Slug: aurora/featured-work
 * Categories: aurora, portfolio
 * Description: Latest portfolio projects in a grid (uses the Project post type from Aurora Core).
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section"><!-- wp:columns {"align":"wide","className":"ak-section-head ak-reveal"} -->
<div class="wp-block-columns alignwide ak-section-head ak-reveal"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"ak-kicker"} -->
<p class="ak-kicker">Selected work</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Websites that <em>perform</em> as good as they look.</h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom"} -->
<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-ghost"} -->
<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/work/' ) ); ?>">All projects</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:query {"queryId":11,"query":{"perPage":6,"pages":0,"offset":0,"postType":"project","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","className":"ak-projects"} -->
<div class="wp-block-query alignwide ak-projects"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"300px"}} -->
<!-- wp:group {"className":"ak-card ak-project","layout":{"type":"default"}} -->
<div class="wp-block-group ak-card ak-project"><!-- wp:post-featured-image {"isLink":true,"sizeSlug":"large"} /-->

<!-- wp:post-terms {"term":"project_type"} /-->

<!-- wp:post-title {"level":3,"isLink":true} /-->

<!-- wp:post-excerpt {"excerptLength":20} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"className":"ak-muted"} -->
<p class="ak-muted">Add your first project under Projects → Add New.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
