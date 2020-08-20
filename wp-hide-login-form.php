<?php
/**
 * Plugin Name: Hide Login Form
 * Plugin URI: https://github.com/IIP-Design/wp-hide-login-form
 * Description: A WordPress plugin to hide the login form on the login page when the Google Apps Login plugin is active.
 * Version: 1.0.1
 * Author: Scott Gustas, Marek Rewers, U.S. Department of State - Global Public Affairs Digital Lab
 * Text Domain: wp-hide-login
 *
 * @package WP_Hide_Login
 */

/**
 * Register and enqueue the a custom stylesheet to hide the WP login form.
 * Only executes if the Google Apps Login plugin is active.
 *
 * @since 1.0.0
 */
function set_custom_login() {
  // Set the plugin version and path to the Google Apps Login plugin.
  $plugin_version  = '1.0.1';
  $required_plugin = 'google-apps-login/google_apps_login.php';

  include_once ABSPATH . 'wp-admin/includes/plugin.php';

  // Determine which stylesheet to register.
  $styles = check_for_legacy() ? 'hide-login-legacy.css' : 'hide-login.css';

  wp_register_style( 'gpalab-login-styles', plugins_url( 'styles/' . $styles, __FILE__ ), array(), $plugin_version );

  // Enqueue custom login styles only if Google Apps Login plugin is active.
  if ( is_plugin_active( $required_plugin ) ) {
    wp_enqueue_style( 'gpalab-login-styles' );
  }
}

/**
 * Checks whether the current WordPress install is a legacy version (lower than 5.3).
 *
 * @return boolean Whether the current WordPress version is less than 5.3.
 *
 * @since 1.1.0
 */
function check_for_legacy() {
  global $wp_version;

  $minor_version = substr( $wp_version, 0, 3 );
  $float_version = floatval( $minor_version );

  $is_legacy = $float_version < 5.3 ? true : false;

  return $is_legacy;
};

// Initialize the custom stylesheet on the login page.
add_action( 'login_head', 'set_custom_login' );
