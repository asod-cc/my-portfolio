<?php
/**
 * Plugin Name: Aurora Core
 * Plugin URI:  https://github.com/asod-cc/my-portfolio
 * Description: Portfolio "Projects" post type, project categories, and a spam-protected contact form that saves enquiries in the dashboard and emails them to you. Companion to the Aurora theme, but works with any theme (and inside Elementor via the Shortcode widget).
 * Version:     1.0.0
 * Author:      Asad Khan
 * License:     GPL-2.0-or-later
 * Text Domain: aurora-core
 * Requires at least: 6.6
 * Requires PHP: 8.0
 *
 * @package AuroraCore
 */

defined( 'ABSPATH' ) || exit;

/* -------------------------------------------------------------------------
 * Post types
 * ---------------------------------------------------------------------- */

/**
 * Register Projects, Project Types and Enquiries.
 */
function aurora_core_register_types() {
	register_post_type(
		'project',
		array(
			'labels'        => array(
				'name'          => __( 'Projects', 'aurora-core' ),
				'singular_name' => __( 'Project', 'aurora-core' ),
				'add_new_item'  => __( 'Add New Project', 'aurora-core' ),
				'edit_item'     => __( 'Edit Project', 'aurora-core' ),
				'all_items'     => __( 'All Projects', 'aurora-core' ),
				'menu_name'     => __( 'Portfolio', 'aurora-core' ),
			),
			'public'        => true,
			'has_archive'   => 'work',
			'rewrite'       => array( 'slug' => 'work', 'with_front' => false ),
			'menu_icon'     => 'dashicons-portfolio',
			'menu_position' => 5,
			'show_in_rest'  => true,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields', 'revisions' ),
		)
	);

	register_taxonomy(
		'project_type',
		'project',
		array(
			'labels'            => array(
				'name'          => __( 'Project Types', 'aurora-core' ),
				'singular_name' => __( 'Project Type', 'aurora-core' ),
			),
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'work/type', 'with_front' => false ),
		)
	);

	register_post_type(
		'aurora_enquiry',
		array(
			'labels'          => array(
				'name'          => __( 'Enquiries', 'aurora-core' ),
				'singular_name' => __( 'Enquiry', 'aurora-core' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'menu_icon'       => 'dashicons-email-alt',
			'menu_position'   => 26,
			'supports'        => array( 'title', 'editor' ),
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
		)
	);
}
add_action( 'init', 'aurora_core_register_types' );

/**
 * Flush rewrite rules on activation so /work/ works immediately.
 */
function aurora_core_activate() {
	aurora_core_register_types();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'aurora_core_activate' );
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );

/* -------------------------------------------------------------------------
 * Contact form
 * ---------------------------------------------------------------------- */

/**
 * Options shown in the "project type" select.
 *
 * @return string[]
 */
function aurora_core_form_types() {
	return apply_filters(
		'aurora_core_form_types',
		array( 'New website', 'Redesign', 'WooCommerce store', 'Elementor / Bricks build', 'AI features', 'Speed & SEO', 'Maintenance / care plan', 'Something else' )
	);
}

/**
 * Budget ranges shown in the form.
 *
 * @return string[]
 */
function aurora_core_form_budgets() {
	return apply_filters( 'aurora_core_form_budgets', array( 'Under $1,500', '$1,500 – $3,500', '$3,500 – $6,000', '$6,000 – $12,000', '$12,000+' ) );
}

/**
 * Handle a submission. Runs on template_redirect so we can redirect (PRG pattern).
 */
function aurora_core_handle_form() {
	if ( 'POST' !== ( $_SERVER['REQUEST_METHOD'] ?? '' ) || empty( $_POST['aurora_contact'] ) ) {
		return;
	}

	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( 'aurora_sent', $back );

	if ( ! isset( $_POST['_aurora_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['_aurora_nonce'] ), 'aurora_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'aurora_sent', 'error', $back ) . '#contact-form' );
		exit;
	}

	// Honeypot and minimum fill time (bots submit instantly).
	$started = isset( $_POST['aurora_ts'] ) ? absint( $_POST['aurora_ts'] ) : 0;
	if ( ! empty( $_POST['aurora_website'] ) || ( $started && time() - $started < 3 ) ) {
		wp_safe_redirect( add_query_arg( 'aurora_sent', 'ok', $back ) . '#contact-form' );
		exit;
	}

	$name    = sanitize_text_field( wp_unslash( $_POST['aurora_name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['aurora_email'] ?? '' ) );
	$company = sanitize_text_field( wp_unslash( $_POST['aurora_company'] ?? '' ) );
	$type    = sanitize_text_field( wp_unslash( $_POST['aurora_type'] ?? '' ) );
	$budget  = sanitize_text_field( wp_unslash( $_POST['aurora_budget'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['aurora_message'] ?? '' ) );

	if ( '' === $name || ! is_email( $email ) || '' === $message ) {
		wp_safe_redirect( add_query_arg( 'aurora_sent', 'invalid', $back ) . '#contact-form' );
		exit;
	}

	$body = sprintf(
		"Name: %s\nEmail: %s\nCompany: %s\nProject type: %s\nBudget: %s\n\n%s",
		$name,
		$email,
		$company ? $company : '-',
		$type ? $type : '-',
		$budget ? $budget : '-',
		$message
	);

	wp_insert_post(
		array(
			'post_type'    => 'aurora_enquiry',
			'post_status'  => 'private',
			/* translators: 1: name, 2: project type */
			'post_title'   => sprintf( __( '%1$s · %2$s', 'aurora-core' ), $name, $type ? $type : __( 'Enquiry', 'aurora-core' ) ),
			'post_content' => $body,
		)
	);

	$to = apply_filters( 'aurora_core_form_recipient', get_option( 'admin_email' ) );
	wp_mail(
		$to,
		/* translators: %s: sender name */
		sprintf( __( 'New project enquiry from %s', 'aurora-core' ), $name ),
		$body,
		array( 'Reply-To: ' . $name . ' <' . $email . '>' )
	);

	wp_safe_redirect( add_query_arg( 'aurora_sent', 'ok', $back ) . '#contact-form' );
	exit;
}
add_action( 'template_redirect', 'aurora_core_handle_form' );

/**
 * [aurora_contact_form] shortcode.
 *
 * @return string
 */
function aurora_core_form_shortcode() {
	$status = isset( $_GET['aurora_sent'] ) ? sanitize_key( $_GET['aurora_sent'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	$notice = '';
	if ( 'ok' === $status ) {
		$notice = '<div class="ak-notice is-success" role="status">' . esc_html__( 'Thank you! Your message has been sent. I will reply within 24 hours.', 'aurora-core' ) . '</div>';
	} elseif ( 'invalid' === $status ) {
		$notice = '<div class="ak-notice is-error" role="alert">' . esc_html__( 'Please add your name, a valid email and a short message.', 'aurora-core' ) . '</div>';
	} elseif ( 'error' === $status ) {
		$notice = '<div class="ak-notice is-error" role="alert">' . esc_html__( 'Your session expired. Please try again.', 'aurora-core' ) . '</div>';
	}

	$options = static function ( $items ) {
		$out = '';
		foreach ( $items as $item ) {
			$out .= '<option>' . esc_html( $item ) . '</option>';
		}
		return $out;
	};

	ob_start();
	?>
	<div id="contact-form"><?php echo $notice; // phpcs:ignore WordPress.Security.EscapeOutput ?>
	<form class="ak-form" method="post" action="">
		<?php wp_nonce_field( 'aurora_contact', '_aurora_nonce' ); ?>
		<input type="hidden" name="aurora_contact" value="1">
		<input type="hidden" name="aurora_ts" value="<?php echo esc_attr( time() ); ?>">
		<div class="ak-hp" aria-hidden="true"><label>Website <input type="text" name="aurora_website" tabindex="-1" autocomplete="off"></label></div>
		<div class="ak-row">
			<label><?php esc_html_e( 'Your name *', 'aurora-core' ); ?><input type="text" name="aurora_name" required autocomplete="name"></label>
			<label><?php esc_html_e( 'Email *', 'aurora-core' ); ?><input type="email" name="aurora_email" required autocomplete="email"></label>
		</div>
		<div class="ak-row">
			<label><?php esc_html_e( 'Company', 'aurora-core' ); ?><input type="text" name="aurora_company" autocomplete="organization"></label>
			<label><?php esc_html_e( 'Project type', 'aurora-core' ); ?><select name="aurora_type"><?php echo $options( aurora_core_form_types() ); // phpcs:ignore ?></select></label>
		</div>
		<label><?php esc_html_e( 'Budget', 'aurora-core' ); ?><select name="aurora_budget"><?php echo $options( aurora_core_form_budgets() ); // phpcs:ignore ?></select></label>
		<label><?php esc_html_e( 'Tell me about your project *', 'aurora-core' ); ?><textarea name="aurora_message" required placeholder="<?php esc_attr_e( 'Goals, timeline, links to sites you like…', 'aurora-core' ); ?>"></textarea></label>
		<button type="submit"><?php esc_html_e( 'Send message →', 'aurora-core' ); ?></button>
	</form></div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'aurora_contact_form', 'aurora_core_form_shortcode' );

/**
 * Never cache the page that shows a submission result.
 */
add_action(
	'template_redirect',
	function () {
		if ( isset( $_GET['aurora_sent'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			nocache_headers();
		}
	},
	1
);

/* -------------------------------------------------------------------------
 * Small admin niceties
 * ---------------------------------------------------------------------- */

/**
 * Show featured image thumbnails in the Projects list.
 */
add_filter(
	'manage_project_posts_columns',
	function ( $cols ) {
		return array_slice( $cols, 0, 1, true ) + array( 'aurora_thumb' => __( 'Image', 'aurora-core' ) ) + array_slice( $cols, 1, null, true );
	}
);
add_action(
	'manage_project_posts_custom_column',
	function ( $col, $post_id ) {
		if ( 'aurora_thumb' === $col ) {
			echo get_the_post_thumbnail( $post_id, array( 80, 50 ), array( 'style' => 'border-radius:6px;object-fit:cover' ) );
		}
	},
	10,
	2
);
