<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

$class_name = 'form-field shelter-manager-grid input-' . $input_type;
$data_conditionals = [];
$required = $input_required ? true : false;
$input_label = $required ? $input_label . '<sup class="required">*</sup>' : $input_label;
$on_change = $input_conditional['type'] == 'handler' ? 'handleShelterManagerInputChange(event, "select", handleShelterManagerInputConditional)' : 'handleShelterManagerInputChange(event, "select")';
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
  <label for="<?php echo $input_name; ?>"><?php echo $input_label; ?></label>
  <select data-type='<?php echo $input_type; ?>' name="<?php echo $input_name; ?>" id="<?php echo $input_id; ?>" onchange="<?php echo $on_change; ?>" <?php echo $required_string; ?>>
    <?php
    foreach ($input_options as $option) {
    ?>
      <option value="<?php echo $option['value']; ?>"><?php echo $option['label']; ?></option>
    <?php
    }
    ?>
  </select>
  <div class="error-message"><?php echo $input_error_message; ?></div>
</div>