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
		$.fx.speeds._default = 1000;
	$(function() {
		if ($("#dialog").length == 0) {
		        dialog = $('<div id="dialog"></div>').appendTo('body');
		} 
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
		$( "#dialog" ).dialog({
			autoOpen: false
		});
		$('a.articlePopup').live('mouseenter', function(e) {
		    var url = this.href;
		    var title = this.title;
		    var dialog = $("#dialog");
		    //if ($("#dialog").length == 0) {
		        //dialog = $('<div id="dialog"></div>').appendTo('body');
		    //} 
		    var x = e.pageX+10;
		    var y = e.pageY+18;
		    //var y = jQuery(this).position().bottom;
		    
		    $( "#dialog" ).dialog('open');
		    $( "#dialog" ).dialog('option','position', [x,y]);
		    $( "#dialog" ).dialog('option','title', title);
		    // load remote content
		    dialog.load(
		            url,
		            {},
		            function(responseText, textStatus, XMLHttpRequest) {
		               	dialog.dialog();

		            }
		        );
		    //prevent the browser to follow the link
		    		    return false;
		});
		
		$( "a.articlePopup" ).mouseleave(function() {
			$( "#dialog" ).dialog( "close" );
			return false;
		});
		

	});
		
	</script>
    
</head>
<body>
<table width="100%">
<tr><td><div id="Principal_Overview">Aca va El contenido Principal</div>

</td>
<td width="400px">
<ul id="sortable">
	<li class="ui-state-default"><div id="sidewidget"><h3><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Artículos relacionados</h3>
		<ul>
		<li><span class="ui-icon ui-icon-note"></span><a class="articlePopup" href="<?php echo base_url();?>index.php/widget/popup" title="Artículo Uno">Artículo uno</a></li>
		<li><span class="ui-icon ui-icon-note"></span><a class="articlePopup" href="<?php echo base_url();?>index.php/widget/popup" title="Artículo Dos">Artículo Dos</a></li>
		</ul>
		</div>
	</li>
	<li class="ui-state-default"><div id="sidewidget"><h3><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Usuarios Online</h3>
		<ul>
		<li><span class="ui-icon ui-icon-power"></span><a class="articlePopup" href="<?php echo base_url();?>index.php/widget/popup" title="Usuario Uno">Usuario uno</a></li>
		<li><span class="ui-icon ui-icon-power"></span><a class="articlePopup" href="<?php echo base_url();?>index.php/widget/popup" title="Usuario Dos">Usuario Dos</a></li>
		</ul>
		</div>
	</li>
	<li class="ui-state-default"><div id="sidewidget"><h3><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Ejemplos de Referencias</h3>
		<ul>
		<li><span class="ui-icon ui-icon-circle-arrow-e"></span><a class="articlePopup" href="<?php echo base_url();?>index.php/widget/popup" title="Referencia">Referencia uno</a></li>
		<li><span class="ui-icon ui-icon-circle-arrow-e"></span><a class="articlePopup" href="<?php echo base_url();?>index.php/widget/popup" title="Referencia">Referencia dos</a></li>
		</ul>
		</div>
	</li>

	</ul>
</td></tr></table>
</body>
</html>


