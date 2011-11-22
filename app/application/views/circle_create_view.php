<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Create a new Circle</title>
</head>

<body>
<h3>Create a new Circle</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('circle/index'); ?>

<p>
<label for="name">Name*:</label>
<input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>"/>
</p>

<p>
<label for="modelname">Model Name*:</label>
<input type="text" name="modelname" id="modelname" value="<?php echo set_value('modelname'); ?>"/>
</p>

<p>
<label for="adminname">Administrator Name*:</label>
<input type="text" name="adminname" id="adminname" value="<?php echo set_value('adminname'); ?>"/>
</p>

<p>
<input type="submit" value="Create"/> <input type="reset" value="Reset fields"/>
</p>
*: Indicates a required field.
</body>
</html>