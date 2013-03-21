function alertTerm(){
	jQuery.ajax({
		  url: "../../../../site/termcondition/ajax/1",
		  type : "get",
		  success: function(data) {
				$("#modal-from-dom").find(".modal-body").html(data);
				$("#modal-from-dom").find(".modal-header h3").html("Term and Condition");
				$("#modal-from-dom").modal({"show":true,"backdrop":"static"});
			}
		});		

}