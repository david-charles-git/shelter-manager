<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

$class_name = 'form-field shelter-manager-grid input-' . $input_type;
$data_conditionals = [];
$required = $input_required ? true : false;
$input_label = $required ? $input_label . '<sup class="required">*</sup>' : $input_label;
$on_blur = $input_conditional['type'] == 'handler' ? 'handleShelterManagerInputChange(event, "text", handleShelterManagerInputConditional)' : 'handleShelterManagerInputChange(event, "text")';
$required_string = $required ? 'required="true"' : '';
$multi_input_error_message = $input_error_message  ? $input_error_message  : 'This field is required.';

if ($input_conditional['type'] == 'handler') {
  $class_name .= ' conditional-handler';
  $data_conditionals = $input_conditional['conditions'];
} else if ($input_conditional['type'] == 'target') {
  $class_name .= ' conditional shelter-manager-hidden';
}

if ($input_introduction_copy) {
?>
  <p><?php echo $input_introduction_copy; ?></p>
<?php
}
?>
<div class='<?php echo $class_name; ?>' data-conditions='<?php echo $data_conditionals; ?>'>
  <input data-type='<?php echo $input_type; ?>' type='hidden' name='<?php echo $input_name; ?>' id='<?php echo $input_id; ?>' value='<?php echo $input_value; ?>' <?php echo $required_string; ?> />

  <label><?php echo $input_label; ?></label>

  <div class='multi-input-values shelter-manager-grid'></div>

  <div class="multi-input-inputs shelter-manager-grid">
    <div class='multi-input shelter-manager-grid'>
      <?php foreach ($input_inputs as $input) {
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
      ?>
    </div>
  </div>

  <button class='addition-button' onclick="handleShelterManagerFormMultiInputAdd(event)">Add</button>
  <div class='error-message'><?php echo $multi_input_error_message; ?></div>
</div>