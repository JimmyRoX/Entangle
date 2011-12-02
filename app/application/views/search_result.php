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
				 
			 foreach($submodelos as $contribucion)
			 {
				echo '<div>';
				//nombre de la contribucion
				echo '<p><em>'.$contribucion['submodel'].' -- <strong>'.$contribucion['metadata']['nombre'].'</strong></em><br/>';
				
				//Si es algun file hacemos un enlace
				if ($contribucion['tipoContrib']=="paper" || $contribucion['tipoContrib']=="clase" || $contribucion['tipoContrib']=="video" || $contribucion['tipoContrib']=="audio")
					echo $contribucion['tipoContrib'].': <a href='.$contribucion['content'].' target=_blank>'.$contribucion['content'].'</a><br/>';
				else			
					echo $contribucion['tipoContrib'].': '.$contribucion['content'].'<br/>';
				
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
					foreach($contribucion['refs'] as $referencia)
					{						
						//echo '<a href=ref_search/?id='.$tiporeferencia['destino'].'><br> '.$tiporeferencia['tipo'].'</a>';
						foreach(array_keys($referencia) as $tiporeferencia)
						{
							if($tiporeferencia!='metadata')
								echo '<a href=ref_search/?id='.$referencia[$tiporeferencia].'><br> '.$tiporeferencia.'</a>';
							/*
							echo '<ul>';
							foreach(array_keys($tiporeferencia['metadata']) as $metadata_key)
							{
								echo '<li>'.$metadata_key.': '.$tiporeferencia['metadata'][$metadata_key].'</li>';
							}
							echo '</ul>';
							*/
							
						}
						/*
						if (array_key_exists('metadata',$tiporeferencia))
						{
							echo '<ul>';
							foreach(array_keys($tiporeferencia['metadata']) as $metadata_key)
							{
								echo '<li>'.$metadata_key.': '.$tiporeferencia['metadata'][$metadata_key].'</li>';
							}
							echo '</ul>';
							
						}
						*/
					}
				}
				
				echo '<br/></p>';
				
				echo '</div>';	
			 }			 
			 
		 		
		?>
		
	</body>
</html>
