<?php

/**
 * Plugin Name: Shelter Manager
 * Plugin URI: https://www.ip-four.co.uk
 * Description: Shelter Manager is a plugin that allows you to display data from your Shelter Manager account on your website.
 * Version: 1.0
 * Author: David Charles | IP-Four
 * Author URI: https://www.ip-four.co.uk
 * License: GPL2
 * Requires PHP: 7.0
 */

if (!defined('ABSPATH')) {
  die("Access Denied");
}

if (!class_exists('ShelterManagerPlugin')) {
  class ShelterManagerPlugin
  {
    public function __construct()
    {
      define('SHELTER_MANAGER_PLUGIN', plugin_dir_path(__FILE__));
      define('SHELTER_MANAGER_PLUGIN_API_URI_BASE', 'https://eur02b.sheltermanager.com/service?');

      require_once(SHELTER_MANAGER_PLUGIN . '/vendor/autoload.php');
    }

    public function register()
    {
      include_once(SHELTER_MANAGER_PLUGIN . '/includes/functions.php');
      include_once(SHELTER_MANAGER_PLUGIN . '/includes/options.php');
      include_once(SHELTER_MANAGER_PLUGIN . '/includes/shortcodes.php');
    }
  }

  $shelter_manager_plugin = new ShelterManagerPlugin;
  $shelter_manager_plugin->register();
}
