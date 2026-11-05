<?php
/**
 * Title: About intro with image
 * Slug: aurora/about-intro
 * Categories: aurora, about
 * Description: Portrait/visual next to the story.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ak-section-tight","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ak-section-tight"><!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"45%","className":"ak-reveal"} -->
<div class="wp-block-column is-vertically-aligned-center ak-reveal" style="flex-basis:45%"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-framed"} -->
<figure class="wp-block-image size-full is-style-framed"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/about-visual.jpg' ) ); ?>" alt="Asad Khan's workspace: code editor and design system"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"ak-reveal"} -->
<div class="wp-block-column is-vertically-aligned-center ak-reveal"><!-- wp:paragraph {"className":"ak-kicker"} -->
<p class="ak-kicker">My story</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">A decade of turning ideas into <em>websites people love.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"ak-muted"} -->
<p class="ak-muted">I built my first client website in 2016 and never looked back. Since then I've designed and developed more than 350 websites: local businesses and global brands, five-page portfolios and stores with ten thousand products.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"ak-muted"} -->
<p class="ak-muted">Today I combine that experience with modern AI tools to move faster and test more ideas, so clients get better results for their budget. What hasn't changed is the obsession with detail: clean code, considered typography and sites that are a joy to edit.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-glow"} -->
<div class="wp-block-button is-style-glow"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Work with me</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
