$(function(){
	
	$("#modal-header-bar input[type='submit']").addClass("display-none");

    add_new_schedule_bttn_in_modal();
    
	$(".edit-wrapper input[type='checkbox']").click(function(){
        
        activate_edit_form();
        
    });
	
	load_modal_from_table_link();

    if($(".modal-body").attr("id") == "show-schedule-modal-body"){
        
        $("#schedule-section-wrapper input").focusout();
        
        activate_edit_form();
        
    }
	
	$(".modal .show-content .delete-bttn").on("click", function(){
				
		var modal_title = $.trim($("#modal-header-bar h4").text());
				
		var id = $.trim($(".modal .show-content .display-none").text());
				
		var selected_row = $(".main-content .table-part-2").find("."+id).closest(".table-row");
        
        var delete_message = ($(".modal-body").attr("id") == "show-client-modal-body" || $(".modal-body").attr("id") == "show-staff-modal-body") ? "Are you sure your want to delete "+modal_title+"? This will also delete any connecting schedules associated with "+modal_title+"." : "Are you sure your want to delete "+modal_title+"?";
        
        var table = "";
        
        if($(".modal-body").attr("id") == "show-client-modal-body"){
            
            table = "clients";
           
        }else if($(".modal-body").attr("id") == "show-schedule-modal-body" || $(".modal-body").attr("id") == "new-schedule-modal-body"){
            
            table= "schedules";
                 
        }else if($(".modal-body").attr("id") == "show-staff-modal-body"){
            
            table = "staff";
            
        }
        
		if(confirm(delete_message)){
						
			$.ajax({
						
				url: "delete-single-record.php",
				method: "POST",
				data:{id: id, table: table},
				dataType: "html",
				success: function(data, status, response){
						
					if((status == "success") && (response.readyState == 4) && (data == true)){
						
						close_modal_through_ajax();
						
						selected_row.css({"background-color":"red"});

						selected_row.fadeOut(500);

						setTimeout(function(){

							selected_row.remove();

						}, 1000);
							
					}else{
								
						ajax_success_error_message(data);
		
					}
							
				}
						
			});
			
		}
		
	});
	
}());