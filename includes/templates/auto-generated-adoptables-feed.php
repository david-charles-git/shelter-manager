<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

$plugin_options = get_shelter_manager_options();
$api_method = 'animal_view_adoptable_js';
$api_uri = $plugin_options['api_uri'] . '&method=' . $api_method;
?>
<div id="asm3-adoptables" />';
<script src="<?php echo $api_uri; ?>"></script>