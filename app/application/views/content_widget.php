<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
    <script src="<?php echo base_url();?>script/jquery-1.7.min.js"></script>
    <script src="<?php echo base_url();?>script/jquery-ui-1.8.16.custom.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui-1.8.16.custom.css" type="text/css" media="screen"/>
    <title>Untitled Page</title>
	<style>
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; }
	#sortable li span { position: absolute; margin-left: -1.3em; }
	</style>
    
	<script>
	$(function() {
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
	});
		
	</script>
    
</head>
<body>
<table width="100%">
<tr><td><div id="Principal_Overview">Aca va El contenido Principal</div>

</td>
<td width="400px">
<ul id="sortable">
	<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Cosa de Navegacion</li>
	<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Usuarios Conectados</li>
	<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Artículos Relacionados</li>
</ul>
</td></tr></table>


</body>
</html>


