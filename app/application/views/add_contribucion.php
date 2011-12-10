<!DOCTYPE html>
<html>
<head>
    <title>Subir Contribuci&oacute;n</title>
    <link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	<script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('script/contribucionform.js') ?>"></script>

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

	<div id="page">
		<div id="content">
		  <div class="post">
				<h2 class="title"><a href="#">Nueva Contribucion </a></h2>

	<div id="contrib">
		<form id="contrib_form" action="<?php echo base_url('contribution/add') ?>" method="post">
		<input type="hidden" value="false" name="is_file" id="is_file" class="is_file"/>
		<p>
		<label>
		    SubModelo
		    <select name="submodel" id="submodel" required>
			<option selected="selected">Elije Submodelo...</option>
		    <?php foreach($submodels as $submodel): ?>
			<option value="<?php echo($submodel['id']); ?>"><?php echo($submodel['nombre']); ?></option>
		    <?php endforeach; ?>
		    </select>
		</label>
		</p>

		<p>
		<label>
		    Tipo de contribucion
		    <select name="tipoContrib" id="tipoContrib" required>
			<option selected="selected">Elije el tipo de contribuci&oacute;n...</option>
		    </select>
		</label>
		</p>
		<p>
		<label class="content_label">
		</label>
		</p>
		<div class="metadata" id="metadata">
		</div>
		<input type="submit" name="add" value="Subir">
		</form>
	</div>

	</div>
	</div>
	<!--end content-->
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

</body>
</html>
