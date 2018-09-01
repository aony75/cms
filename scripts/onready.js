$(function(){

    //loads mobile menu functionality
    //mobile_menu();
    
    var content_id = $(".content").attr("id");
    
    switch(content_id){
            
        case "clients-content":
            
            onready_modal_guide("clients_onready_guide_read");
            
            break;
            
        case "schedules-content":
            
            onready_modal_guide("schedules_onready_guide_read");
            
            break;
            
        case "staff-content":
            
            onready_modal_guide("staff_onready_guide_read");
        
    }
    
    if(typeof(Storage) !== "undefined"){
        
        if(sessionStorage.session_expiration_read != "true"){
       
            session_expiration_alert();
            
            sessionStorage.session_expiration_read = "true";
        
        }

        var hour_in_milliseconds = 1000 * 60 * 60;

        if(sessionStorage.login_time !== undefined){

            var time_passed = (Date.now() - sessionStorage.login_time) / hour_in_milliseconds;

            if(time_passed >= 1){sessionStorage.clear();}

        }else{

            sessionStorage.login_time = Date.now();
            
        }

    }
    
    //displays drop down menu content on list hover
    dropdown_menu_content();
    
    //if parent checked then child will be checked. if parent unchecked all will be unchecked.
    select_all_in_table();
    
	var main_title = $.trim($(".main-title-wrapper h1").text());
    
    var original_window_scroll_position_left = $(window).scrollLeft();
    
    var original_window_scroll_position_top = $(window).scrollTop();
           
    $(window).scroll(function(){
        
        var new_window_scroll_position_left = $(window).scrollLeft();
            
        var new_window_scroll_position_top = $(window).scrollTop();

        var modal_content_margin_left = original_window_scroll_position_left - new_window_scroll_position_left;
            
        var modal_content_margin_top = original_window_scroll_position_top - new_window_scroll_position_top;
        
        var filter_left_margin = $(".filter-bttn").offset().left;
		
	    var filter_top_margin = $(".filter-bttn").offset().top;
        
        var current_filter_left_margin = $(".show-current-filters-bttn").offset().left - 150;
		
	    var current_filter_top_margin = $(".show-current-filters-bttn").offset().top;
        
        var filter_left = filter_left_margin - new_window_scroll_position_left;
        
        var filter_top = filter_top_margin - new_window_scroll_position_top;
        
        var current_filter_left = current_filter_left_margin - new_window_scroll_position_left;
        
        var current_filter_top = current_filter_top_margin - new_window_scroll_position_top;

        $("#main-modal-content").css({"left":modal_content_margin_left+"px", "top":modal_content_margin_top+"px"});
        
        $("#filter").css({"left":filter_left+"px", "top":filter_top+"px"});
        
        $("#current-filters").css({"left":current_filter_left+"px", "top":current_filter_top+"px"});
        
    });
    
    $(".add-new-bttn").click(function(){
        
        if($(".content").attr("id") != "schedules-content"){
           
            initialize_modal_guide_on_event("add_new_bttn_clicked", "add-new-modal-guide.php");
        
        }else{
                             
            initialize_modal_guide_on_event("add_new_schedule_bttn_clicked", "add-new-schedule-modal-guide.php");
    
        }
        
    });
    
    adjusting_table_columns(main_title);
    
     $(window).resize(function(){
        
        if(main_title == "Clients"){adjust_columns_for_clients_table();}

        if(main_title == "Schedules"){adjust_columns_for_schedules_table();}

        if(main_title == "Staff"){adjust_columns_for_staff_table();}
        
    });

    $(".show-current-filters-bttn").click(function(){
        
       $("#current-filters-wrapper").css({"display":"block"});
        
        adjust_current_filters_by_window_size();
        
        $(window).resize(function(){
			
			adjust_current_filters_by_window_size();
			
		});
        
        initialize_modal_guide_on_event("current-filters-bttn-clicked", "current-filters-modal-guide.php");
        
    });
    
    $(".show-current-filters-bttn").mouseover(function(){
        
        $(".show-current-filters-bttn").removeClass("show-current-filters-bttn-animation");
        
    });
    
    $(".show-current-filters-bttn").mouseleave(function(){
        
        $(".show-current-filters-bttn").addClass("show-current-filters-bttn-animation");
        
    });
    
    var current_filters_showing;
    
    $("#current-filters").click(function(){

        current_filters_showing = true;

    });
        
    $("#current-filters-wrapper").click(function(){
        
        if((current_filters_showing == false) || (current_filters_showing == undefined)){
            
            $("#current-filters-wrapper").css({"display":"none"});
        
        }
        
        current_filters_showing = false;

    });
	
    var is_filter_on;
	
	$(".filter-bttn").click(function(){
        
        $("#filter").load("filter-content.php", function(){
            
            check_activity_for_filter();
            
            $("#filter-wrapper").css({"display":"block"});
            
            if(!$("#modal-guide").hasClass("display-none")){
                
                var filter_width = parseInt($("#filter").css("width"));
                
                var modal_guide_left =  $("#filter").offset().left + filter_width + 250;
                
                $("#modal-guide").css({"left":modal_guide_left+"px", "margin-right":"auto"});
               
            }
		
		    adjust_filter_by_window_size();
            
            $("#filter form select").change(function(){
                
                is_filter_on = filter_form_ajax(is_filter_on, main_title);
                
                initialize_modal_guide_on_event("filter-guide-selected-bttn-clicked", "filter-selected-modal-guide.php");
    
            });
            
            $("#filter .filter-time input").keyup(function(evt){
                
                var time = $(this).val();
                
                var time_length = time.length;
                
                for(var i = 0; i < time_length; i++){
                    
                    if(!$.isNumeric(time[i]) && time[i] != ":"){
                       
                        $(this).val("");
                        
                        break;
                        
                    }
                    
                }
		
		        if(evt.keyCode != 8){
                    
                    if(time.length == 2){
			
				        time += ":";
			
				        $(this).val(time);
			         }
		
		          }
                
            });
            
            $("#filter form input").focusout(function(){
                
                if($(this).closest(".input-label-wrapper").hasClass("filter-time")){
                    
                    var time = $(this).val();
                     
                    if(time.length == 4){
            
                        var hour = time[0] + time[1];
            
                        var min = time[2] + time[3];
            
                        var new_time = hour+":"+min;
            
                        $(this).val(new_time);
           
                    }else if(time.length != 5){
                        
                        $(this).val("");
                        
                        return false;
                        
                    }
                   
                }
                
                is_filter_on = filter_form_ajax(is_filter_on, main_title);
    
            });
            
        });
		
		$(window).resize(function(){
			
			adjust_filter_by_window_size();
			
		});

	});
    
    var filter_showing;
    
    $("#filter").click(function(){

        filter_showing = true;

    });
        
    $("#filter-wrapper").click(function(){
             
        if((filter_showing == false) || (filter_showing == undefined)){close_add_filters_modal();}
        
        filter_showing = false;

    });
    
   	load_modal_from_table_link();
	
	$(".main-content #delete-bttn").click(function(){
		
		var checked_rows = 0;
		
		$(".main-content .table-part-2 .table-row input[type='checkbox']:checked").each(function(){
			
			checked_rows++;
			
		});
        
        var these_or_this = (checked_rows > 1) ? "these" : "this";
        
        var items_or_item = (checked_rows > 1) ? "items" : "item";
        
        var delete_message = (main_title == "Schedules" || main_title == "Tasks") ? "Are you sure you want delete "+these_or_this+" "+checked_rows+" "+items_or_item+"?" : "Are you sure you want delete "+these_or_this+" "+checked_rows+" "+items_or_item+"? This will also delete any connecting schedules associated with "+these_or_this+" "+checked_rows+" "+items_or_item+".";
		
		if(checked_rows > 0){
			
			if(confirm(delete_message)){
				
				var id;
				
				var id_set = "";
				
				$(".main-content .table-part-2 .table-row input[type='checkbox']:checked").each(function(){
					
					id = $.trim($(this).closest(".table-row").find(".display-none").text());
					
					id_set = id_set+"'"+id+"'"+",";
					
				});
				
				id_set = id_set.slice(0, -1);
			
				var checked_rows = $(".main-content .table-part-2 .table-row input[type='checkbox']:checked").closest(".table-row");
					
				$.ajax({
						
					url: "delete-multiple-records.php",
					method: "POST",
					data:{id_set: id_set},
					dataType: "html",
					success: function(data, status, response){

						if((status == "success") && (response.readyState == 4) && (data == true)){
								
							checked_rows.css({"background-color":"red"});

							checked_rows.fadeOut(500);

							setTimeout(function(){

							checked_rows.remove();

							}, 1000);
				
                        }else if(data == 100){
                            
                           location.reload(); 
                                 
                        }else{

							ajax_success_error_message(data);

						}
							
					}
								
				});
				
			}
			
		}
        
	});
     
    delete_link_in_table(main_title);
	
	person_link_click();
	
    checkbox_click_in_table();
    
	$(".table-part-1 .sort-column").click(function(){
        
        check_activity();
        
        is_filter_on = check_if_filter_link_exists();
		
		is_sort_asc = $(this).attr("data-sort-asc");
		
		column_number = $(this).attr("data-column-number");
		
		column_name = $.trim($(this).find(".column-title").text());
        
        var search = $(".search").val();
		
		$(".sort-column .sort-symbol").html("");
		
		$(".table-part-2 .table-cell").removeClass("sorted-column");
		
		switch(is_sort_asc){
				
			case "":
				
				$(this).attr("data-sort-asc", "true");
				
				$(this).find(".sort-symbol").html("&#x25B2;");
				
				break;
			
			case "true":
				
				$(this).attr("data-sort-asc", "false");
				
				$(this).find(".sort-symbol").html("&#x25BC;");
				
				break;
				
			case "false":
				
				$(this).attr("data-sort-asc", "true");
				
				$(this).find(".sort-symbol").html("&#x25B2;");
				 
				break;
			
			default:
				
				$(this).attr("data-sort-asc", "true");
				
				$(this).find(".sort").html("&#x25B2;");
				
		}
		
		is_sort_asc = $(this).attr("data-sort-asc");

        var GET_variables = GET_variables_for_tables(is_sort_asc, column_name);
		
		ajax_for_filter_sort_search(GET_variables, is_filter_on, column_number, is_sort_asc, column_name, main_title);
		
	});
    
    $(".search").keyup(function(){
        
        is_filter_on = check_if_filter_link_exists();
        
        var GET_variables = GET_variables_for_tables(is_sort_asc, column_name);
		
		ajax_for_filter_sort_search(GET_variables, is_filter_on, column_number, is_sort_asc, column_name, main_title);

	});
    
    $(".logout-bttn").click(function(){
        
        sessionStorage.clear();
        
    });
    
    change_link_color_in_table_body();

}());