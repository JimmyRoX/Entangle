<!DOCTYPE html>
<html>
<head>
<title>List of current Users</title>
</head>
<body>
<?php if(count($documents) > 0):
foreach($documents as $document => $vars): ?>
<h1>
<p>
<?php echo $vars['name']; ?></p>
</h1>
 <?php $vars['email'] ); ?>  
<hr />
<?php endforeach;
endif; ?>
<p>
<a href="<?php echo siteurl(array('user', 'index')); ?>">Go to Index</a>
</p>
</body>
</html>