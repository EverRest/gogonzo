<?php
/**
 * File: updater.php
 *
 * Client library providing API calls to the WooCommerce API Manager and a user interface for
 * plugin license management.
 *
 * @link      https://woocommerce.com/products/woocommerce-api-manager/
 *
 * @package   TIVWP_Updater
 * @author    WPGlobus
 * @copyright Copyright 2016 TIV.NET INC. and Gregory Karpinsky
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_admin() ) {
	add_action( 'plugins_loaded',
		/**
		 * The Updater "Factory".
		 */
		function () {
			/**
			 * Bail out it:
			 * - Already loaded.
			 * - WP is old (we do not test and do not want to support older WP).
			 * - Multisite (we do not support it in general).
			 */
			if (
				defined( 'TIVWP_Updater_VERSION' )
				or version_compare( $GLOBALS['wp_version'], '4.5', '<' )
				or is_multisite()
			) {
				return;
			}

			/**
			 * Load the class and tell others that it's done.
			 */
			require_once __DIR__ . '/class-tivwp-updater.php';
			define( 'TIVWP_Updater_VERSION', '1.0.0' );

			/**
			 * Let everyone create the uploader objects.
			 */
			do_action( 'tivwp_updater_factory' );
		}
		// TODO: Increase the "minus" part with every new release
		, 9999 - 1
	);
}

/*EOF*/
