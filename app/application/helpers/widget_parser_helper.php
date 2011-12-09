<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function widget_to_php($widget_string,$metadata = array(),$submodel_name = "",$submodel_link = "") {
	
	//SETEO DE STRINGS PARA OBTENER DATOS
	$parser_nombre_submodelo = '$submodel_name';
	$parser_metadata = '$metadata["$1"]';
	$parser_link_submodelo = '$submodel_link';
	//FIN DE SETEO, NO TOCAR EL RESTO


	//Agrego tags php a estas variables
	$parser_metadata = '<?php if(isset('.$parser_metadata.')) echo '.$parser_metadata.'; ?>';
	$parser_link_submodelo = '<?php if(isset('.$parser_link_submodelo.')) echo '.$parser_link_submodelo.'; ?>';
	$parser_nombre_submodelo = '<?php if(isset('.$parser_nombre_submodelo.')) echo '.$parser_nombre_submodelo.'; ?>';

	//eliminar todo el php existente
	$regex_pattern = '/(<\?{1}[pP\s]{1}.+\?>)/';
	$regex_replace = '';
	$str = preg_replace($regex_pattern, $regex_replace, $widget_string);

	//reemplazar tags de metadata por php
	

	$regex_pattern = array('/\[METADATA=([^\]]+)\]/', '/\[LINK_SUBMODELO\]/' ,  '/\[NOMBRE_SUBMODELO\]/');
	$regex_replace = array($parser_metadata,$parser_link_submodelo, $parser_nombre_submodelo);
	$str = preg_replace($regex_pattern, $regex_replace, $str);

	//return htmlspecialchars($str);
	return eval(' ?>'.$str.'<?php ');

}




?>
