$(function(){
	
	var loaded_form_values = collect_input_checkbox_select_values();
    
    print_mailing_list();
    
    select_all_in_table_for_modal();
	
	if($("textarea").length > 0){

        display_remaining_characters("textarea");

    }
	
	var modal_title = $.trim($("#modal-header-bar h4").text());
	
	if(modal_title == "Mailing List"){
		
		$(".modal #modal-header-bar input[type='submit']").addClass("display-none");
        
	}

	var edit_wrapper = $(".modal").attr("data-show-edit-wrapper");
	
	$("#add-new-schedule").click(function(){
	
		$(".modal").attr("data-show-edit-wrapper", true);
		
	});
	
	if(edit_wrapper == "true"){
		
		$(".modal .edit-wrapper").removeClass("display-none");
	   
	}
	
	var main_title =  $.trim($(".main-title-wrapper h1").text());
	
	var person_link_clicked = $("#main-modal").attr("data-person-link-clicked");

	if((main_title == "Schedules") && (person_link_clicked == "false")){
		
		$("#new-schedule-modal-body .edit-wrapper").addClass("display-none");
		
		$("#show-schedule-modal-body .edit-wrapper #back-bttn").css({"display":"none"});
		
		$("#show-schedule-modal-body .edit-wrapper .delete-bttn").css({"left":"10px"});
		
	}
			
	$("#back-bttn").click(function(){

		$("#main-modal .edit-wrapper").addClass("display-none");
		
		$("#main-modal").attr("data-show-edit-wrapper", false);
		
		$(".modal-body").remove();
		
		var last_location = $("#main-modal").attr("data-last-href");
		
		$("#main-modal").load(last_location, function(){
            
            check_activity_for_show_content();
            
            initialize_modal_guide_on_event("table_row_clicked", "table-row-clicked-modal-guide-info.php");
            
            adjust_modal_guide_by_add_new_bttn();
            
        });
        
		
	});
	
	phone_number_input();
	
	$("#main-modal input[type='submit']").on("click", function(evt){
        
        var staff_or_client;
        
        if($("#main-modal form select[name='staff']").is(":disabled")){
           
            staff_or_client = "staff";
            
            $("select[name='"+staff_or_client+"']").prop("disabled", false);
            
        }
        
        if($("#main-modal form select[name='client']").is(":disabled")){
            
            staff_or_client = "client";
            
            $("select[name='"+staff_or_client+"']").prop("disabled", false);
          
        }
        
		evt.preventDefault();
		
        $("#main-modal").attr("data-save-bttn-clicked", true);
        
		var href = (($(".modal-body").attr("id") == "new-schedule-modal-body")) ? "new-schedule.php" : (($(".modal-body").attr("id") == "show-schedule-modal-body")? "show-schedule.php" : $(".modal").attr("data-last-href"));
        
        var modal_form = href.replace(".php", "-form.php");
		
		var id = $.trim($(".modal .display-none").text());
      
		var modal_body_height = $(".modal-body").height();
        
        if($(".modal input[name='pay_rate']").length){
                        
            var pay_rate = Number($(".modal input[name='pay_rate']").val()).toFixed(2);
                        
            if(pay_rate == 0){pay_rate = "";}

                $(".modal input[name='pay_rate']").val(pay_rate);
                        
        }
        
        var modal_data = $(".modal form").serialize()+"&id="+id;
        
        if(staff_or_client != undefined){
            
            $("#main-modal form select[name='"+staff_or_client+"']").prop("disabled", true);
            
        }
        
        var modal_form = href.replace(".php", "-form.php");

		$.ajax({
			
			url: modal_form,
			method: "POST",
			data: modal_data,
			success: function(data, status, response){
				
				if((status == "success") && (response.readyState == 4) && (!$.isNumeric(data))){
                        
                    if($(".modal-body").hasClass("modal-form-body") && $(".modal-body").attr("id") != "new-client-modal-body" && $(".modal-body").attr("id") != "new-staff-modal-body"){
                       
                        $(".modal-body form").html(data);
                     
                        validate_schedule();
                        
                        if(!$(".edit-wrapper").hasClass("display-none")){
                        
                            $(".edit-wrapper input[type='checkbox']").prop("checked", false);
                            
                        }
                        
                    }else{
                       
                       $(".modal-body").html(data); 
                        
                    }
                    
                    check_activity();
                    
                    check_activity_for_show_content();
                    
                    if($(".modal-body").attr("id") == "new-schedule-modal-body" || $(".modal-body").attr("id") == "show-schedule-modal-body"){
                        
                        validate_schedule();
                        
                        $("#schedule-section-wrapper input").focusout();
                        
                    }
                    
                    phone_number_input();
                    
                    if($("textarea").length){
                        
                        display_remaining_characters("textarea");
	
                        $("textarea").keyup(function(){

                            display_remaining_characters("textarea");

                        });
        
                    }
                    
					if(modal_body_height % 1 != 0){modal_height();}
					
					var incorrect_input = $(".number-of-correct-inputs").attr("data-incorrect-input");
                    
					if(incorrect_input == 0){
                        
                        if($(".modal-body").attr("id") == "show-client-modal-body" || $(".modal-body").attr("id") == "show-staff-modal-body"){
                            
                            add_new_schedule_bttn_in_modal();
                            
                            load_modal_from_table_link();
                            
                            var person_type = ($(".modal-body").attr("id") == "show-client-modal-body") ? "Client" : "Staff";
                            
                            var person_type_first_name = $(".modal-body form  input[name='first_name']").val();
                            
                            var person_type_last_name = $(".modal-body form  input[name='last_name']").val();
                        
                            $("#main-modal #modal-header-bar h4").text(person_type+" - "+person_type_last_name+", "+person_type_first_name);
                        
                        }
					
						$(".correct-statement").fadeIn(500);
                        
                        $(".modal-body").scrollTop(0);
                        
                        if($(".modal-body").attr("id") == "new-schedule-modal-body" && main_title != "Schedules"){
                            
                            $(".modal-body").addClass("show-content");
                            
                        }
            
						if(!$(".modal-body").hasClass("show-content")){
                            
                            setTimeout(function(){

                                location.reload();

                            }, 300);
						
						}
                        
                        if($(".modal-body").attr("id") == "new-schedule-modal-body" && main_title != "Schedules"){
                            
                            $(".modal-body").removeClass("show-content");
                            
                        }
						
						if($("#show-client-modal-body").length){update_client_row(id);}
                        
                        if($("#show-staff-modal-body").length){update_staff_row(id);}
                        
                        if($("#show-schedule-modal-body").length){update_schedule_row(id);}
					
					}else if(incorrect_input > 0){
                        
                        if($(".modal-body").attr("id") == "show-client-modal-body" || $(".modal-body").attr("id") == "show-staff-modal-body"){
                            
                            $("#main-modal .modal-body #add-new-schedule").on("click", function(){
                                
                                alert("Please correct any errors before adding a new schedule.");
                              
                            });
                        
                            $("#main-modal .modal-body .table-part-2 .table-row").on("click", function(){
                                
                                alert("Please correct any errors before viewing any schedules.");
                              
                            });
                            
                        }
                        initialize_modal_guide_on_event("incorrect_bttn_clicked", "incorrect-modal-guide.php");
                        
                        if($("#main-modal form input, #main-modal form select, #main-modal form textarea").hasClass("incorrect-border")) {
                            
                            var incorrect_border_height = $(".modal-body form .incorrect-border").first().offset().top - 60;
                        
                            $(".modal-body").scrollTop(incorrect_border_height);
                 
                        }
						
						if(!$(".edit-wrapper").hasClass("display-none") && $(".modal-body").attr("id") != "new-schedule-modal-body" && $(".modal-body").attr("id") != "new-client-modal-body" && $(".modal-body").attr("id") != "new-staff-modal-body"){
				          
							$(".edit-wrapper input[type='checkbox']").prop("checked", true);
						
							activate_edit_form();
							
						}
						
					}
                    
                    if((incorrect_input == 100) &&  ($(".modal-body").attr("id") == "new-schedule-modal-body" || $(".modal-body").attr("id") == "show-schedule-modal-body")){
                             
                        alert("Must have at least one clockin and clockout.");
                             
                    }else if((incorrect_input == 50) && ($(".modal-body").attr("id") == "new-schedule-modal-body" || $(".modal-body").attr("id") == "show-schedule-modal-body")){
                             
                        alert("Cannot have a clockin without a clockout or a clockout without a clockin.");
                             
                    }else if((incorrect_input == 150) && ($(".modal-body").attr("id") == "new-schedule-modal-body" || $(".modal-body").attr("id") == "show-schedule-modal-body")){
                             
                        alert(" Schedule error 150. Refresh and try again.");
                             
                    }else if((incorrect_input == 200) && ($(".modal-body").attr("id") == "new-schedule-modal-body" || $(".modal-body").attr("id") == "show-schedule-modal-body")){
                         
                        var conflicting_schedule = $("#main-modal form .display-none").attr("data-conflicting-schedule");
                        
                        var conflicting_schedule_array = conflicting_schedule.split(";");
                        
                        alert("schedule you are creating conflicts with:"+"\n\n"+conflicting_schedule_array[3]+": "+conflicting_schedule_array[4]+"-"+conflicting_schedule_array[5]+"\n"+"schedule id: "+conflicting_schedule_array[0]+"\n"+"schedule client: "+conflicting_schedule_array[1]+"\n"+"schedule staff: "+conflicting_schedule_array[2]);
                    
                    }else if((incorrect_input == 1000) && ($(".modal-body").attr("id") == "new-client-modal-body" || $(".modal-body").attr("id") == "show-client-modal-body" || $(".modal-body").attr("id") == "new-staff-modal-body" || $(".modal-body").attr("id") == "show-staff-modal-body")){
                        
                        alert("id already exists");
                             
                    }
				
				}else{
					
				    ajax_success_error_message(data);
					
				}
		
			}
			
		});
        
	});
    
    close_modal(loaded_form_values);
    
    if($("textarea").length > 0){
	
        $("textarea").keyup(function(){

            display_remaining_characters("textarea");

        });
        
    }

}());