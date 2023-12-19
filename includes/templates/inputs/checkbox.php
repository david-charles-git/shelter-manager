<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

$class_name = 'form-field shelter-manager-grid input-' . $input_type;
$data_conditionals = [];
$required = $input_required ? true : false;
$input_label = $required ? $input_label . '<sup class="required">*</sup>' : $input_label;
$on_click = $input_conditional['type'] == 'handler' ? 'handleShelterManagerInputChange(event, "checkbox", handleShelterManagerInputConditional)' : 'handleShelterManagerInputChange(event, "checkbox")';
$required_string = $required ? 'required="true"' : '';
$input_error_message = $input_error_message ? $input_error_message : 'This field is required.';

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
<div class="<?php echo $class_name; ?>" data-conditions='<?php echo $data_conditionals; ?>'>
  <input data-type='<?php echo $input_type; ?>' type='hidden' name='<?php echo $input_name; ?>' id='<?php echo $input_id; ?>' value='<?php echo $input_value; ?>' <?php echo $required_string; ?> />

  <label><?php echo $input_label; ?></label>

  <div class="checkbox-group shelter-manager-grid">
    <?php
    foreach ($input_options as $option) {
    ?>
      <div class="checkbox <?php echo $option['value'] == $input_value ? 'active' : ''; ?>" onclick="<?php echo $on_click; ?>" data-value='<?php echo $option['value']; ?>'>
        <span></span>
        <label><?php echo $option['label']; ?></label>
      </div>
    <?php
    }
    ?>
  </div>
  <div class="error-message"><?php echo $input_error_message; ?></div>
</div>