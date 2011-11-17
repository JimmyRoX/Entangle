<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Crear nuevo Usuario</title>
</head>

<body>
<h2>Create</h2>
<?php echo form_open('user/create'); ?>

<p>
<label for="title">Name:</label>
<input type="text" name="title" id="title"/>
</p>

<p>
<label for="password">Password:</label>
<input type="text" name="password" id="password"/>
</p>

<p>
<label for="email">Email:</label>
<input type="text" name="email" id="email"/>
</p>

<p>
<input type="submit" value="Register"/>
</p>

<?php echo form_close(); ?>

</body>
</html>