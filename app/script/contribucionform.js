$(function(){

$("#modelo").change(function(){

	var id = $("#modelo").val();

	$.get("../../modelo/contribuciones_json/", { 'modelo_id': id},
	 function(data){
	   $("#tipo").html('<option selected="selected"></option>');

	   jQuery.each(data, function(i, val){
		$("#tipo").append("<option>"+val+"</option>");
	   });
	 }, "json");


});


$("#tipo").change(function(){
	var tipo = $("#tipo").val();

	$.get("../../modelo/contribucion_json/", { 'modelo_id': $("#modelo").val(), 'contrib_nombre': tipo},
	 function(data){
	   updateForm(data);
	 }, "json");


});

function updateForm(contrib)
{
	$("#metadata").html("");
	jQuery.each(contrib.metadata, function(i, val) {

		if(val.tipo == "texto")
			$("#metadata").append('<label>'+val.nombre+' <input type="text" name="'+val.nombre+'" required /></label>');
		else if(val.tipo == "url")
			$("#metadata").append('<label>'+val.nombre+' <input type="url" name="'+val.nombre+'" required /></label>');
		else if(val.tipo == "number")
			$("#metadata").append('<label>'+val.nombre+' <input type="number" name="'+val.nombre+'" required /></label>');
		else if(val.tipo == "datetime")
			$("#metadata").append('<label>'+val.nombre+' <input type="datetime" name="'+val.nombre+'" required /></label>');
		else if(val.tipo == "file")
		{
			$("#metadata").append('<label>'+val.nombre+' <input type="file" name="'+val.nombre+'" required /></label>');
		}

	});

}




});
