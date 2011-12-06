$(function(){
$("#submodel").change(function(){
	var id = $("#submodel").val();

	$.get("../../contribution/contributions_json/", { 'submodel_id': id},
	 function(data){
	   $("#contribs").html("<tr><th>nombre</th><th></th></tr>");
	   jQuery.each(data, function(i, val){
		$("#contribs").append('<tr><td><a href="../../contribution/view/'+val.id+'">'+val.nombre+'</a></td><td><a href="../../contribution/delete/'+val.id+'"><-Remove></a></td><td><a href="../../contribution/add_reference/'+val.id+'"><+ Ref></a></td></tr>');
	  	
	   });
	 }, "json");
	});

});

