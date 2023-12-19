<?php
function ajax_get_animal_json_by_id()
{
  $id = $_POST['id'];
  $type = $_POST['type'];

  if (!$type) {
    $type = 'shelter';
  }

  if (!$id) {
    $response = ['error' => true, 'message' => 'No id provided.', 'data' => null];
  } else {
    $response = get_animal_json_by_id($id, $type);
  }

  wp_send_json(json_encode($response));
}
add_action('wp_ajax_ajax_get_animal_json_by_id', 'ajax_get_animal_json_by_id');
add_action('wp_ajax_nopriv_ajax_get_animal_json_by_id', 'ajax_get_animal_json_by_id');

function ajax_get_animals_json_by_type()
{
  $type = $_POST['type'];
  $limit = $_POST['limit'];
  $filter = $_POST['filter'];

  if (!$type) {
    $type = 'adoptable';
  }

  if (!$limit) {
    $limit = -1;
  }

  if (!$filter) {
    $filter = ['all', 'all'];
  }

  $response = get_animals_json_by_type($type, $limit, $filter);

  wp_send_json(json_encode($response));
}
add_action('wp_ajax_ajax_get_animals_json_by_type', 'ajax_get_animals_json_by_type');
add_action('wp_ajax_nopriv_ajax_get_animals_json_by_type', 'ajax_get_animals_json_by_type');

function ajax_get_animal_image_by_id()
{
  $id = $_POST['id'];
  $image_id = $_POST['image_id'];

  if (!$image_id) {
    $image_id = 1;
  }

  if (!$id) {
    $response = ['error' => true, 'message' => 'No id provided.', 'data' => null];
  } else {
    $response = get_animal_image_by_id($id, $image_id);
  }

  wp_send_json(json_encode($response));
}
add_action('wp_ajax_ajax_get_animal_image_by_id', 'ajax_get_animal_image_by_id');
add_action('wp_ajax_nopriv_ajax_get_animal_image_by_id', 'ajax_get_animal_image_by_id');

function ajax_get_animal_adoption_form_submission_response()
{
  $data = $_POST['data'];
  // $file = $_FILES['signature'];
  $response = ['error' => true, 'message' => 'No data provided.', 'data' => null];

  if (!$data) {
    wp_send_json(json_encode($response));
    return;
  }

  $data = json_decode(stripslashes($data));

  // if ($file) {
  //   $upload_file_response = upload_adoption_form_signature($file, $data);

  //   if ($upload_file_response['error']) {
  //     wp_send_json(json_encode($upload_file_response));
  //     return;
  //   }

  //   $data->signature_1915 = $upload_file_response['data'];
  // }

  $create_post_response = create_adoption_form_submission_post($data);

  if ($create_post_response['error']) {
    wp_send_json(json_encode($create_post_response));
    return;
  }

  // if ($file) {
  //   $data->signature_1915 = str_replace(
  //     '/srv/htdocs',
  //     'https://savingsoulsrescue.org',
  //     $data->signature_1915
  //   );
  // }

  $upload_response = upload_animal_adoption_form_data_to_shelter_manager($data);

  if ($upload_response['error']) {
    wp_send_json(json_encode($upload_response));
    return;
  }

  $response = ['error' => false, 'message' => 'Success!', 'data' => json_encode($upload_response['data'])];

  wp_send_json(json_encode($response));
}
add_action('wp_ajax_ajax_get_animal_adoption_form_submission_response', 'ajax_get_animal_adoption_form_submission_response');
add_action('wp_ajax_nopriv_ajax_get_animal_adoption_form_submission_response', 'ajax_get_animal_adoption_form_submission_response');
