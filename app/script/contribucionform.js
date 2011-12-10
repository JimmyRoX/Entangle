$(function(){

$("select#submodel option[selected]").removeAttr("selected");
$("select#submodel option[value='']").attr("selected", "selected");
$("#content_label").hide();

$("select#submodel_list option[selected]").removeAttr("selected");
$("select#submodel_list option[value='']").attr("selected", "selected");

$("#submodel").change(function(){
	var id = $("#submodel").val();

	//Hacemos reset de los campos
	$("#content_label").hide();	
	$("#contrib .metadata").html("");	
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
	$("#contrib .metadata").html("");
	$("#content_label").hide();

	$.get("../../modelo/contribucion_json/", { 'submodel_id': $("#submodel").val(), 'contrib_nombre': type},
	 function(data){
	   updateForm($("#contrib"),$("form#contrib_form"), "metadata", data);
	 }, "json");


});

function updateForm(container, form, arrayname,  contrib)
{
	if(contrib.content == "longtext")
	{
		$(form).find(".content_label").html('Contenido <textarea name="content" required />');
		$(form)
			.removeAttr( "enctype")
			.removeAttr( "encoding");
		$(form).find(".is_file").val("false");
	}
	else if(contrib.content == "url")
	{
		$(form).find(".content_label").html('Contenido <input type="url" name="content" required />');
		$(form)
			.removeAttr( "enctype")
			.removeAttr( "encoding");
		$(form).find(".is_file").val("false");
	}
	else
	{
		$(form).find(".content_label").html('Contenido <input type="file" name="content" required />');
		$(form)
			.attr( "enctype", "multipart/form-data" )
			.attr( "encoding", "multipart/form-data" );
		$(form).find(".is_file").val("true");
		
	}
	$(form).find("#content_label").show();

	//Actualizamos los campos de metadata
	$(container).find(".metadata:first").html("");

	jQuery.each(contrib.metadata, function(i, val) {
		
		addMetadataField($(container).find(".metadata:first"), arrayname,val.name, val.tipo);

	});

}

function addMetadataField(selector, arrayname, name, type)
{
	if(type == "string")
		$(selector).append('<p><label>'+name+'</label> <input type="text" name="'+arrayname+'['+
		name+']" required /></p>');
	else if(type == "longtext")
		$(selector).append('<p><label>'+name+'</label> <textarea name="'+arrayname+'['+
		name+']" required /></p>');
	else if(type == "url")
		$(selector).append('<p><label>'+name+'</label> <input type="url" name="'+arrayname+'['+
		name+']" required /></p>');
	else if(type == "number")
		$(selector).append('<p><label>'+name+'</label> <input type="number" name="'+arrayname+'['+
		name+']" required /></p>');
	else if(type == "date")
		$(selector).append('<p><label>'+name+'</label> <input type="date" name="'+arrayname+'['+
		name+']" required /></p>');
}



$("#submodel_list").change(function(){
	var id = $("#submodel_list").val();

	$.get("../../contribution/contributions_json/", { 'submodel_id': id},
	 function(data){
	   $("#contribs").html("Contribuciones");
	   jQuery.each(data, function(i, val){
		$("#contribs").append('<div id="contrib_'+val.id+
		'"><a href="../../contribution/view/'+val.id+'">'+
		val.nombre+'</a><input type="image" src="../../images/imgres-1.jpeg" width="20" height="20" onclick="window.location.href=\'../../contribution/delete/'+val.id+
		'\'" value="Remove"><input type="button" class="addReferenceButton" value="Add Ref"/></div>');
		$("#contrib_"+val.id+" .addReferenceButton").click(function(){ addReferenceHandler(val.id); });
	  	
	   });
	 }, "json");
	});


function addReferenceHandler(id)
{
	var contribDiv = $("#contrib_"+id);
	$("#form_container").remove();
	$.get("../../contribution/references_json", { 'contribution_id': id},
	 function(data){

		if(data == ""){
			contribDiv.append("<div id='form_container'>No es posible agregarle referencias.</p>");
			return;
		}
		var container = $("#prototype").clone();
		container.attr("id", "form_container");	
		container.find(".contrib_id").val(id);
		container.find(".tipoRef").html('<option selected="selected" value="-1">Elije el tipo de referencia...</option>');
		jQuery.each(data, function(i, val){
			container.find(".tipoRef").append("<option value='"+val.name+"' data-target='"+
				val.target+"'>"+val.name+"</option>");
		});
		
		
		contribDiv.append(container);
		container.show();
		contribDiv.find(".submodel").val($("#submodel_list").val());

		container.find(".tipoRef").change(function(){changeTipoRefHandler(id);});

	 }, "json");
	
	 
}

function changeTipoRefHandler(c_id){

	var contribDiv = $("#contrib_"+c_id);

	//Obtenemos el tipo de referencia
	var type = contribDiv.find(".tipoRef").val();

	//Obtenemos el tipo de contribucion target de dicha referencia
	var target = contribDiv.find(".tipoRef").find("option:selected").data("target");

	if(type == "-1")
		contribDiv.find(".newcontrib").hide();

	$.get("../../contribution/reference_json/"+c_id, { 'tipoRef': type, "target":target},
	 function(data){
		contribDiv.find(".target").html('<option selected="selected" value="-1">Nueva Contribuci&oacute;n...</option>');
		jQuery.each(data.contribs, function(i, val){
		contribDiv.find(".target").append("<option value='"+val.id+"'>"+val.name+"</option>");
		});
		contribDiv.find(".reference_form > .metadata").html("");
		jQuery.each(data.metadata, function(i, val) {

			addMetadataField(contribDiv.find(".reference_form > .metadata"),
				"reference[metadata]", val.name, val.tipo);

		});
		
		updateForm(contribDiv.find(".newcontrib"), 
			contribDiv.find(".reference_form"), "contribution[metadata]", data.target);

		contribDiv.find(".tipoContrib").val(data.target.nombre);
		contribDiv.find(".newcontrib").show();
		contribDiv.find(".target").unbind('change');
		contribDiv.find(".target").change(function(){
			if(contribDiv.find(".target").val()=="-1")
				contribDiv.find(".newcontrib").show();
			else
				contribDiv.find(".newcontrib").hide();


		});
		

	 }, "json");


}






});
