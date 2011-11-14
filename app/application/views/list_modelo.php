<!DOCTYPE html>
<html>
<head>
	<title>Modelos disponibles</title>
</head>
<body>
<h1>Modelos</h1>
<?php echo anchor('modelo/add', 'crear modelo') ?>
<table>
	<tr>
		<th>nombre</th>
		<th></th>
	</tr>
<?php foreach($modelo as $m): ?>
	<tr>
		<td><?php echo anchor('modelo/view/' . $m['nombre'], $m['nombre']); ?></td>
		<td><?php echo anchor('modelo/delete/' . $m['nombre'], '-'); ?></td>
	</tr>
<?php endforeach; ?>
</table>
</body>
</html>