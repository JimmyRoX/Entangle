$(function(){


$("select#submodel option[selected]").removeAttr("selected");
$("select#submodel option[value='']").attr("selected", "selected");
$("#content_label").hide();

$("#submodel").change(function(){
	var id = $("#submodel").val();

	//Hacemos reset de los campos
	$("#content_label").hide();	
	$("#metadata").html("");	
	$("#tipoContrib").html('<option selected="selected">Elije el tipo de contribución</option>');
	
	$.get("../../modelo/contribuciones_json/", { 'submodel_id': id},
		 function(data){
		   //Añadimos los tipos de contribuciones al combobox
		   jQuery.each(data, function(i, val){
			$("#tipoContrib").append("<option>"+val+"</option>");
		   });
	 }, "json");


});


$("#tipoContrib").change(function(){
	var type = $("#tipoContrib").val();

	//Resetiamos los campos
	$("#metadata").html("");
	$("#content_label").hide();

	$.get("../../modelo/contribucion_json/", { 'submodel_id': $("#submodel").val(), 'contrib_nombre': type},
	 function(data){
	   updateForm(data);
	 }, "json");


});

function updateForm(contrib)
{
	
	if(contrib.content == "longtext")
	{
		$("#content_label").html('contenido <textarea name="content" required />');
		$( "form#contrib_form" )
			.removeAttr( "enctype")
			.removeAttr( "encoding");
		$("#is_file").val("false");
	}
	else if(contrib.content == "url")
	{
		$("#content_label").html('contenido <input type="url" name="content" required />');
		$( "form#contrib_form" )
			.removeAttr( "enctype")
			.removeAttr( "encoding");
		$("#is_file").val("false");
	}
	else
	{
		$("#content_label").html('contenido <input type="file" name="content" required />');
		$( "form#contrib_form" )
			.attr( "enctype", "multipart/form-data" )
			.attr( "encoding", "multipart/form-data" );
		$("#is_file").val("true");
		
	}
	$("#content_label").show();

	//Actualizamos los campos de metadata
	$("#metadata").html("");
	jQuery.each(contrib.metadata, function(i, val) {

		addMetadataField(val.name, val.tipo);

	});

}

function addMetadataField(name, type)
{
	if(type == "string")
		$("#metadata").append('<p><label>'+name+'</label> <input type="text" name="metadata['+
		name+']" required /></p>');
	else if(type == "longtext")
		$("#metadata").append('<p><label>'+name+'</label> <textarea name="metadata['+
		name+']" required /></p>');
	else if(type == "url")
		$("#metadata").append('<p><label>'+name+'</label> <input type="url" name="metadata['+
		name+']" required /></p>');
	else if(type == "number")
		$("#metadata").append('<p><label>'+name+'</label> <input type="number" name="metadata['+
		name+']" required /></p>');
	else if(type == "date")
		$("#metadata").append('<p><label>'+name+'</label> <input type="date" name="metadata['+
		name+']" required /></p>');
}

$("#tipoRef").change(function(){
	//Obtenemos el tipo de referencia
	var type = $("#tipoRef").val();

	$.get("../../contribution/reference_json/"+$("#contrib").val(), { 'tipoRef': type},
	 function(data){
		$("#target").html('<option selected="selected">Elije la contribución objetivo...</option>');
		jQuery.each(data.contribs, function(i, val){
			$("#target").append("<option value="+val.id+">"+val.name+"</option>");
		});
		$("#metadata").html("");
		jQuery.each(data.metadata, function(i, val) {

			addMetadataField(val.name, val.tipo);

		});
	 }, "json");


});


});
