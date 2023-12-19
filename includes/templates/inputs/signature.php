<?php
if (!defined('ABSPATH')) {
  die("Access Denied");
}

$class_name = 'form-field shelter-manager-grid input-' . $input_type;
$required = $input_required ? true : false;
$required_string = $required ? 'required="true"' : '';
$error_message = $input_error_message ? $input_error_message : 'Please enter a valid ' . $input_label;
?>
<div class='<?php echo $class_name; ?>'>
  <label for='<?php echo $input_name; ?>'><?php echo $input_label; ?></label>
  <canvas width="400" height="200" data-drawing='false' data-last_x='0' data-last_y='0' onmousedown="handleShelterManagerSignatureInputMouseDown(event)" onmousemove='handleShelterManagerSignatureInputDraw(event)' onmouseup='handleShelterManagerSignatureInputMouseUp(event)' onmouseout='handleShelterManagerSignatureInputMouseOut(event)'></canvas>
  <input data-type='<?php echo $input_type; ?>' type="file" name="<?php echo $input_name; ?>" id="<?php echo $input_id; ?>" <?php echo $required_string; ?> />
  <button class='button-clear' onclick="handleShelterManagerSignatureInputClear(event)">Clear Signature</button>
  <div class="error-message"><?php echo $error_message; ?></div>
</div>