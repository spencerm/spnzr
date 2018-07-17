<?php
/**
 * Enqueue front-end assets.
 *
 * @return void
 */
function app_action_enqueue_scripts() {
	$template_dir = Theme::uri();

	/**
	 * Enqueue the built-in comment-reply script for singular pages.
	 */
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Enqueue scripts.
	 */
	Theme\Assets::enqueueScript(
		'theme-js-bundle',
		$template_dir . '/dist/scripts/bundle.js',
		[ 'jquery' ],
		true
	);

	/**
	 * Enqueue styles.
	 */
	Theme\Assets::enqueueStyle(
		'theme-css-bundle',
		$template_dir . '/dist/styles/bundle.css'
	);

	/**
	 * Enqueue theme's style.css file to allow overrides for the bundled styles.
	 */
	Theme\Assets::enqueueStyle( 'theme-styles', get_template_directory_uri() . '/style.css' );
}

/**
 * Enqueue admin assets.
 *
 * @return void
 */
function app_action_admin_enqueue_scripts() {
	$template_dir = Theme::uri();

	/**
	 * Enqueue scripts.
	 */
	Theme\Assets::enqueueScript(
		'theme-admin-js-bundle',
		$template_dir . '/dist/scripts/admin-bundle.js',
		[ 'jquery' ],
		true
	);

	/**
	 * Enqueue styles.
	 */
	Theme\Assets::enqueueStyle(
		'theme-admin-css-bundle',
		$template_dir . '/dist/styles/admin-bundle.css'
	);
}

/**
 * Enqueue login assets.
 *
 * @return void
 */
function app_action_login_enqueue_scripts() {
	$template_dir = Theme::uri();

	/**
	 * Enqueue scripts.
	 */
	Theme\Assets::enqueueScript(
		'theme-login-js-bundle',
		$template_dir . '/dist/scripts/login-bundle.js',
		[ 'jquery' ],
		true
	);

	/**
	 * Enqueue styles.
	 */
	Theme\Assets::enqueueStyle(
		'theme-login-css-bundle',
		$template_dir . '/dist/styles/login-bundle.css'
	);
}

/**
 * Add favicon proxy.
 *
 * @see    WPEmergeTheme\Assets\Assets::addFavicon()
 * @return void
 */
function app_action_add_favicon() {
	Theme\Assets::addFavicon();
}

/**
 * Enable upload of svg files.
 *
 * @param  array $mimes Array of accepted file mimes.
 * @return array
 */
function app_filter_add_svg_support( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
