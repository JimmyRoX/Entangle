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
		$( "#tabs" ).tabs({
			ajaxOptions: {
				<?php if(isset($widget_file)) { ?>
				data: { widget_file: "<?php echo $widget_file; ?>" },
				type : "post",
				<?php } ?>
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"Couldn't load this tab. We'll try to fix this as soon as possible. " +
						"If this wouldn't be a demo." );
				}
			}
		});
	});
		
	</script>
    
</head>
<body>
<table width="100%">


<tr><td colspan="2"><div id="tabs">
	<ul>
		<li><a href="<?php echo base_url();?>index.php/widget/content" title="Principal Overview"><span>Content 1</span></a></li>
	</ul>
</div>
</td></tr>
</table>


</body>
</html>

