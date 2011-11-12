<!DOCTYPE html>
<html>
<head>
	<title>Modelos disponibles</title>
</head>
<body>
<h1>Modelos</h1>
<table>
<?php foreach($modelo as $m): ?>
	<tr><td><?php echo anchor('modelo/view/' . $m['nombre'], $m['nombre']); ?></td></tr>
<?php endforeach; ?>
</table>
</body>
</html>