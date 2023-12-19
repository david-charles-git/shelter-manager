<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

function shelter_manager_auto_generated_adoptable_feed()
{
  ob_start();

  include(SHELTER_MANAGER_PLUGIN . '/includes/templates/auto-generated-adoptables-feed.php');

  return ob_get_clean();
}
add_shortcode('shelter_manager_auto_generated_adoptable_feed', 'shelter_manager_auto_generated_adoptable_feed');

function shelter_manager_animal_feed($atts)
{
  ob_start();

  $default_attributes = array(
    'class' => '',
    'type' => 'adoptable',
    'limit' => 12,
    'title' => '',
    'offset' => 0,
  );
  $attributes = shortcode_atts($default_attributes, $atts);
  extract($attributes);
  include(SHELTER_MANAGER_PLUGIN . '/includes/templates/animals-feed.php');

  return ob_get_clean();
}
add_shortcode('shelter_manager_animal_feed', 'shelter_manager_animal_feed');

function shelter_manager_animal_details($atts)
{
  ob_start();

  $default_attributes = array(
    'class' => '',
    'animal_id' => 'all',
    'type' => 'adoptable',
  );
  $attributes = shortcode_atts($default_attributes, $atts);
  extract($attributes);
  include(SHELTER_MANAGER_PLUGIN . '/includes/templates/animal-details.php');

  return ob_get_clean();
}
add_shortcode('shelter_manager_animal_details', 'shelter_manager_animal_details');

function shelter_manager_animal_adoption_form($atts)
{
  ob_start();

  $default_attributes = array(
    'class' => '',
    'animal_id' => 'all',
    'success_message' => 'Thank you for your submission!',
    'error_message' => 'There was an error submitting your form. Please try again.',
  );
  $attributes = shortcode_atts($default_attributes, $atts);
  extract($attributes);
  include(SHELTER_MANAGER_PLUGIN . '/includes/templates/animal-adoption-form.php');

  return ob_get_clean();
}
add_shortcode('shelter_manager_animal_adoption_form', 'shelter_manager_animal_adoption_form');

function shelter_manager_animal_page($atts)
{
  ob_start();

  $default_attributes = array(
    'class' => '',
    'animal_id' => 'all',
    'type' => 'adoptable',
    'limit' => 12,
    'title' => '',
    'offset' => 0,
    'success_message' => 'Thank you for your submission!',
    'error_message' => 'There was an error submitting your form. Please try again.',
  );
  $attributes = shortcode_atts($default_attributes, $atts);
  extract($attributes);
  include(SHELTER_MANAGER_PLUGIN . '/includes/templates/animals-page.php');

  return ob_get_clean();
}
add_shortcode('shelter_manager_animal_page', 'shelter_manager_animal_page');
