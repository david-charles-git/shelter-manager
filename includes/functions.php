<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

include_once(SHELTER_MANAGER_PLUGIN . '/includes/functions/app.php');
include_once(SHELTER_MANAGER_PLUGIN . '/includes/functions/api.php');
include_once(SHELTER_MANAGER_PLUGIN . '/includes/functions/ajax.php');
include_once(SHELTER_MANAGER_PLUGIN . '/includes/functions/options.php');
include_once(SHELTER_MANAGER_PLUGIN . '/includes/functions/endpoints.php');
include_once(SHELTER_MANAGER_PLUGIN . '/includes/functions/redirection.php');

function enqueue_plugin_styles()
{
  $css_files = [
    [
      "name" => 'shelter-manager-plugin-styles', "path" => plugin_dir_url(__FILE__) . 'dist/app.css', "version" => "2.0.0"
    ],
  ];

  foreach ($css_files as $file) {
    wp_enqueue_style($file['name'], $file['path'], array(), $file['version'], 'all');
  }
}
add_action('wp_enqueue_scripts', 'enqueue_plugin_styles');

function enqueue_plugin_scripts()
{
  $js_files = [
    [
      "name" => 'shelter-manager-plugin-scripts', "path" => plugin_dir_url(__FILE__) . 'dist/app.min.js', "version" => "2.0.0"
    ],
    [
      "name" => 'shelter-manager-plugin-jquery', "path" => plugin_dir_url(__FILE__) . 'dist/jquery.min.js', "version" => "3.7.0"
    ],
  ];

  foreach ($js_files as $file) {
    wp_enqueue_script($file['name'], $file['path'], array(), $file['version'], false);
  }
}
add_action('wp_enqueue_scripts', 'enqueue_plugin_scripts');

function enqueue_plugin_ajax_scripts()
{
  $js_file = plugin_dir_url(__FILE__) . 'dist/ajax.min.js';

  wp_enqueue_script('shelter-manager-ajax-script', $js_file, array('jquery'), '2.0', false);
  wp_localize_script('shelter-manager-ajax-script', 'shelterManagerAjax', array('shelterManagerAjaxUri' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_plugin_ajax_scripts');
