<!DOCTYPE html>
<html>
	<head>
		<title>
			B&uacute;squeda de Cursos
		</title>
	</head>
	<body>	
	<div>
	<?php echo form_open('search/search_result') ?>
		<fieldset>
		<legend>B&uacute;squeda:</legend>
		<p>Contribuci&oacute;n:<input id="contribucion" name="contribucion" type=text/>
		 Tipo:<select id="tipo" name="tipo">
				<option value="">--</option>		 
				<?php 
					foreach($tipos as $tipo)
					{
						echo "<option value=\"".$tipo['tipo']."\">".$tipo['tipo']."</option>";
					}
				?>
			  </select>
		 
		 <input type="submit"  value="Buscar"/></p>
		</fieldset>
		<!--	
		<fieldset>		
		<legend>Busqueda Avanzada:</legend>
		<p>Curso:<input id="curso" name="curso" type=text/></p>
		<p>Sigla:<input id="sigla" name="sigla" type=text/></p>
		<p>Carrera:<input id="carrera" name="carrera" type=text/></p>
		<p>Autor:<input id="autor" name="autor" type=text/></p>		
		</fieldset>	
		-->
	<?php echo form_close(); ?>	
	</div>
</body>
</html>
