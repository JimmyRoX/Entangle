<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Entangle
Description: Página para Arquitectura de SW
Version    : 1.0
Released   : 20100328

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Entangle</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	<div id="logo">
		<h1><a href="index.php">Entangle </a></h1>
		<p><em> EL lugar para compartir apuntes</em></p>
	</div>
	<hr />
	<!-- end #logo -->
	<div id="header">


		<div id="search">
			
			<?php echo form_open('search/search_result') ?>
				<fieldset>				
				<input id="search-text" size="15" name="contribucion" type=text/>
				<input type="submit"  id="search-submit" value="GO" />				 
				 
				<!--<label for="Filetype">Tipo Archivo</label>-->
				<select id="tipo" name="tipo"  id="Filetype">
						<option value="">--</option>		 
						<?php 				
							foreach($tipos['values'] as $tipo)
							{
								echo "<option value=\"".$tipo."\">".$tipo."</option>";
							}
						?>
				</select>
				</fieldset>
	
			<?php echo form_close(); ?>	
		</div>
		<!-- end #search -->
		<div id="menu">
			<ul>
				<li><a href="mailto:ralarcon@ing.puc.cl">Contacto</a></li>
			</ul>
					<!-- end #menu -->
		</div>
		
	</div>
	<!-- end #header -->
	
	
	
	
	<!-- end #header-wrapper -->
	<div id="page">
		<div id="content">
		  <div class="post">
				<h2 class="title"><a href="#">Apuntes Recientes </a></h2>
					<p class="meta"></p>
				<div class="entry">
					<!--
					<ul>
						<li><a href="#">Arq SW 1</a></li>
						<li><a href="#">Examen Arq SW</a></li>
						<li><a href="#">I3 Arq SW</a></li>
						<li><a href="#">Ayudantía 3 Gaggeros</a></li>
						<li><a href="#">Examen Redes de Computadores</a></li>
						<li><a href="#">Resumen Exámen Arquitectura Software</a></li>
						</ul>
					-->
			</div>
		  </div>
		  <div class="post">
				<h2 class="title"><a href="#">Más populares </a></h2>
					<p class="meta"></p>
				<div class="entry">
				<!--
					<ul>
						<li><a href="#">Arq SW 1</a></li>
						<li><a href="#">Examen Arq SW</a></li>
						<li><a href="#">I3 Arq SW</a></li>
						<li><a href="#">Ayudantía 3 Gaggeros</a></li>
						<li><a href="#">Examen Redes de Computadores</a></li>
						<li><a href="#">Resumen Exámen Arquitectura Software</a></li>
						</ul>
				-->
			</div>
		  </div>
		</div><!-- end #content -->
		<div id="sidebar">
			<ul>
				<li>
					<h2>Acerca</h2>
					<p>Entangle se basa en los usuarios para poder compartir información acerca de ramos de manera transpartente</p>
				</li>
				<li>
					<h2>Subir Contribución </h2>
					<ul>
						<li><a href="submodelo">Nueva Contribución</a></li>


					</ul>
				</li>
				<li>
					<h2>Sitios de Interes </h2>
					<ul>
						<li><a href="www.uc.cl">Página UC</a></li>
						<li><a href="www.caiuc.cl">Sitio Web CAI</a></li>
						<li><a href="www.ing.puc.cl">Ing.puc.cl</a></li>
						<li><a href="www.entangle.cl">Entangle</a></li>

					</ul>
				</li>
				
				
			</ul>
		</div>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->
	<div id="footer">
		<p>Copyright (c) 2011 Entangle.cl All rights reserved. Design by <a href="www.tomas.icaza.com">T.i</a>.</p>
	</div>
	<!-- end #footer -->
</body>
</html>
