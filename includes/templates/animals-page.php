<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

if (isset($_GET['sm_animal_id'])) {
  $animal_id = $_GET['sm_animal_id'];
} else if (!isset($animal_id)) {
  $animal_id = 'all';
} else if (!$animal_id) {
  $animal_id = 'all';
}

if (isset($_GET['sm_type'])) {
  $type = $_GET['sm_type'];
} else if (!isset($type)) {
  $type = 'adoptable';
} else if (!$type) {
  $type = 'adoptable';
}

if (!isset($limit)) {
  $limit = 12;
} else if (!$limit) {
  $limit = 12;
}
$limit = intval($limit);

if (!isset($class)) {
  $class = '';
} else if (!$class) {
  $class = '';
}

if (!isset($title)) {
  $title = '';
} else if (!$title) {
  $title = '';
}

if (!isset($success_message)) {
  $success_message = 'Thank you for your submission!';
} else if (!$success_message) {
  $success_message = 'Thank you for your submission!';
}

if (!isset($error_message)) {
  $error_message = 'There was an error submitting your form. Please try again.';
} else if (!$error_message) {
  $error_message = 'There was an error submitting your form. Please try again.';
}

if (!isset($_GET['offset'])) {
  $offset = $_GET['offset'];
} else if (!isset($offset)) {
  $offset = 0;
} else if (!$offset) {
  $offset = 0;
}
$offset = intval($offset);
?>
<div class="shelter-manager-animal-page <?php echo $class; ?>" data-id="<?php echo $animal_id; ?>">
  <div class='inner shelter-manager-grid'>
    <?php
    if (!$animal_id || $animal_id == 'all') {
      echo do_shortcode('[shelter_manager_animal_feed type="' . $type . ' limit="' . $limit . '"]');
      echo do_shortcode('[shelter_manager_animal_adoption_form]');
    } else {
      echo do_shortcode('[shelter_manager_animal_details animal_id="' . $animal_id . '" type="' . $type . '"]');
      echo do_shortcode('[shelter_manager_animal_adoption_form animal_id="' . $animal_id . '"]');
    }
    ?>
  </div>
</div>