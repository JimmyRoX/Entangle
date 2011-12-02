<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Register new User</title>
</head>

<body>
<div id="signup_form">
<h3>Register new User</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('user/signup'); ?>

<p>
<label for="name">Name*:</label>
<input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>"/>
</p>

<p>
<label for="password">Password*:</label>
<input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>"/>
</p>

<p>
<label for="confirm">Confirm*:</label>
<input type="password" name="confirm" id="confirm" value="<?php echo set_value('confirm'); ?>"/>
</p>

<p>
<label for="email">Email*:</label>
<input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>"/>
</p>

<p>
 <?php echo form_submit('submit','Register new account'); ?> <input type="reset" value="Reset fields"/>
</p>
*: Indicates a requiered field.
<?php echo form_close(); ?>
</div>
</body>
</html>