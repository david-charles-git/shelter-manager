<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

$class_name = 'form-field shelter-manager-grid input-' . $input_type;
$required_string = $required ? 'required="true"' : '';
?>
<div class='<?php echo $class_name; ?>'>
  <input data-type='<?php echo $input_type; ?>' type='<?php echo $input_type; ?>' id='<?php echo $input_id; ?>' name='<?php echo $input_name; ?>' value='<?php echo $input_value; ?>' <?php echo $required_string; ?> />
</div>