<!DOCTYPE html>
<html>
	<head>
		<title>
			Resultados de Busqueda
		</title>
	</head>
	
	<body>
		<?php 
		//Para cada instancia
		 foreach($result as $instancia)
		 {
			 echo '<div>';
			 echo '<p><em>Modelo: '.$instancia['nombre'].'</em></p>';
			 
			 //Para cada contribucion de cada instancia
			 foreach($instancia['contribucion'] as $contribucion)
			 {
				echo '<div>';
				echo '<p>Nombre: '.$contribucion['nombre'].'</p>';
				echo '<p>Autor: '.$contribucion['autor'].'</p>';
				echo '<p>Descripci&oacute;n: '.$contribucion['descripcion'].'</p>';
				echo '<p>Fecha de Creaci&oacute;n: '.$contribucion['fechaCreated'].'</p>';
				echo '<p>Tipo de Contribuci&oacute;n: '.$contribucion['tipoContribucion'].'</p>';
				echo '<p>Formato: '.$contribucion['format'].'</p>';
				echo '</div>';
			 }			 
			 
			 echo '</div>';
		 }		
		?>
		
	</body>
</html>
