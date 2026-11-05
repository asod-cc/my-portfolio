<?php
/**
 * Title: AI quick-answer assistant
 * Slug: aurora/assistant
 * Categories: aurora
 * Inserter: no
 * Description: Floating assistant that answers common questions in the browser. Edit answers in assets/js/theme.js.
 */
?>
<!-- wp:html -->
<div class="ak-assistant" data-contact="<?php echo esc_url( home_url( '/contact/' ) ); ?>" data-work="<?php echo esc_url( home_url( '/work/' ) ); ?>">
	<div class="ak-assistant-panel" role="dialog" aria-label="Quick answers">
		<div class="ak-assistant-head"><span class="ak-assistant-orb"></span><div><strong>Ask Asad's assistant</strong><small>Instant answers · usually replies in seconds</small></div></div>
		<div class="ak-assistant-log" aria-live="polite"><div class="ak-msg bot">Hi 👋 I can answer questions about pricing, timelines, page builders, WooCommerce and AI features. What are you planning?</div></div>
		<div class="ak-assistant-chips"><button type="button">How much does a website cost?</button><button type="button">Elementor or Bricks?</button><button type="button">Can you add AI features?</button></div>
		<form class="ak-assistant-form"><input type="text" placeholder="Type your question…" aria-label="Your question"><button type="submit" aria-label="Send">↑</button></form>
	</div>
	<button class="ak-assistant-toggle" type="button" aria-expanded="false"><span class="ak-assistant-orb"></span>Ask AI</button>
</div>
<!-- /wp:html -->
