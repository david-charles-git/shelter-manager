<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function load_carbon_fields()
{
  \Carbon_Fields\Carbon_Fields::boot();
}
add_action('after_setup_theme', 'load_carbon_fields');

function create_options_page()
{
  $options_page_name = 'Shelter Manager';
  $options_page_icon = 'dashicons-pets';
  $options_page_fields = array(
    Field::make('hidden', 'shelter_manager_shortcode_information', __('Shelter Manager Shortcode Information'))
      ->set_default_value('')
      ->set_help_text('<b>[shelter_manager_auto_generated_adoptable_feed] - </b>
      This shortcode will generate the default Shelter Manager Adoptable Animals Feed.
      <br />
      <br />
      <b>[shelter_manager_animal_feed type="[TYPE]" class="[CLASS]"] - </b>
      This shortcode will generate a Shelter Manager Animals Feed based on the type provided. The type can be: "shelter" (default), "adoptable", "found", "held", "lost", "recently_adopted", "recently_changed". The class is optional and can be used to add a custom class to the feed.
      <br />
      <br />
      <b>[shelter_manager_animal_details id="[ID]" type="[TYPE]" class="[CLASS]"] - </b>
      This shortcode will generate the details for a specific animal based on the id provided. The class is optional and can be used to add a custom class to the details. The type is optional and can be used to change the type of animal details displayed. The type can be: "shelter" (default), "adoptable", "found", "held", "lost", "recently_adopted", "recently_changed".
      ')
      ->set_width(100),
    Field::make('hidden', 'shelter_manager_js_functions_information', __('Shelter Manager JS Functions Information'))
      ->set_default_value('')
      ->set_help_text('<b>There are two types of response, Response: { error: boolean, message: string, data: Animal | Animal[] | null }, ImageResponse: { error: boolean, message: string, data: string | null }</b>
      <br />
      <br />
      <b>getShelterManagerAnimalJsonById: (id: string, type: string, callback: (response: Response) => any, error: (response: Response) => any) => void - </b>
      This function will return the details for a specific animal based on the id provided. It also take a callback and error function as optional parameters. The callback will be called if the response is successful and the error function will be called if the response is unsuccessful, both being passed the response. The type is optional and can be used to change the type of animal details displayed. The type can be: "shelter" (default), "adoptable", "found", "held", "lost", "recently_adopted", "recently_changed".
      <br />
      <br />
      <b>getShelterManagerAnimalsJsonByType: (type: string, callback: (response: Response) => any, error: (response: Response) => any) => void - </b>
      This function will return the JSON for a Shelter Manager Animals Feed based on the type provided. The type can be: "shelter" (default), "adoptable", "found", "held", "lost", "recently_adopted", "recently_changed". It also take a callback and error function as optional parameters. The callback will be called if the response is successful and the error function will be called if the response is unsuccessful, both being passed the response.
      <br />
      <br />
      <b>getShelterManagerAnimalImageById: (id: string, imageId?: string, callback: (response: ImageResponse) => any, error: (response: ImageResponse) => any) => void - </b>
      This function will return the image uri for a specific animal based on the id provided. The imageId (default: 1) is optional and can be used to get a specific image for the animal. It also take a callback and error function as optional parameters. The callback will be called if the response is successful and the error function will be called if the response is unsuccessful, both being passed the response.
      ')
      ->set_width(100),
    Field::make('hidden', 'shelter_manager_page_information', __('Shelter Manager Page Information'))
      ->set_default_value('')
      ->set_help_text('A page is created to host the Shelter Manager Animal Feed. The slug for this page can be changed below.
      <br />
      <br /> 
      To create the page for the animals navigate to the <a href="' . home_url() . '/wp-admin/post-new.php?post_type=page'  . '">pages menu</a>, and create a new page with the slug: <b>' . home_url() . '/[Shelter Manager Animal Page Slug]</b>.
      <br />
      <br /> 
      Make sure the permalinks are set to "Post name" in the <a href="' . home_url() . '/wp-admin/options-permalink.php'  . '">permalinks menu</a>.
      <br />
      <br />
      The url also can take the follow parameters:
      <br />
      <b>type: string</b> - This will display a Shelter Manager Animals Feed based on the type provided. The type can be: "shelter" (default), "adoptable", "found", "held", "lost", "recently_adopted", "recently_changed".
      <br />
      <b>animal_id: string</b> - This will display the details for a specific adoptable animal based on the id provided.
      ')
      ->set_width(100),
    Field::make('text', 'shelter_manager_api_account', __('Shelter Manager API Account ID'))
      ->set_default_value('')
      ->set_help_text('Enter the account ID for the Shelter Manager API')
      ->set_width(25),
    Field::make('text', 'shelter_manager_api_username', __('Shelter Manager API Username'))
      ->set_default_value('')
      ->set_help_text('Enter the username for the Shelter Manager API')
      ->set_width(25),
    Field::make('text', 'shelter_manager_api_password', __('Shelter Manager API Password'))
      ->set_default_value('')
      ->set_help_text('Enter the password for the Shelter Manager API')
      ->set_width(25),
    Field::make('text', 'shelter_manager_animal_page_slug', __('Shelter Manager Animal Page Slug'))
      ->set_default_value('animals')
      ->set_help_text('Enter the slug for the Shelter Manager Animal Page')
      ->set_width(25),
    Field::make('text', 'shelter_manager_form_name', __('Shelter Manager Form Name'))
      ->set_default_value('0')
      ->set_help_text('Enter the name for the Shelter Manager form')
      ->set_width(25),
  );

  Container::make('theme_options', __($options_page_name))
    ->add_fields($options_page_fields)
    ->set_icon($options_page_icon);
}
add_action('carbon_fields_register_fields', 'create_options_page');

function create_animal_adoption_form_submission_page()
{
  $arguments = [
    'public' => true,
    'labels' => [
      "name" => "SM - forms",
      "singular_name" => "SM - form",
      "menu_name" => "SM - forms",
    ],
    'menu_icon' => 'dashicons-pets',
    'has_archive' => true,
    'capability_type' => 'post',
    'capabilities' => [
      // 'create_posts' => false,
    ],
    'supports' => false, //[
    // 'title',
    // 'content',
    // 'custom_fields',
    // ]
  ];

  register_post_type('sm-forms', $arguments);
}
add_action('init', 'create_animal_adoption_form_submission_page');

function create_adoption_submission_meta_box()
{
  add_meta_box('sm-forms', 'Adoption Submission', 'display_adoption_submission_meta_box', 'sm-forms');
}
add_action('add_meta_boxes', 'create_adoption_submission_meta_box');
