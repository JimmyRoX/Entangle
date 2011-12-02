<!DOCTYPE html>
<html>
	<head>
		<title>
			A&ntilde;adiendo Cursos
		</title>
	</head>
	
	<body>
	<?php
	if($result==true)
	{
		echo "<h3>Operaci&oacute;n Exitosa</h3>";				
		echo "<p>El curso ".$nombre." se pudo agregar correctamente</p>";				
    }    
    else
    {
		echo "<h3>Operaci&oacute;n Erronea</h3>";	
		echo "<p>El curso ".$nombre." no se pudo agregar correctamente</p>";				
		
	}
	?>
	</body>
</html>
