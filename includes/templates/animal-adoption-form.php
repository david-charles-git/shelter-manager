<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

$form_groups = get_animal_adoption_form_groups();
$options = get_shelter_manager_options();
$form_name = $options['api_form_name'];
$account_id = $options['api_account'];

if (!$account_id) {
  echo 'Please enter an account ID in the options page.';
  return;
} else if (!$form_name) {
  echo 'Please enter a form name in the options page.';
  return;
}

if (isset($_GET['sm_animal_id'])) {
  $animal_id = $_GET['sm_animal_id'];
} else if (!isset($animal_id)) {
  $animal_id = 'all';
} else if (!$animal_id) {
  $animal_id = 'all';
}

if (!isset($class)) {
  $class = '';
} else if (!$class) {
  $class = '';
}

if (!isset($success_message)) {
  $success_message = 'Thank you for submitting your form. We will be in touch shortly.';
} else if (!$success_message) {
  $success_message = 'Thank you for submitting your form. We will be in touch shortly.';
}

if (!isset($error_message)) {
  $error_message = 'There was an error submitting your form. Please try again.';
} else if (!$error_message) {
  $error_message = 'There was an error submitting your form. Please try again.';
}

if ($animal_id != 'all') {
  $animal = get_animal_json_by_id($animal_id, 'adoptable');

  if ($animal['error']) {
    echo $animal['message'];
    return;
  }

  $animal = json_decode($animal['data'], true);
  $shelter_code = $animal['SHELTERCODE'];
  $animal_name = $animal['ANIMALNAME'];
}
?>
<section class='shelter-manager-animal-adoption-form <?php echo $class; ?>' data-id='<?php echo $animal_id; ?>'>
  <div class='inner shelter-manager-grid'>
    <div class='form-header shelter-manager-grid'>
      <?php
      if ($animal_id != 'all') {
      ?>
        <h2>Adoption Application Form:<?php echo $animal_name . ' - ' . $shelter_code; ?></h2>
      <?php
      } else {
      ?>
        <h2>Adoption Application Form</h2>
      <?php
      }
      ?>
      <p>Please complete the form below to apply for adoption of a dog from Saving Souls Animal Rescue.</p>
    </div>

    <div class='form-content shelter-manager-grid'>
      <form id='shelter-manager-animal-adoption-form' class='form shelter-manager-grid <?php echo $class; ?>' enctype="multipart/form-data">
        <div class="form-field shelter-manager-grid input-hidden">
          <input type="hidden" id="flags" name="flags" value="">
          <input type="hidden" id="redirect" name="redirect" value="">
          <input type="hidden" id="retainfor" name="retainfor" value="0">
          <input type="hidden" name="formname" value="<?php echo $form_name; ?>" required>
          <input type="hidden" id='method' name="method" value="online_form_post" required>
          <input type="hidden" id='account' name="account" value="<?php echo $account_id; ?>" required>
          <?php
          if ($animal_id == 'all') {
          ?>
            <input type="hidden" id="reserveanimalname" name="reserveanimalname_1883" value="<?php echo $animal_name . '::' . $shelter_code; ?>" required>
          <?php
          } else {
          ?>
            <input type="hidden" id="reserveanimalname" name="reserveanimalname_1883" value="<?php echo $animal_name . '::' . $shelter_code; ?>" required>
          <?php
          }
          ?>
        </div>

        <div class="loading-container">
          <p>Loading...</p>
        </div>

        <div class='error-container'>
          <p><?php echo $error_message; ?></p>
          <button class='button-reset' onclick="handleShelterManagerFormReset(event)">Reset</button>
        </div>

        <div class='success-container'>
          <p><?php echo $success_message; ?></p>
        </div>

        <?php
        $for_count = 0;
        foreach ($form_groups as $form_group) {
          $input_class = $for_count == 0 ? 'active' : '';
          echo '<div class="form-group ' . $input_class . '">';

          foreach ($form_group as $form_input) {
            generate_shelter_manager_form_input($form_input);
          }

          echo '</div>';

          $for_count++;
        }

        $button_grid_columns = $for_count > 1 ? 'grid-template-columns: repeat(3, auto);' : 'grid-template-columns: repeat(2, auto);';
        ?>
        <div class="form-buttons shelter-manager-grid" style="<?php echo $button_grid_columns; ?>">
          <?php
          if ($for_count > 1) {
          ?>
            <button class='button-previous' onclick="handleShelterManagerFormNavigation(event, 'previous')">Previous</button>
            <button class='button-next active' onclick="handleShelterManagerFormNavigation(event, 'next')">Next</button>
            <button class='button-submit' onclick="handleShelterManagerFormSubmit(event)">Submit</button>
          <?php
          } else {
          ?>
            <button class='button-submit active' onclick="handleShelterManagerFormSubmit(event)">Submit</button>
          <?php
          }
          ?>
        </div>
      </form>
    </div>
  </div>
</section>