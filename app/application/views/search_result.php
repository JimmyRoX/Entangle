<!DOCTYPE html>
<html>
	<head>
		<title>
			Resultados de B&uacute;squeda
		</title>
	</head>
	
	<body>
	<h2>Resultados de la B&uacute;squeda para <em>"<?php echo $keyword; ?>"</em>:</h2>
		<?php 
				
		//Para cada instancia de modelo
		 //foreach($cursor as $instancia)
		 {			 
			 //echo '<p><em>Modelo: '.$instancia['nombre'].'</em></p>';
			 
			 //Para cada contribucion de cada instancia
			 foreach($instancias as $contribucion)
			 {
				echo '<div>';
				//nombre de la contribucion
				echo '<p><em>'.$contribucion['instancia'].' -- <strong>'.$contribucion['metadata']['nombre'].'</strong></em><br/>';
				
				//Si es algun file hacemos un enlace
				if ($contribucion['tipo']=="paper" || $contribucion['tipo']=="clase" || $contribucion['tipo']=="video" || $contribucion['tipo']=="audio")
					echo $contribucion['tipo'].': <a href='.$contribucion['content'].' target=_blank>'.$contribucion['content'].'</a><br/>';
				else			
					echo $contribucion['tipo'].': '.$contribucion['content'].'<br/>';
				
				echo '<ul>';
				$metadata=$contribucion['metadata'];
				foreach(array_keys($metadata) as $metadata_key)
				{
					if( $metadata_key!='nombre')
					{
						echo '<li>'.$metadata_key.': '.$metadata[$metadata_key].'</li>';
					}
				};				
				echo '</ul>';
				if (array_key_exists('refs',$contribucion))
				{
					echo "Referencias:";
					foreach($contribucion['refs'] as $tiporeferencia)
					{						
						echo '<a href=ref_search/?id='.$tiporeferencia['destino'].'><br> '.$tiporeferencia['tipo'].'</a>';
						if (array_key_exists('metadata',$tiporeferencia))
						{
							echo '<ul>';
							foreach(array_keys($tiporeferencia['metadata']) as $metadata_key)
							{
								echo '<li>'.$metadata_key.': '.$tiporeferencia['metadata'][$metadata_key].'</li>';
							}
							echo '</ul>';
							
						}
					}
				}
				
				echo '<br/></p>';
				
				echo '</div>';	
			 }			 
			 
			 
		 }
		 		
		?>
		
	</body>
</html>
