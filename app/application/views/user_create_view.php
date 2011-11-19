<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Register new User</title>
</head>

<body>
<h3>Register new User</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('user/index'); ?>

<p>
<label for="name">Name*:</label>
<input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>"/>
</p>

<p>
<label for="password">Password*:</label>
<input type="text" name="password" id="password" value="<?php echo set_value('password'); ?>"/>
</p>

<p>
<label for="confirm">Confirm*:</label>
<input type="text" name="confirm" id="confirm" value="<?php echo set_value('confirm'); ?>"/>
</p>

<p>
<label for="email">Email*:</label>
<input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>"/>
</p>

<p>
<input type="submit" value="Register"/> <input type="reset" value="Reset fields"/>
</p>
*: Indicates a requiered field.
<a href="<?php echo siteurl(array('user', 'view')); ?>">View current Users</a>
</body>
</html>