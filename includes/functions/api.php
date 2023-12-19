<?php
function get_api_response_by_uri($api_uri)
{
  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, $api_uri);
  curl_setopt(
    $curl,
    CURLOPT_RETURNTRANSFER,
    true
  );
  curl_setopt($curl, CURLOPT_HTTPGET, true);

  $response = curl_exec($curl);

  if (curl_errno($curl)) {
    $response = false;
  } else {
    $response = array(
      "error" => false,
      "message" => 'Success',
      "data" => $response
    );
  }

  curl_close($curl);
  return $response;
}

function get_animal_json_by_id($id, $type)
{
  if (!$id || $id == 'all') {
    $response = array(
      "error" => true,
      "message" => 'No id provided.',
      "data" => null
    );
    return $response;
  }

  if (!$type) {
    $type = 'shelter';
  }

  $animals = get_animals_json_by_type($type, 1, ['all', 'all']);

  if ($animals['error']) {
    return $animals;
  }

  $animals = json_decode($animals['data']);
  $response = array(
    "error" => true,
    "message" => 'Animal not found.',
    "data" => null
  );

  if (!$animals || count($animals) == 0) {
    return $response;
  }

  foreach ($animals as $animal) {
    if ($animal->ID == $id) {
      $response = array(
        "error" => false,
        "message" => 'Success',
        "data" => json_encode($animal)
      );
      break;
    }
  }

  return $response;
}

function get_animal_image_by_id($id, $image_number)
{
  $response = array(
    "error" => true,
    "message" => 'No id provided.',
    "data" => null
  );

  if (!$id || $id == 'all') {
    return $response;
  }

  if (!$image_number) {
    $image_number = 1;
  }

  $plugin_options = get_shelter_manager_options();
  $api_uri = $plugin_options['api_image_uri'] . $id . '&seq=' . $image_number;
  $response = array(
    "error" => false,
    "message" => 'Success',
    "data" => $api_uri
  );
  return $response;
}

function get_api_method($type)
{
  if ($type == 'adoptable') {
    return 'json_adoptable_animals';
  } else if ($type == 'found') {
    return 'json_found_animals';
  } else if ($type == 'held') {
    return 'json_held_animals';
  } else if ($type == 'lost') {
    return 'json_lost_animals';
  } else if ($type == 'shelter') {
    return 'json_shelter_animals';
  } else if ($type == 'recently_adopted') {
    return 'json_recent_adoptions';
  } else if ($type == 'recently_changed') {
    return 'json_recent_changes';
  } else {
    return 'json_shelter_animals';
  }
}

function get_filtered_animals($animals, $limit, $filter)
{
  if (!$animals) {
    return $animals;
  }

  if (!$limit) {
    $limit = -1;
  }

  if (!$filter) {
    $filter = ['all', 'all'];
  }

  if ($filter[0] != 'all') {
    $animals = array_filter($animals, function ($animal) use ($filter) {
      if ($filter[0] == 'ANIMALAGE') {
        $value = $animal->ANIMALAGE;
        $group = '';
        if (strpos($value, 'weeks') !== false) {
          $group = 'under-1-year';
        } else if (strpos($value, 'months') !== false && strpos($value, 'years') !== false) {
          $group = 'under-1-year';
        } else if (strpos($value, 'years') !== false) {
          $parsedYears = intVal(explode(' ', $value)[0]);

          if ($parsedYears >= 1 && $parsedYears <= 3) {
            $group = '1-3-years';
          } else if ($parsedYears > 3) {
            $group = 'over-3-years';
          }
        }

        if ($group == $filter[1]) {
          return true;
        }
      } else if ($filter[0] == 'SEX') {
        $value = intval($animal->SEX);

        if ($filter[1] === 'Female' && $value === 0) {
          return true;
        } else if ($filter[1] === 'Male' && $value === 1) {
          return true;
        }
      } else if ($filter[0] == 'ISGOODWITHCATSNAME') {
        $value = $animal->ISGOODWITHCATSNAME;

        if ($filter[1] === 'Yes' && $value === 'yes') {
          return true;
        }
      } else if ($filter[0] == 'ISGOODWITHDOGSNAME') {
        $value = $animal->ISGOODWITHDOGSNAME;

        if ($filter[1] === 'Yes' && $value === 'yes') {
          return true;
        }
      } else if ($filter[0] == 'ISGOODWITHCHILDRENNAME') {
        $value = $animal->ISGOODWITHCHILDRENNAME;

        if ($filter[1] === 'Yes' && $value === 'yes') {
          return true;
        }
      } else if ($filter[0] == 'NEEDSRESIDENTDOG') {
        $value = $animal->NEEDSRESIDENTDOG;

        if ($filter[1] === 'Yes' && $value === 'yes') {
          return true;
        }
      } else if ($filter[0] == 'SHELTERLOCATION') { //in the uk
        $value = $animal->SHELTERLOCATION;

        if ($filter[1] === 'Yes' && ($value === '19' || $value === '20')) {
          return true;
        }
      } else if ($filter[0] == 'DATEBROUGHTIN') {
        $value = $animal->DATEBROUGHTIN;

        if ($filter[1] === 'Yes' && ($value === '19' || $value === '20')) {
          return true;
        }

        $value_as_date = DateTime::createFromFormat('d/m/Y', $value);
        $date = new DateTime();
        $interval = $date->diff($value_as_date);
        if ($interval >= intVal($filter[1])) {
          return true;
        }
      }
    });
  }

  if ($limit > 0) {
    $animals = array_slice($animals, 0, $limit);
  }

  return $animals;
}

function get_animals_json_by_type($type, $limit, $filter)
{
  if (!$type) {
    $type = 'shelter';
  }

  if (!$limit) {
    $limit = -1;
  }

  if (!$filter) {
    $filter = ['all', 'all'];
  }

  $plugin_options = get_shelter_manager_options();
  $api_method = get_api_method($type);
  $api_uri = $plugin_options['api_uri'] . '&method=' . $api_method;
  $animals = get_api_response_by_uri($api_uri);

  if ($animals['error']) {
    return $animals;
  }

  $animals = json_decode($animals['data']);
  $animals = get_filtered_animals($animals, $limit, $filter);
  $animals = json_encode($animals);
  $animals = array(
    "error" => false,
    "message" => 'Success',
    "data" => $animals
  );

  return $animals;
}

function upload_animal_adoption_form_data_to_shelter_manager($data)
{
  if (!$data) {
    $response = array(
      "error" => true,
      "message" => 'No data provided.',
      "data" => null
    );
    return $response;
  }

  $options = get_shelter_manager_options();
  $api_uri = $options['api_base_uri'];
  $account_id = $options['api_account'];
  $method = $data->method;
  $formname = $data->formname;
  $api_uri = $api_uri . 'method=' . $method . '&account=' . $account_id . '&formname=' . $formname;
  $string = '';
  $ignore_fields = ['method', 'account', 'formname'];

  foreach ($data as $key => $value) {
    if (in_array($key, $ignore_fields)) {
      continue;
    }

    $string .= $key . '=' . $value . '&';
  }

  $string = rtrim($string, '&');
  $api_uri = $api_uri . '&' . $string;
  $api_uri = str_replace(' ', '%20', $api_uri);
  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, $api_uri);
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt(
    $curl,
    CURLOPT_RETURNTRANSFER,
    true
  );
  curl_exec($curl);

  if (curl_errno($curl)) {
    $response =
      array(
        "error" => true,
        "message" => curl_error($curl),
        "data" => $api_uri
      );
  } else {
    $response = array(
      "error" => false,
      "message" => 'Success',
      "data" => json_encode(['string' => $string])
    );
  }

  curl_close($curl);
  return $response;
}
