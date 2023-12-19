<?php
function display_adoption_submission_meta_box()
{
  $post_meta = get_post_meta(get_the_ID());

  echo '<ul>';
  foreach ($post_meta as $key => $value) {
    if ($key === 'signature') {
      echo '<li><b>' . $key . '</b>:<br /><img src="' . $value[0] . '" /></li>';
    } else if ($key === '_edit_lock') {
      continue;
    } else {
      echo '<li><b>' . $key . '</b>:' . $value[0] . '</li>';
    }
  }
  echo '</ul>';
}

function upload_adoption_form_signature($file, $data)
{
  $response = ['error' => true, 'message' => 'No data provided.', 'data' => null];

  if (!$data) {
    return $response;
  }

  if (!$file) {
    return $response;
  }

  $uploadDir = SHELTER_MANAGER_PLUGIN . 'uploads/';
  $user_name = $data->firstname_1884 . '-' . $data->lastname_1885 . '-' . $data->email_1890;
  $uploadPath = $uploadDir . uniqid() . '-' . $user_name . '-' . basename($file['name']);

  if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
    $response['message'] = 'Failed to upload data.';
    return $response;
  }

  $response = ['error' => false, 'message' => 'Success', 'data' => str_replace('/var/www/html', home_url(), $uploadPath)];

  return $response;
}

function create_adoption_form_submission_post($data)
{
  $response = ['error' => true, 'message' => 'No data provided.', 'data' => null];

  if (!$data) {
    return $response;
  }

  $user_name = $data->formname . '-' . $data->firstname_1884 . '-' . $data->lastname_1885 . ' (' . $data->emailaddress_1890 . ')';
  $arguments = [
    'post_title' => $user_name,
    'post_status' => 'publish',
    'post_type' => 'sm-forms',
  ];
  $post_id = wp_insert_post($arguments);

  if (!$post_id) {
    $response['message'] = 'Failed to upload data.';
    $response['data'] = $user_name;
    return $response;
  }

  $create_post_meta_response = create_adoption_form_submission_post_meta($post_id, $data, ['method', 'account', 'redirect', 'retainfor', 'flags']);

  if ($create_post_meta_response['error']) {
    $response['message'] = 'Failed to add post data.';
    return $response;
  }

  $response = ['error' => false, 'message' => 'Success!', 'data' => $post_id];

  return $response;
}

function create_adoption_form_submission_post_meta($post_id, $data, $ignore_inputs)
{
  $response = ['error' => true, 'message' => 'No data provided.', 'data' => null];

  if (!$data) {
    return $response;
  }

  if (!$post_id) {
    $response['message'] = 'No post id provided.';
    return $response;
  }

  if (!$ignore_inputs) {
    $ignore_inputs = [];
  }

  foreach ($data as $key => $value) {
    if (in_array($key, $ignore_inputs)) {
      continue;
    }

    add_post_meta($post_id, $key, $value);
  }

  $response = ['error' => false, 'message' => 'Success!', 'data' => $post_id];

  return $response;
}

function generate_shelter_manager_form_input($input)
{
  $input_type = $input['type'];
  $input_value = $input['value'];
  $input_name = $input['name'];
  $input_id = $input['id'];
  $input_placeholder = $input['placeholder'];
  $input_label = $input['label'];
  $input_options = $input['options'];
  $input_inputs = $input['inputs'];
  $input_conditional = $input['conditional'];
  $input_introduction_copy = $input['introduction_copy'];
  $input_required = $input['required'];
  $input_error_message = $input['error_message'];

  if ($input_type == 'hidden') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/hidden.php');
  } else if ($input_type == 'text') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/text.php');
  } else if ($input_type == 'textarea') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/textarea.php');
  } else if ($input_type == 'select') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/select.php');
  } else if ($input_type == 'checkbox') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/checkbox.php');
  } else if ($input_type == 'number') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/number.php');
  } else if ($input_type == 'multi-complex') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/multi-complex.php');
  } else if ($input_type == 'true-false') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/true-false.php');
  } else if ($input_type == 'signature') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/signature.php');
  } else if ($input_type == 'postcode') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/postcode.php');
  } else if ($input_type == 'date') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/date.php');
  } else if ($input_type == 'phonenumber') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/phone-number.php');
  } else if ($input_type == 'email') {
    include(SHELTER_MANAGER_PLUGIN . '/includes/templates/inputs/email.php');
  }
}
