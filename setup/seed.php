<?php
/**
 * Seed the Aurora demo content: pages, projects, posts, menu, settings.
 *
 * Run AFTER the theme and plugin are active (patterns must be registered):
 *   wp theme activate aurora && wp plugin activate aurora-core
 *   wp eval-file setup/seed.php
 *
 * Safe to run more than once: existing items (matched by slug) are updated, not duplicated.
 *
 * @package Aurora
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( "Run with: wp eval-file setup/seed.php\n" );
}

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

if ( 'aurora' !== get_stylesheet() ) {
	exit( "Activate the Aurora theme first: wp theme activate aurora\n" );
}
if ( ! post_type_exists( 'project' ) ) {
	exit( "Activate the Aurora Core plugin first: wp plugin activate aurora-core\n" );
}

$media_dir = __DIR__ . '/media/';

/* ---------------------------------------------------------------- helpers */

/**
 * Pattern content with nested pattern references expanded, so pages are fully editable blocks.
 */
function aurora_seed_pattern( $slug, $depth = 0 ) {
	$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( $slug );
	if ( ! $pattern || $depth > 5 ) {
		return '';
	}
	return preg_replace_callback(
		'#<!-- wp:pattern \{"slug":"([^"]+)"\} /-->#',
		static fn( $m ) => aurora_seed_pattern( $m[1], $depth + 1 ),
		$pattern['content']
	);
}

/**
 * Create or update a post by slug + type.
 */
function aurora_seed_upsert( array $args ) {
	$existing = get_posts(
		array(
			'name'           => $args['post_name'],
			'post_type'      => $args['post_type'],
			'post_status'    => 'any',
			'posts_per_page' => 1,
		)
	);
	$args = wp_parse_args( $args, array( 'post_status' => 'publish', 'post_author' => 1 ) );
	if ( $existing ) {
		$args['ID'] = $existing[0]->ID;
		return wp_update_post( wp_slash( $args ) );
	}
	return wp_insert_post( wp_slash( $args ) );
}

/**
 * Import an image once and return the attachment ID.
 */
function aurora_seed_image( $file, $title, $parent = 0 ) {
	global $media_dir;
	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'meta_key'       => '_aurora_seed',
			'meta_value'     => $file,
			'posts_per_page' => 1,
		)
	);
	if ( $existing ) {
		return $existing[0]->ID;
	}
	$tmp = wp_tempnam( $file );
	copy( $media_dir . $file, $tmp );
	$id = media_handle_sideload( array( 'name' => $file, 'tmp_name' => $tmp ), $parent, $title );
	if ( is_wp_error( $id ) ) {
		error_log( 'Aurora seed: ' . $id->get_error_message() ); // phpcs:ignore
		return 0;
	}
	update_post_meta( $id, '_aurora_seed', $file );
	update_post_meta( $id, '_wp_attachment_image_alt', $title );
	return $id;
}

/**
 * Block markup helpers for project/post bodies.
 */
function aurora_b_p( $text, $class = '' ) {
	$attr = $class ? ' {"className":"' . $class . '"}' : '';
	$cls  = $class ? ' class="' . $class . '"' : '';
	return "<!-- wp:paragraph$attr -->\n<p$cls>$text</p>\n<!-- /wp:paragraph -->\n\n";
}
function aurora_b_h( $text, $level = 2 ) {
	$attr = 2 === $level ? '' : ' {"level":' . $level . '}';
	return "<!-- wp:heading$attr -->\n<h$level class=\"wp-block-heading\">$text</h$level>\n<!-- /wp:heading -->\n\n";
}
function aurora_b_list( array $items, $checks = true ) {
	$attr = $checks ? ' {"className":"is-style-checks"}' : '';
	$cls  = $checks ? 'wp-block-list is-style-checks' : 'wp-block-list';
	$li   = implode( "\n\n", array_map( static fn( $i ) => "<!-- wp:list-item -->\n<li>$i</li>\n<!-- /wp:list-item -->", $items ) );
	return "<!-- wp:list$attr -->\n<ul class=\"$cls\">$li</ul>\n<!-- /wp:list -->\n\n";
}
function aurora_b_facts( array $facts ) {
	$out = "<!-- wp:group {\"className\":\"ak-facts\",\"layout\":{\"type\":\"default\"}} -->\n<div class=\"wp-block-group ak-facts\">";
	foreach ( $facts as $label => $value ) {
		$out .= "<!-- wp:paragraph -->\n<p><span class=\"ak-mono\">$label</span><br>$value</p>\n<!-- /wp:paragraph -->\n\n";
	}
	return $out . "</div>\n<!-- /wp:group -->\n\n";
}
function aurora_b_quote( $text, $cite ) {
	return "<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><!-- wp:paragraph -->\n<p>$text</p>\n<!-- /wp:paragraph --><cite>$cite</cite></blockquote>\n<!-- /wp:quote -->\n\n";
}

/* --------------------------------------------------------------- settings */

update_option( 'blogname', 'Asad Khan' );
update_option( 'blogdescription', 'WordPress Developer & Designer' );
update_option( 'timezone_string', 'Asia/Karachi' );
update_option( 'date_format', 'M j, Y' );
update_option( 'posts_per_page', 9 );
update_option( 'default_comment_status', 'closed' );
update_option( 'permalink_structure', '/%postname%/' );

// Elementor: enable on projects too, and let the theme control colours and fonts.
update_option( 'elementor_cpt_support', array( 'page', 'post', 'project' ) );
update_option( 'elementor_disable_color_schemes', 'yes' );
update_option( 'elementor_disable_typography_schemes', 'yes' );

// Remove WordPress sample content.
foreach ( array( array( 'hello-world', 'post' ), array( 'sample-page', 'page' ) ) as $sample ) {
	$p = get_page_by_path( $sample[0], OBJECT, $sample[1] );
	if ( $p ) {
		wp_delete_post( $p->ID, true );
	}
}

/* ------------------------------------------------------------------ pages */

$pages = array(
	'home'     => array( 'Home', 'aurora/page-home', 'page-landing' ),
	'about'    => array( 'About', 'aurora/page-about', 'page-landing' ),
	'services' => array( 'Services', 'aurora/page-services', 'page-landing' ),
	'contact'  => array( 'Contact', 'aurora/page-contact', 'page-landing' ),
	'blog'     => array( 'Journal', '', '' ),
);
$page_ids = array();
foreach ( $pages as $slug => $page ) {
	$page_ids[ $slug ] = aurora_seed_upsert(
		array(
			'post_type'    => 'page',
			'post_name'    => $slug,
			'post_title'   => $page[0],
			'post_content' => $page[1] ? aurora_seed_pattern( $page[1] ) : '',
			'menu_order'   => count( $page_ids ),
		)
	);
	if ( $page[2] ) {
		update_post_meta( $page_ids[ $slug ], '_wp_page_template', $page[2] );
	}
}
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $page_ids['home'] );
update_option( 'page_for_posts', $page_ids['blog'] );

/* --------------------------------------------------------------- projects */

$projects = array(
	array(
		'slug'    => 'lumiere-hotel-spa',
		'title'   => 'Lumière Hotel & Spa',
		'type'    => 'Hospitality',
		'image'   => 'project-lumiere.jpg',
		'excerpt' => 'A boutique coastal hotel website with direct online booking that cut OTA commission and doubled direct reservations.',
		'facts'   => array( 'Client' => 'Lumière Hotel &amp; Spa', 'Year' => '2026', 'Built with' => 'Elementor Pro, WooCommerce Bookings', 'Services' => 'Design, development, SEO' ),
		'challenge' => 'Lumière relied on travel agencies for 80% of bookings and lost up to 18% of every reservation to commission. Their old site was slow, hard to update and had no way to book directly.',
		'solution'  => array( 'A cinematic, editorial design that sells the experience before the room', 'Real-time availability and direct booking with deposits and seasonal pricing', 'Elementor templates so the team can publish offers and packages in minutes', 'Multilingual content (EN / IT / DE) with WPML and localised SEO' ),
		'results'   => array( '2.1× more direct bookings in the first season', '96 mobile PageSpeed score with full-screen imagery', '−40% time spent by staff updating the website' ),
	),
	array(
		'slug'    => 'northwind-outfitters',
		'title'   => 'Northwind Outfitters',
		'type'    => 'E-commerce',
		'image'   => 'project-northwind.jpg',
		'excerpt' => 'A fast WooCommerce store for a technical outdoor brand, with a custom product configurator and a one-page checkout.',
		'facts'   => array( 'Client' => 'Northwind Outfitters', 'Year' => '2025', 'Built with' => 'WooCommerce, Bricks Builder', 'Services' => 'E-commerce, performance, integrations' ),
		'challenge' => 'Northwind\'s store had 2,000+ products, a seven-step checkout and a 6-second load time. Mobile conversion was below 0.8%.',
		'solution'  => array( 'Lean Bricks-built theme with a reusable component library', 'Filterable catalogue with instant AJAX search and size guides', 'One-page checkout with Apple Pay, Google Pay and Klarna', 'ERP and inventory sync with automated stock alerts' ),
		'results'   => array( '+64% mobile conversion rate', '1.2s largest contentful paint on 4G', '€1.4M online revenue in year one' ),
	),
	array(
		'slug'    => 'pulse-analytics',
		'title'   => 'Pulse Analytics',
		'type'    => 'SaaS',
		'image'   => 'project-pulse.jpg',
		'excerpt' => 'A dark, high-impact marketing site for an AI analytics startup, with an interactive product tour and docs hub.',
		'facts'   => array( 'Client' => 'Pulse Analytics', 'Year' => '2026', 'Built with' => 'Custom block theme, React blocks', 'Services' => 'Brand site, docs, AI assistant' ),
		'challenge' => 'Pulse needed a website that explained a complex AI product in seconds and could scale to hundreds of documentation pages, without a developer for every change.',
		'solution'  => array( 'Custom Gutenberg blocks for pricing tables, feature tours and changelogs', 'Interactive dashboard hero built with lightweight React', 'Documentation hub with versioning and semantic AI search', 'On-site assistant trained on the docs to answer pre-sales questions' ),
		'results'   => array( '+38% trial sign-ups in the first quarter', '71% of pre-sales questions answered by the assistant', 'Marketing team ships new pages without developers' ),
	),
	array(
		'slug'    => 'harbor-co-law',
		'title'   => 'Harbor & Co. Law',
		'type'    => 'Corporate',
		'image'   => 'project-harbor.jpg',
		'excerpt' => 'A refined, trustworthy website for a 40-year-old law firm, with attorney profiles, insights and lead qualification.',
		'facts'   => array( 'Client' => 'Harbor &amp; Co.', 'Year' => '2025', 'Built with' => 'Gutenberg block theme, ACF Pro', 'Services' => 'Design, development, content strategy' ),
		'challenge' => 'The firm\'s reputation was excellent offline but its website looked dated and generated few qualified enquiries.',
		'solution'  => array( 'Classic, editorial design language: navy, gold and serif typography', 'Attorney profiles and practice areas powered by ACF custom fields', 'Insights hub with author pages and schema markup', 'Smart intake form that routes enquiries to the right practice group' ),
		'results'   => array( '+120% qualified consultation requests', 'Top-3 rankings for 14 local practice-area keywords', 'WCAG 2.2 AA accessibility compliance' ),
	),
	array(
		'slug'    => 'verde-kitchen',
		'title'   => 'Verde Kitchen',
		'type'    => 'Restaurant',
		'image'   => 'project-verde.jpg',
		'excerpt' => 'A warm, seasonal restaurant site with live menus, table reservations, gift cards and private dining enquiries.',
		'facts'   => array( 'Client' => 'Verde Kitchen', 'Year' => '2024', 'Built with' => 'Elementor Pro, WooCommerce', 'Services' => 'Design, reservations, gift card shop' ),
		'challenge' => 'Menus changed weekly but lived in PDFs, reservations went through a third-party widget, and gift cards were sold only in person.',
		'solution'  => array( 'Menu post type the chefs update from their phone', 'Integrated reservation flow with deposit support for large groups', 'WooCommerce gift card shop with instant email delivery', 'Local SEO setup and Google Business integration' ),
		'results'   => array( '€38k in online gift card sales in the first holiday season', '+55% private dining enquiries', 'Menus updated in under two minutes' ),
	),
	array(
		'slug'    => 'atlas-academy',
		'title'   => 'Atlas Academy',
		'type'    => 'Education / LMS',
		'image'   => 'project-atlas.jpg',
		'excerpt' => 'A learning platform with 320+ courses, memberships, team accounts and AI-generated course summaries.',
		'facts'   => array( 'Client' => 'Atlas Academy', 'Year' => '2026', 'Built with' => 'LearnDash, MemberPress, Bricks', 'Services' => 'LMS build, memberships, AI features' ),
		'challenge' => 'Atlas was outgrowing a hosted course platform: fees were rising, branding was limited and team sales required manual invoicing.',
		'solution'  => array( 'Custom LearnDash course experience with progress tracking', 'MemberPress subscriptions with team seats and invoicing', 'AI-generated lesson summaries and quiz suggestions for instructors', 'Migration of 18,000 learners with zero downtime' ),
		'results'   => array( '−70% platform costs compared to the hosted solution', '+29% course completion rate', 'Team plans now 35% of revenue' ),
	),
);

foreach ( $projects as $i => $proj ) {
	$content  = aurora_b_facts( $proj['facts'] );
	$content .= aurora_b_h( 'The challenge' ) . aurora_b_p( esc_html( $proj['challenge'] ) );
	$content .= aurora_b_h( 'The solution' ) . aurora_b_list( array_map( 'esc_html', $proj['solution'] ) );
	$content .= aurora_b_h( 'The results' ) . aurora_b_list( array_map( 'esc_html', $proj['results'] ) );
	$content .= aurora_b_p( '<em>Sample case study. Replace with your real project details, screenshots and client results.</em>', 'ak-muted' );

	$id = aurora_seed_upsert(
		array(
			'post_type'    => 'project',
			'post_name'    => $proj['slug'],
			'post_title'   => $proj['title'],
			'post_excerpt' => $proj['excerpt'],
			'post_content' => $content,
			'menu_order'   => $i,
		)
	);
	wp_set_object_terms( $id, $proj['type'], 'project_type' );
	$img = aurora_seed_image( $proj['image'], $proj['title'] . ' website design', $id );
	if ( $img ) {
		set_post_thumbnail( $id, $img );
	}
}

/* ------------------------------------------------------------------ posts */

$posts = array(
	array(
		'slug'     => 'elementor-vs-bricks-2026',
		'title'    => 'Elementor vs Bricks in 2026: which builder should you choose?',
		'cat'      => 'Page Builders',
		'image'    => 'blog-builders.jpg',
		'date'     => '-6 days',
		'excerpt'  => 'After hundreds of builds with both, here is how I decide between Elementor, Bricks and native blocks for each client.',
		'body'     => array(
			array( 'p', 'Every week a client asks me which page builder they should use. After ten years and hundreds of WordPress builds, my honest answer is: it depends on who will edit the site, and how much performance matters.' ),
			array( 'h', 'Choose Elementor when your team edits daily' ),
			array( 'p', 'Elementor is still the most familiar visual editor. Marketing teams pick it up in an afternoon, the ecosystem of add-ons is huge, and Elementor Pro\'s theme builder covers headers, footers, archives and popups. The trade-off is heavier front-end output, which you have to manage with good habits.' ),
			array( 'h', 'Choose Bricks when every millisecond counts' ),
			array( 'p', 'Bricks generates remarkably clean markup and makes it easy to build a real design system with global classes and components. It is my first choice for performance-critical stores and agency sites where a developer stays involved.' ),
			array( 'h', 'Choose native blocks for longevity' ),
			array( 'p', 'The block editor and Site Editor are now genuinely capable. Block themes like Aurora (the theme running this site) need no extra plugin, load almost no extra code, and will be supported for as long as WordPress exists.' ),
			array( 'q', 'The best builder is the one your team will actually use well, set up by someone who knows its limits.', 'Asad Khan' ),
			array( 'h', 'My quick decision checklist' ),
			array( 'l', array( 'Non-technical editors publishing often → Elementor', 'Performance-critical, developer-maintained → Bricks', 'Long-term, low-maintenance, content-focused → Gutenberg blocks', 'Already invested in one? Optimise it before you migrate' ) ),
		),
	),
	array(
		'slug'    => 'how-i-use-ai-to-ship-wordpress-sites-faster',
		'title'   => 'How I use AI to ship WordPress sites faster (without cutting corners)',
		'cat'     => 'AI',
		'image'   => 'blog-ai-workflow.jpg',
		'date'    => '-14 days',
		'excerpt' => 'Where AI genuinely saves time in a WordPress project, and where a human still has to make the call.',
		'body'    => array(
			array( 'p', 'AI hasn\'t replaced the craft of building websites, but it has changed where the time goes. Here is what my workflow looks like in 2026.' ),
			array( 'h', '1. Discovery and structure' ),
			array( 'p', 'After a kickoff call I use AI to turn notes into a structured brief, a draft sitemap and content outlines. What used to take two days now takes a morning, and the client reviews something concrete sooner.' ),
			array( 'h', '2. Design exploration' ),
			array( 'p', 'AI helps generate layout variations and copy alternatives quickly. The final design is still mine: taste, brand fit and hierarchy are human decisions.' ),
			array( 'h', '3. Development and QA' ),
			array( 'p', 'Code assistants speed up boilerplate such as custom post types, block patterns and integrations, and automated checks catch accessibility, SEO and performance issues before launch.' ),
			array( 'h', '4. AI features for your visitors' ),
			array( 'l', array( 'Assistants that answer common customer questions 24/7', 'Semantic search that understands what people mean', 'AI-assisted product descriptions and content drafts, always reviewed by a person' ) ),
			array( 'q', 'AI handles the repetitive work. That leaves more of the budget for the details people remember.', 'Asad Khan' ),
		),
	),
	array(
		'slug'    => 'wordpress-essentials-every-business-site-needs',
		'title'   => '10 WordPress essentials every business website needs',
		'cat'     => 'Guides',
		'image'   => 'blog-essentials.jpg',
		'date'    => '-25 days',
		'excerpt' => 'The plugins, settings and habits I set up on every client site before it goes live.',
		'body'    => array(
			array( 'p', 'Whatever the design, every professional WordPress site needs the same solid foundations. This is the checklist I run before every launch.' ),
			array( 'l', array( '<strong>Backups:</strong> daily, off-site, and tested (UpdraftPlus or host-level)', '<strong>Security:</strong> firewall, login protection and 2FA (Wordfence)', '<strong>SEO:</strong> titles, sitemaps and schema (Yoast SEO or Rank Math)', '<strong>Caching:</strong> page and browser caching (WP Super Cache, LiteSpeed or your host)', '<strong>Image optimisation:</strong> WebP/AVIF and lazy loading (Smush or similar)', '<strong>Reliable email:</strong> SMTP so forms actually arrive (WP Mail SMTP)', '<strong>Redirects:</strong> keep old URLs working after a redesign (Redirection)', '<strong>Analytics:</strong> privacy-friendly tracking and Search Console (Site Kit)', '<strong>Cookie consent:</strong> GDPR-compliant banners where required (Complianz)', '<strong>Uptime monitoring</strong> and a clear update routine' ) ),
			array( 'h', 'Fewer plugins, better plugins' ),
			array( 'p', 'Every plugin is code you need to trust and maintain. I prefer a small set of well-supported tools over dozens of single-purpose ones. The Docker setup for this site installs exactly the list above.' ),
		),
	),
);

foreach ( $posts as $post ) {
	$content = '';
	foreach ( $post['body'] as $block ) {
		switch ( $block[0] ) {
			case 'p':
				$content .= aurora_b_p( esc_html( $block[1] ) );
				break;
			case 'h':
				$content .= aurora_b_h( esc_html( $block[1] ) );
				break;
			case 'l':
				$content .= aurora_b_list( $block[1] );
				break;
			case 'q':
				$content .= aurora_b_quote( esc_html( $block[1] ), esc_html( $block[2] ) );
				break;
		}
	}
	$cat = term_exists( $post['cat'], 'category' );
	if ( ! $cat ) {
		$cat = wp_insert_term( $post['cat'], 'category' );
	}
	$date = gmdate( 'Y-m-d H:i:s', strtotime( $post['date'] ) );
	$id   = aurora_seed_upsert(
		array(
			'post_type'     => 'post',
			'post_name'     => $post['slug'],
			'post_title'    => $post['title'],
			'post_excerpt'  => $post['excerpt'],
			'post_content'  => $content,
			'post_category' => array( (int) $cat['term_id'] ),
			'post_date'     => $date,
			'post_date_gmt' => $date,
		)
	);
	$img = aurora_seed_image( $post['image'], $post['title'], $id );
	if ( $img ) {
		set_post_thumbnail( $id, $img );
	}
}
wp_delete_term( (int) get_option( 'default_category' ), 'category' );

/* ------------------------------------------------------------- navigation */

$links = array(
	array( 'About', $page_ids['about'], 'page' ),
	array( 'Services', $page_ids['services'], 'page' ),
	array( 'Work', 0, '' ),
	array( 'Journal', $page_ids['blog'], 'page' ),
	array( 'Contact', $page_ids['contact'], 'page' ),
);
$nav = '';
foreach ( $links as $link ) {
	if ( $link[1] ) {
		$nav .= sprintf( '<!-- wp:navigation-link {"label":"%s","type":"page","id":%d,"url":"%s","kind":"post-type"} /-->', $link[0], $link[1], get_permalink( $link[1] ) );
	} else {
		$nav .= sprintf( '<!-- wp:navigation-link {"label":"%s","url":"%s","kind":"custom"} /-->', $link[0], home_url( '/work/' ) );
	}
}
aurora_seed_upsert(
	array(
		'post_type'    => 'wp_navigation',
		'post_name'    => 'main-menu',
		'post_title'   => 'Main menu',
		'post_content' => $nav,
	)
);

flush_rewrite_rules();

$msg = sprintf( "Seeded: %d pages, %d projects, %d posts. Visit %s\n", count( $page_ids ), count( $projects ), count( $posts ), home_url( '/' ) );
if ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::success( trim( $msg ) );
} else {
	echo $msg; // phpcs:ignore
}
