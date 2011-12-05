<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function widget_to_php($widget_string) {
	
	//SETEO DE STRINGS PARA OBTENER DATOS
	$parser_nombre_submodelo = '"name_submodel"';
	$parser_metadata = '"meta: $1"';
	$parser_link_submodelo = '"link_submodel"';
	//FIN DE SETEO, NO TOCAR EL RESTO


	//Agrego tags php a estas variables
	$parser_metadata = '<?php echo '.$metadata.'; ?>';
	$parser_link_submodelo = '<?php echo '.$link_submodelo.'; ?>';
	$parser_nombre_submodelo = '<?php echo '.$nombre_submodelo.'; ?>';

	//eliminar todo el php existente
	$regex_pattern = '/(<\?{1}[pP\s]{1}.+\?>)/';
	$regex_replace = '';
	$str = preg_replace($regex_pattern, $regex_replace, $widget_string);

	//reemplazar tags de metadata por php
	$regex_pattern = array('/\[METADATA=([^\]]+)\]/', '/\[LINK_SUBMODELO\]/' ,  '/\[NOMBRE_SUBMODELO\]/');
	$regex_replace = array($metadata,$link_submodelo, $nombre_submodelo);
	$str = preg_replace($regex_pattern, $regex_replace, $str);

	return $str;
}



?>
