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

function custom_login() {
  //If the Google Apps Login is activated, let's hide the login form
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  wp_register_style( 'custom-login-styles', plugins_url('custom-login-styles.css', __FILE__) );
  $requiredplugin = 'google-apps-login/google_apps_login.php';
  if ( is_plugin_active($requiredplugin) )
    wp_enqueue_style( 'custom-login-styles' );
}
add_action('login_head', 'custom_login');