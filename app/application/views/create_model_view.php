<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create Model</title>
</head>
<body>

<div id="container">
	<h1>Create Model</h1>

	<div id="body">
		<?php echo form_open('model/add') ?>
			<input  type="text" name="name" id="name" />
			<input  type="submit" value="Submit"/>
		<?php echo form_close(); ?>
	</div>

</div>

</body>
</html>
