<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

get_header();

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
?>
<main>
  <?php
  get_template_part('template-parts/content', 'page');
  echo do_shortcode('[shelter_manager_animal_page]');
  ?>
</main>
<?php
get_footer();
?>