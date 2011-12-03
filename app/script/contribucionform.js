$(function(){
$("#submodel").change(function(){
	var id = $("#submodel").val();
	
	$.get("../../modelo/contribuciones_json/", { 'submodel_id': id},
	 function(data){
	   $("#tipoContrib").html('<option selected="selected"></option>');
	   jQuery.each(data, function(i, val){
		$("#tipoContrib").append("<option>"+val+"</option>");
	   });
	 }, "json");


});


$("#tipoContrib").change(function(){
	var type = $("#tipoContrib").val();

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

	$("#metadata").html("");
	jQuery.each(contrib.metadata, function(i, val) {

		if(val.tipo == "string")
			$("#metadata").append('<p><label>'+val.name+'</label> <input type="text" name="metadata['+val.name+']" required /></p>');
		else if(val.tipo == "longtext")
			$("#metadata").append('<p><label>'+val.name+'</label> <textarea name="metadata['+val.name+']" required /></p>');
		else if(val.tipo == "url")
			$("#metadata").append('<p><label>'+val.name+'</label> <input type="url" name="metadata['+val.name+']" required /></p>');
		else if(val.tipo == "number")
			$("#metadata").append('<p><label>'+val.name+'</label> <input type="number" name="metadata['+val.name+']" required /></p>');
		else if(val.tipo == "date")
			$("#metadata").append('<p><label>'+val.name+'</label> <input type="date" name="metadata['+val.name+']" required /></p>');
		else if(val.tipo == "file")
		{
			$("#metadata").append('<p><label>'+val.name+'</label> <input type="file" name="[metadata]['+val.name+']" required /></p>');
		}

	});

}




});
