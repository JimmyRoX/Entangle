<html>
<head>
<title>Login successful</title>
</head>
<body>

<h3>Welcome <?php echo $this->session->userdata('username'); ?>, you were successfully logged in!</h3>
<p>
<?php echo anchor('/','Go to index'); ?>
</p>
</body>
</html>