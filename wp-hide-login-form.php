<?php
/**
 * Plugin Name: Hide Login Form
 * Description: A WordPress plugin to hide the login form on the login page when the Google Apps Login plugin is active.
 * Author: Scott Gustas
 * Version: 1.0.1
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