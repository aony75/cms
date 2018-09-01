var is_sort_asc;
var column_name;
var column_number;

/**********************************************/
            //mobile menu
/*********************************************/
function mobile_menu(){
    
    //opens mobile navigation  
    $("#mobile-icon").click(function(evt){
        
        //evt.preventDefault() makes sure javascript overiddes css
        evt.preventDefault();
        
        $(".mobile-navigation-modal-container").css("display", "block");
        $("#mobile-navigation").animate({marginRight: "0"}, 200);
        
    });
        
    //closes mobile navigation
    $("#close-icon").click(function(){
        
        $(".mobile-navigation-modal-container").css("display", "none");
        $("#mobile-navigation").animate({marginRight: "-200%"}, 200);
        
    });
    
    //closes mobile navigation on click of container
    $(".mobile-navigation-modal-container").click(function(){
        
        $(".mobile-navigation-modal-container").css("display", "none");
        $("#mobile-navigation").animate({marginRight: "-200%"}, 200);
        
    });
}


/**********************************************/
            //dropdown menu content
/*********************************************/
function dropdown_menu_content(){
    $("#payroll-menu").hover(function(){
            $("#payroll-menu-dropdown").css("display", "block");

        }, function(){
            $("#payroll-menu-dropdown").css("display", "none");
        });

         $("#user-menu").hover(function(){
            $("#user-menu-dropdown").css("display", "block");

        }, function(){
            $("#user-menu-dropdown").css("display", "none");
        });
}


/**********************************************/
            //payoll calandar
/*********************************************/
function payroll_calandar(year){
    
    // esablishes date as jan 1st and starts on first row of calandar
    var month = 0;
    var day = 1;
    var row = 1;
    
    //sizes and colors all cells of calandar
    $("#calandars td").css("background-color", "transparent");
    $("#calandars td").css("color", "transparent");
    $("#calandars td").html("d");
     
    //sets months for payroll dates table and clears previous days
    $("#calandar-legend-table tr:nth-child(2) td:nth-child(1)").html("Jan");
    $("#calandar-legend-table tr:nth-child(3) td:nth-child(1)").html("Feb");
    $("#calandar-legend-table tr:nth-child(4) td:nth-child(1)").html("Mar");
    $("#calandar-legend-table tr:nth-child(5) td:nth-child(1)").html("Apr");
    $("#calandar-legend-table tr:nth-child(6) td:nth-child(1)").html("May");
    $("#calandar-legend-table tr:nth-child(7) td:nth-child(1)").html("Jun");
    $("#calandar-legend-table tr:nth-child(8) td:nth-child(1)").html("Jul");
    $("#calandar-legend-table tr:nth-child(9) td:nth-child(1)").html("Aug");
    $("#calandar-legend-table tr:nth-child(10) td:nth-child(1)").html("Sept");
    $("#calandar-legend-table tr:nth-child(11) td:nth-child(1)").html("Oct");
    $("#calandar-legend-table tr:nth-child(12) td:nth-child(1)").html("Nov");
    $("#calandar-legend-table tr:nth-child(13) td:nth-child(1)").html("Dec");
    $("#calandar-legend-table td:nth-child(2)").html("");
     
    //sets date as year the user enters 01/01/year entered
    var start_date = new Date(year, month, day);
    
    //initializes year for loop
    var start_year = year;
    
    //once calandar is created loop stops
    while(start_year == year) {
        
        //sets dates for comparison
        var pay_day = new Date(2017, 0, 13);
        var end_of_pay_period = new Date(2017, 0, 1);
        var start_of_pay_period = new Date(2017, 0, 2);
        start_date = new Date(year, month, day);
         
        weekday = start_date.getDay();
        day = start_date.getDate();
        month = start_date.getMonth();
        year = start_date.getFullYear();
                
        //if day gets to new year loop ends       
        if(start_year < year){
            break;
        }
        
        //sets variables for months and days
        var calandars_tables = document.getElementsByTagName("table")[month];
        var calandar_legend_table = document.getElementById("calandar-legend-table");
        var calandar_legend_table_row = calandar_legend_table.getElementsByTagName("tr")[month + 1];
        
        //goes to 1st row of calandar if day it is a new month
        if(day == 1) {
            row = 1;
        }
        
        //prints day for calandars and makes sure font is black
        calandars_tables.getElementsByTagName("tr")[row].children[weekday].innerText = day;
        calandars_tables.getElementsByTagName("tr")[row].children[weekday].style.color = "#000";
             
        var pay_period_in_milliseconds = 1000 * 60 * 60 * 24 * 14;
        var day_in_milliseconds = 1000 * 60 * 60 * 24;
                
        //finds pay date, end of pay period, start of pay period       
        var is_pay_day = (Math.abs(pay_day - start_date)) % pay_period_in_milliseconds;
        if(Math.ceil(is_pay_day /day_in_milliseconds) == 14 ){
            is_pay_day = 0;
        }
        var is_start_of_pay_period = (Math.abs(start_of_pay_period - start_date)) % pay_period_in_milliseconds;
        if(Math.ceil(is_start_of_pay_period /day_in_milliseconds) == 14 ){
            is_start_of_pay_period = 0;
        }
        var is_end_of_pay_period = (Math.abs(end_of_pay_period - start_date)) % pay_period_in_milliseconds;
        if(Math.ceil(is_end_of_pay_period /day_in_milliseconds) == 14 ){
            is_end_of_pay_period = 0;
        }
                
        //prints pay day, start of pay period, end of pay period        
        if(is_pay_day == 0){
            calandars_tables.getElementsByTagName("tr")[row].children[weekday].style.backgroundColor = "green";
            calandar_legend_table_row.getElementsByTagName("td")[1].innerHTML += "&nbsp;"+"&nbsp;"+day+"&nbsp;"+"&nbsp;"+"/";
                
        }else if(is_start_of_pay_period == 0){
            calandars_tables.getElementsByTagName("tr")[row].children[weekday].style.backgroundColor = "yellow";
                
        }else if(is_end_of_pay_period == 0){
            calandars_tables.getElementsByTagName("tr")[row].children[weekday].style.backgroundColor = "red";
        }
                
        //goes to next row in calandar if its saturday       
        if(weekday == 6) {
            row++;
        }
        
        //goes to next day
        day++;
                
    }
    
    //deletes last "/" for each month in calandar legend
    for(var i = 1; i <= 12; i++){
        
        var calandar_days = calandar_legend_table.getElementsByTagName("tr")[i].children[1].innerText;
        calandar_days = calandar_days.slice(0, -1);
        calandar_legend_table.getElementsByTagName("tr")[i].children[1].innerText = calandar_days;
    }
    
    //takes year back to original year that user requested
    year--;
         
}


/**********************************************/
            //select all in table for modal
/*********************************************/
function select_all_in_table_for_modal() {
        
        var checked;
        
        //if parent check box is checked then all will be clicked. if parent check box unchecked all wil be un checked
        $(".table-part-1 input[type='checkbox']").click(function(){

            if((checked == 0) || (checked == undefined)){

                $(".table-part-2 input[type='checkbox']").prop("checked", true);
                checked = 1;

            }else if(checked == 1){

                $(".table-part-2 input[type='checkbox']").prop("checked", false);
                checked = 0;
            }

        });
    }


/**********************************************/
            //select all in table
/*********************************************/
function select_all_in_table() {
        
        var checked;
        
        //if parent check box is checked then all will be clicked. if parent check box unchecked all wil be un checked
        $(".table-part-1 input[type='checkbox']").click(function(){

            if((checked == 0) || (checked == undefined)){

                $(".table-part-2 input[type='checkbox']").prop("checked", true);
                checked = 1;

            }else if(checked == 1){

                $(".table-part-2 input[type='checkbox']").prop("checked", false);
                checked = 0;
            }

        });
    }


/**********************************************/
            //close modal
/*********************************************/
function close_modal(loaded_form_values) {

    $("#main-modal .modal-close-icon").click(function(){
		
		var number_of_changed_form_values = 0;
		var changed_form_values = collect_input_checkbox_select_values();
		var number_of_form_inputs = loaded_form_values[0].length;
		var number_of_form_selects = loaded_form_values[2].length;
		var number_of_form_textareas = loaded_form_values[3].length;
		
	   	for(var i = 0; i < number_of_form_inputs; i++){
			
			if(loaded_form_values[0][i] != changed_form_values[0][i]){
				
				number_of_changed_form_values++;
				
			}
			
	   	}
		
		if(loaded_form_values[1] != changed_form_values[1]){
				
				number_of_changed_form_values++;
				
		}

		for(var i = 0; i < number_of_form_selects; i++){
			
			if(loaded_form_values[2][i] != changed_form_values[2][i]){
				
				number_of_changed_form_values++;
				
			}
			
	   	}

		for(var i = 0; i < number_of_form_textareas; i++){
			
			if(loaded_form_values[3][i] != changed_form_values[3][i]){
				
				number_of_changed_form_values++;
				
			}
			
	   	}
        
        var is_save_bttn_clicked = $("#main-modal").attr("data-save-bttn-clicked");
        
        var incorrect_input = $(".number-of-correct-inputs").attr("data-incorrect-input");

        if((number_of_changed_form_values > 0) && (is_save_bttn_clicked != "true" || incorrect_input > 0)){
		
            if(confirm("Any changes will not be saved if you continue.")){
				
				$("#modal-header-bar h4").text("");
                
                $("#main-modal .modal-body").remove();
				
                $(".modal-content").css("display", "none");
                
                close_modal_properties();
				
            }
			
        }else{
			
			$("#modal-header-bar h4").text("");
            
            $("#main-modal .modal-body").remove();
			
            $(".modal-content").css("display", "none"); 
            
            close_modal_properties();
			
        }
        
        $("#main-modal-content").css({"left":"0", "top":"0"});

    });
	
}


/**********************************************/
            //close modal properties
/*********************************************/
function close_modal_properties() {

    var href = $(".modal").attr("data-last-href");
		
    $(".modal").attr("data-last-href", "");
		
    $(".modal").attr("data-person-link-clicked", false);
		
    $(".modal").attr("data-person-description", "");
        
    $(".modal").attr("data-save-bttn-clicked", "");
    
    $("#main-modal").attr("data-schedule-id", "");
    
    if(typeof(Storage) !== undefined){
        
        $("#modal-guide").addClass("display-none");
        
        $("#main-modal").attr("data-data-modal-guide-bottom", "");
    
        if($("#modal-guide").hasClass("load-new-guide-content-animation")){
    
            $("#modal-guide").removeClass("load-new-guide-content-animation");
    
        }
        
        $("#modal-guide").css({"top":"35%", "right":"30%"});
        
        if(typeof(Storage) !== undefined){
        
            var onready_guide_variable = sessionStorage.getItem(sessionStorage.name_of_onready_guide_session_variable);

            if(onready_guide_variable == "false"){

                initialize_modal_guide("onready-modal-guide.php", "onready-modal-guide-animation",  sessionStorage.name_of_onready_guide_session_variable);

            }
        
        }
        
    }

}


/**********************************************/
            //close modal through ajax
/*********************************************/
function close_modal_through_ajax() {

    $("#modal-header-bar h4").text("");
				
    $(".modal-content").css("display", "none"); 
						
	$(".modal").attr("data-last-href", "");
		
	$(".modal").attr("data-person-link-clicked", false);
		
	$(".modal").attr("data-person-description", "");
		
	$("#main-modal .modal-body").remove();
	
}


/**********************************************/
     //collect input checkbox select values
/*********************************************/
function collect_input_checkbox_select_values() {

	var counter = 0;
	
	var form_input = [];
	
	$(".modal form input[type='text']").each(function() {
		
		form_input[counter] = $(this).val();
		
		counter++;
			
	});
	
	var form_input_checkbox = 0;
        
   	$(".modal form input[type='checkbox']:checked").each(function() {
            
   		form_input_checkbox++;
            
   	});
	
	counter = 0;
	
	var form_select = [];
        
    $(".modal form select").each(function() {
		
		form_select[counter] = $(this).val();
		
		counter++;
            
    });
	
	counter = 0;
	
	var form_textarea = [];
        
    $(".modal form textarea").each(function() {
		
		form_textarea[counter] = $(this).val();
		
		counter++;
            
    });
	
	return [form_input, form_input_checkbox, form_select, form_textarea];
	
}


/**********************************************/
            //print mailing list
/*********************************************/
function print_mailing_list() {
    
    $("#mailing-list-printer-icon").click(function(evt){
        
        evt.preventDefault();
        
        //$(".modal").css({"width":"100%", "height":"auto"});
        //$(".modal-content").css({"z-index": "0", "position": "static","height":"auto"});
        $("#main-container").css({"display": "none"});
        $(".content, #navigation, .footer").css({"display": "none"});
        
        window.print();
        
        //$(".modal").css("width", "60%");
        //$(".modal-content").css({"z-index": "1", "position": "fixed"});
        $("#main-container").css({"display": "block"});
        $(".content, #navigation, .footer").css({"display": "block"});
        
    });
}

/**********************************************/
            //modal table css default
/*********************************************/
function modal_table_css_default() {
    
    $(".table-part-2 .id-column").css({"width":"5%"});
    $(".table-part-2 .staff-column").css({"width":"25%"});
    $(".table-part-2 .wk1-expected-column").css({"width":"10%"});
    $(".table-part-2 .wk1-actual-column").css({"width":"10%"});
    $(".table-part-2 .section-breaker-column").css({"width":"5%"});
    $(".table-part-2 .wk2-expected-column").css({"width":"10%"});
    $(".table-part-2 .wk2-actual-column").css({"width":"10%"});
    $(".table-part-2 .total-column").css({"width":"10%"});
    $(".table-part-2 .delete-column").css({"width":"4%"}); 
}

/**********************************************/
            //print
/*********************************************/
function load_print_window() {
    
    $(".printer-icon").click(function(){
        
        window.print();
        
    });
}


/**********************************************/
            //modal height
/*********************************************/
function modal_height() {
    
    $(".modal-body").css({"height":"auto"});

}


/**********************************************/
            //validate number input
/*********************************************/
function validate_number_input(number) {
    
    if($.isNumeric(number) && number != ""){
                   
        return true;
                    
    }else{
                    
        return false;
                    
    }
    
}


/**********************************************/
            //activate edit form
/*********************************************/
function activate_edit_form() {
    
    if($(".edit-wrapper input[type='checkbox']").prop("checked")){
		
		$("#modal-header-bar input[type='submit']").removeClass("display-none");
		
		$(".modal-body form input").prop("disabled", false);
            
        var page_title = document.title;
            
        $(".modal-body form select").each(function(){
               
            $(this).prop("disabled", false);
                 
            var page_title = document.title;
                
            if(page_title == "EQH-Schedule By Client"){
                    
                $("#client-select").prop("disabled", true);
                    
            }else if(page_title == "EQH-Schedule By Staff"){
                    
                $("#staff-select").prop("disabled", true);
                    
            }
               
        });
        
        $(".modal-body form textarea").prop("disabled", false);
            
    }else{
		
		$("#modal-header-bar input[type='submit']").addClass("display-none");
		
		$(".modal-body form input").prop("disabled", true);
            
		$(".modal-body form select").prop("disabled", true);
        
        $(".modal-body form textarea").prop("disabled", true);
        
    }
    
}


/**********************************************/
        //change link color in table body 
/*********************************************/
function change_link_color_in_table_body() {

    $(".table-part-2 .table-row").on("mouseover", function(){

        $(this).find("a").css({"color":"#fff"});

    });
    
    $(".table-part-2 .table-row").on("mouseout", function(){
        
        $(this).find("a").css({"color":"blue"});

    });

}


/**********************************************/
        //load modal from table link 
/*********************************************/
function load_modal_from_table_link() {

    $(".main-content .table-part-2 .table-row").off("click").on("click", function(){
        
		var href = $(this).attr("data-href");
			   
		var schedule_id = $.trim($(this).find(".schedule-id").text());
       
        $("#main-modal").attr("data-schedule-id", schedule_id);
        
        load_modal_from_table_link();
        
		if_statement_for_loading_modal(href, schedule_id);

	});
	
	$(".modal .table-row").on("click", function(){
		
		var href = $(this).attr("data-href");
        
        var schedule_id = $(this).attr("data-schedule-id");
        
        $("#main-modal").attr("data-schedule-id", schedule_id);
		
		/*do not replace with if_statement_for_loading_modal(href) function. This if statment is different.*/
		if(href){
			 
        	$("#main-modal-content").css({"display":"block"});
        
        	$("#main-modal").load(href, function(){
                
                initialize_modal_guide_on_event("show_schedule_clicked", "show-schedule-modal-guide.php");
                
                check_activity_for_show_content();
				
				change_link_color_in_table_body();
				
				load_modal_from_table_link();
				
				back_link_to_show_content();
                
                if($(".modal-body").attr("id") == "show-schedule-modal-body"){
				
                    var schedule_id = $("#main-modal").attr("data-schedule-id");
                    
                    var modal_title = $.trim($("#modal-header-bar h4").text());
				    
                    $("#modal-header-bar h4").text(modal_title+" - "+schedule_id);
		
			     }
		
			});
			
		}

	});

}

/**********************************************/
        //if statement for loading modal 
/*********************************************/
function if_statement_for_loading_modal(href, schedule_id) {

	if(href){
        
        $("#main-modal").load(href, function(){
            
            if($(".content").attr("id") == "schedules-content" && $("#main-modal .modal-body").attr("id") == "show-schedule-modal-body"){
            
                initialize_modal_guide_on_event("show_schedule_clicked", "show-schedule-modal-guide.php");
            
            }else{
                
                initialize_modal_guide_on_event("table_row_clicked", "table-row-clicked-modal-guide-info.php");

            }
            
            check_activity_for_show_content();
            
            $("#main-modal-content").css({"display":"block"});
            
            adjust_modal_guide_by_add_new_bttn();
                              
			change_link_color_in_table_body();
				
			load_modal_from_table_link();
				
			back_link_to_show_content();
			
			var main_title = $.trim($(".main-title-wrapper h1").text());
            
            var modal_title = $.trim($("#modal-header-bar h4").text());
            
			if($(".modal-body").attr("id") == "show-schedule-modal-body"){
				
				$("#modal-header-bar h4").text(modal_title+" - "+schedule_id);
		
			}
            
            if(modal_title == "Task Assigned"){
                
                modal_height();
               
            }
				
		});
    
		$(".modal").attr("data-last-href", href);
			
	}
	
}


/**********************************************/
        //back link to show content
/*********************************************/
function back_link_to_show_content() {
	
	var back_link_text = $.trim($(".main-title-wrapper h1").text());
			
	if(back_link_text == "Clients"){
				
		back_link_text = "Client";
				
	}
	
	if(back_link_text == "Schedules"){
				
		back_link_text = $("#main-modal").attr("data-person-description");
				
	}
			
	$("#back-bttn").append(back_link_text);

}


/**********************************************/
        //add new schedule bttn in modal
/*********************************************/
function add_new_schedule_bttn_in_modal() {
	
    $("#main-modal .modal-body #add-new-schedule").on("click", function(evt){
        
        var main_title = $.trim($(".main-title-wrapper h1").text());        
        
        var id_type =  (main_title == "Schedules") ? $("#main-modal").attr("data-person-description").toLowerCase() : (main_title == "Clients") ? "client" : "staff";
        
        var id = $.trim($("#main-modal .display-none").text());
  
        $("#main-modal").load("new-schedule.php?"+id_type+"_"+"id="+id, function(){
           
            check_activity_for_show_content();
            
             initialize_modal_guide_on_event("add_new_schedule_bttn_clicked", "add-new-schedule-modal-guide.php");
            
            $("#main-modal-content").css({"display":"block"});
            
             var modal_title = $.trim($("#modal-header-bar h4").text());
            
            var person;
            
            if(id_type == "client" && $("#main-modal form select[name='client'] option:selected").val() != ""){
                
                $("#main-modal form select[name='client']").prop("disabled", true);
                
                person = $.trim($("#main-modal form select[name='client'] option:selected").text());
                
            }else if(id_type == "staff" && $("#main-modal form select[name='staff'] option:selected").val() != ""){
                
                $("#main-modal form select[name='staff']").prop('disabled', true);
                
                person = $.trim($("#main-modal form select[name='staff'] option:selected").text());
                
            }
            
            var evv_id = person.substr(person.indexOf(" -"));
    
            person = ~ person.indexOf(" -") ? person.replace(evv_id, "") : person;
            
            $("#modal-header-bar h4").text(modal_title+" - "+person);
			
			back_link_to_show_content();
			
		});
        
    });

}


/**********************************************/
     //display textarea remaining characters
/*********************************************/
function display_remaining_characters(textarea) {
	
	var character_max = $(textarea).attr("maxlength");
		
	var characters_remaining = character_max - $(textarea).val().length;
		
	$(textarea).parent().find(".character-count").text(characters_remaining);
		
	(characters_remaining < 40) ? $(".character-count").css({"color":"red"}) : $(".character-count").css({"color":"green"});
	
}


/**********************************************/
     //ajax success error message
/*********************************************/
function ajax_success_error_message(data) {
	
	if(!$.isNumeric(data)){data = "with ajax";}
	
	alert("Something went wrong. Error "+data);
					
	location.reload();
	
}


/**********************************************/
     //update client row
/*********************************************/
function update_client_row(id) {
							
	var evv_id = $("#show-client-modal-body input[name='evv_id']").val();

	var first_name = $("#show-client-modal-body input[name='first_name']").val();

	var last_name = $("#show-client-modal-body input[name='last_name']").val();

	var amerigroup_number = $("#show-client-modal-body input[name='amerigroup_number']").val();

	var medicaid_id = $("#show-client-modal-body input[name='medicaid_id']").val();

	var phone_number = $("#show-client-modal-body input[name='phone_number']").val();

	var selected_row = $(".main-content .table-part-2").find("."+id).closest(".table-row");

	selected_row.find(".evv-id-cell").text(evv_id);

	selected_row.find(".person").text(last_name+", "+first_name);

	amerigroup_number = (amerigroup_number == "") ? "not entered" : amerigroup_number;

	selected_row.find(".amerigroup-cell").text(amerigroup_number);

	medicaid_id = (medicaid_id == "") ? "not entered" : medicaid_id;

	selected_row.find(".medicaid-cell").text(medicaid_id);

	phone_number = (phone_number == "") ? "not entered" : phone_number;

	selected_row.find(".phone-number-cell").text(phone_number);
	
}


/**********************************************/
     //update staff row
/*********************************************/
function update_staff_row(id) {
							
	var evv_id = $("#show-staff-modal-body input[name='evv_id']").val();

	var first_name = $("#show-staff-modal-body input[name='first_name']").val();

	var last_name = $("#show-staff-modal-body input[name='last_name']").val();

	var mail = $("#show-staff-modal-body select[name='mail']").val();

	var pay_rate = $("#show-staff-modal-body input[name='pay_rate']").val();

	var phone_number = $("#show-staff-modal-body input[name='phone_number']").val();

	var selected_row = $(".main-content .table-part-2").find("."+id).closest(".table-row");

	selected_row.find(".evv-id-cell").text(evv_id);

	selected_row.find(".person").text(last_name+", "+first_name);

	selected_row.find(".mail-cell").text(mail);

	pay_rate = (pay_rate == "") ? "not entered" : pay_rate;

	selected_row.find(".pay-rate-cell").text(pay_rate);

	phone_number = (phone_number == "") ? "not entered" : phone_number;

	selected_row.find(".phone-number-cell").text(phone_number);
	
}


/**********************************************/
     //update staff row
/*********************************************/
function update_schedule_row(id) {

	var client = $.trim($("#show-schedule-modal-body select[name='client'] option:selected").text());
    
    var client_id = (~ client.indexOf(" -")) ? client.substr(client.indexOf(" -")) : "";
    
    client = client.replace(client_id, "");
    
    

	var staff = $.trim($("#show-schedule-modal-body select[name='staff'] option:selected").text());
    
    var staff_id = (~ staff.indexOf(" -")) ? staff.substr(staff.indexOf(" -")) : "";
    
    staff = staff.replace(staff_id, "");
    

    
	var sun_in = $("#show-schedule-modal-body input[name='sun_in']").val();
    var sun_out = $("#show-schedule-modal-body input[name='sun_out']").val();
    var sun_time = ((sun_in != "") && (sun_out != "")) ? sun_in+"-"+sun_out : "";
    
    var mon_in = $("#show-schedule-modal-body input[name='mon_in']").val();
    var mon_out = $("#show-schedule-modal-body input[name='mon_out']").val();
    var mon_time = ((mon_in != "") && (mon_out != "")) ? mon_in+"-"+mon_out : "";
    
    var tues_in = $("#show-schedule-modal-body input[name='tues_in']").val();
    var tues_out = $("#show-schedule-modal-body input[name='tues_out']").val();
    var tues_time = ((tues_in != "") && (tues_out != "")) ? tues_in+"-"+tues_out : "";
    
    var wed_in = $("#show-schedule-modal-body input[name='wed_in']").val();
    var wed_out = $("#show-schedule-modal-body input[name='wed_out']").val();
    var wed_time = ((wed_in != "") && (wed_out != "")) ? wed_in+"-"+wed_out : "";
    
    var thurs_in = $("#show-schedule-modal-body input[name='thurs_in']").val();
    var thurs_out = $("#show-schedule-modal-body input[name='thurs_out']").val();
    var thurs_time = ((thurs_in != "") && (thurs_out != "")) ? thurs_in+"-"+thurs_out : "";
    
    var fri_in = $("#show-schedule-modal-body input[name='fri_in']").val();
    var fri_out = $("#show-schedule-modal-body input[name='fri_out']").val();
    var fri_time = ((fri_in != "") && (fri_out != "")) ? fri_in+"-"+fri_out : "";
    
    var sat_in = $("#show-schedule-modal-body input[name='sat_in']").val();
    var sat_out = $("#show-schedule-modal-body input[name='sat_out']").val();
    var sat_time = ((sat_in != "") && (sat_out != "")) ? sat_in+"-"+sat_out : "";
    
	var selected_row = $(".main-content .table-part-2").find("."+id).closest(".table-row");

	selected_row.find(".staff-name-column a").text(staff);
    selected_row.find(".client-name-column a").text(client);
    
    selected_row.find(".sun-cell").text(sun_time);
    
    selected_row.find(".mon-cell").text(mon_time);
    
    selected_row.find(".tues-cell").text(tues_time);
    
    selected_row.find(".wed-cell").text(wed_time);
    
    selected_row.find(".thurs-cell").text(thurs_time);
    
    selected_row.find(".fri-cell").text(fri_time);
    
    selected_row.find(".sat-cell").text(sat_time);

}


/**********************************************/
     //adjust filter by window size
/*********************************************/
function adjust_filter_by_window_size() {
	
	var filter_left_margin = $(".filter-bttn").offset().left;
		
	var filter_top_margin = $(".filter-bttn").offset().top;

	$("#filter").css({"left": filter_left_margin, "top": filter_top_margin});
	
}


/**********************************************/
     //adjust current filters by window size
/*********************************************/
function adjust_current_filters_by_window_size() {
	
	var filter_left_margin = $(".show-current-filters-bttn").offset().left - 150;
		
	var filter_top_margin = $(".show-current-filters-bttn").offset().top;

	$("#current-filters").css({"left": filter_left_margin, "top": filter_top_margin});
	
}


/**********************************************/
     //close add filters modal
/*********************************************/
function close_add_filters_modal() {
	
    $("#filter form").remove();
   
    $("#filter-wrapper").css({"left":"0", "top":"0", "display":"none"});
	
}


/**********************************************/
     //GET variables for tables
/*********************************************/
function GET_variables_for_tables(is_sort_asc, column_name) {
	
    return $("#filter form").serialize()+"&"+$("#current-filters form").serialize()+"&is_sort_asc="+is_sort_asc+"&column_name="+column_name;
	
}


/**********************************************/
     //ajax for filter sort search
/*********************************************/
function ajax_for_filter_sort_search(GET_variables, is_filter_on, column_number, is_sort_asc, column_name, main_title) {
   
    $(".table-part-2").load("ajax-loader.php", function(){
        
        var search = $(".search").val();
                    
        $.ajax({

            url: "filter-sort-search-table.php",
            method: "GET",
            data: GET_variables+"&search="+search,
            dataType: "html",
            success: function(data, status, response){
                
                if(data == ""){location.reload();}

                if((status == "success") && (response.readyState == 4)){
                                
                    if(is_filter_on == true){
                
                        $(".show-current-filters-bttn").removeClass("display-none");

                        $("#current-filters-body").html("");

                        $("#current-filters form input").each(function(){

                            var current_filter_value = $(this).val();

                            var current_filter_name = $(this).attr("name");

                            var filter_name = current_filter_name.substr(15);

                            filter_name = filter_name.replace(/_/, " ").toUpperCase();

                            if($(this).attr("data-option-text")){

                                current_filter_value = $(this).attr("data-option-text");

                            }

                            if(current_filter_value != ""){

                                $("#current-filters-body").append("<div class='filter-link' data-current-filter-name='"+current_filter_name+"'><p>"+filter_name+": "+current_filter_value+" </p><a href='#'>&#10006;</a></div>");

                            }

                        });
                                   
                    }
                    
                    $(".filter-link a").on("click", function(){
                         
                        var current_filter_name = $(this).closest(".filter-link").attr("data-current-filter-name");
                        
                        $("#current-filters form input[name='"+current_filter_name+"']").val("");
                        
                        if($("#current-filters form input[name='"+current_filter_name+"']").attr("data-option-text")){

                           $("#current-filters form input[name='"+current_filter_name+"']").attr("data-option-text", "");

                        }

                        $(this).closest(".filter-link").remove();
                       
                        is_filter_on = check_if_filter_link_exists();
                        
                        if(is_filter_on !== true && typeof(Storage) !== undefined){ 
                            initialize_modal_guide_on_event(sessionStorage.name_of_onready_guide_session_variable, "onready-modal-guide.php");
                            
                        }
                  
                        var GET_variables = GET_variables_for_tables(is_sort_asc, column_name);
                        
                        ajax_for_filter_sort_search(GET_variables, is_filter_on, column_number, is_sort_asc, column_name, main_title);
        
                    });

                    $(".table-part-2").html(data);
                    
                    person_link_click();
                    
                    adjusting_table_columns(main_title);
                
                    $(window).resize(function(){
        
                        if(main_title == "Clients"){adjust_columns_for_clients_table();}

                        if(main_title == "Schedules"){adjust_columns_for_schedules_table();}

                        if(main_title == "Staff"){adjust_columns_for_staff_table();}
        
                    });
                               
                    close_add_filters_modal();
                    
                    table_row_click();
                    
                    checkbox_click_in_table();
                    
                    delete_link_in_table(main_title);
                               
                    if(column_number != undefined){
                                
				        $(".table-part-2 .table-cell[data-column-number='"+column_number+"']").addClass("sorted-column");
                               
                    }
                   
                }else{

                    ajax_success_error_message(data);

                }

            }

        });
                    
    });
    
}


/**********************************************/
     //check if filter link exists
/*********************************************/
function check_if_filter_link_exists() {
			
    if($(".filter-link").length == 0){
                        
        $("#current-filters-wrapper").css({"display":"none"});
                        
        $(".show-current-filters-bttn").addClass("display-none");
        
        return false;
                        
    }else{
        
        return true;
        
    }
	
}


/**********************************************/
     //table row click
/*********************************************/
function table_row_click() {
			
    load_modal_from_table_link();
			
    change_link_color_in_table_body();	
	
}


/**********************************************/
     //person link click
/*********************************************/
function person_link_click() {
	
    $(".main-content .table-row .person-link").off("click").on("click", function(evt){
		
        check_activity();
        
		evt.preventDefault();
		
		$(this).closest(".table-row").off("click");
        
		$("#main-modal").attr("data-show-edit-wrapper", true);
		
		$("#main-modal").attr("data-person-link-clicked", true);
        
        var schedule_id = $.trim($(this).closest(".table-row").find(".schedule-id").text());
        
        $("#main-modal").attr("data-schedule-id", schedule_id);
		
		var person_description = $(this).attr("data-person-description");
		
		$("#main-modal").attr("data-person-description", person_description);
		
		var href = $(this).attr("href");

		if_statement_for_loading_modal(href);
  
		$(this).closest(".table-row").on("click", function(){
            
            check_activity();
			
			load_modal_from_table_link();
			
		});

	});
    
}


/**********************************************/
     //checkbox click in table
/*********************************************/
function checkbox_click_in_table() {
			
    $(".table-part-2 input[type='checkbox']").click(function(){
		
		$(this).closest(".table-row").off("click").on("click", function(){
			
			load_modal_from_table_link();
		
		});
		
	});
	
}


/**********************************************/
     //delete link in table
/*********************************************/
function delete_link_in_table(main_title) {
    
    $(".table-part-2 .delete-link").off().on("click", function(){
		
        $(this).closest(".table-row").off("click").on("click", function(){
            
            load_modal_from_table_link();
            
        });
        
		switch(main_title){
				
			case "Clients":
			case "Staff":
				
				var person = $.trim($(this).closest(".table-row").find(".person").text());
				
				var person_id = $.trim($(this).closest(".table-row").find(".display-none").text());
				
				var person_row = $(this).closest(".table-row");
        
				if(confirm("Are you sure your want to delete "+person+"? This will also delete any connecting schedules associated with "+person+".")){
						
					ajax_for_delete_link_in_table(person_id, person_row, main_title);
		   
				}
				
				break;
			
			case "Schedules":
			
				var schedule_id = $.trim($(this).parent().find(".schedule-id").text());
                
                var schedule_row = $(this).closest(".table-row");

				if(confirm("Are you sure your want to delete schedule "+schedule_id+"?")){
			
					ajax_for_delete_link_in_table(schedule_id, schedule_row, main_title);
		   
				}
				
				break;
				
            default:
			
                alert(main_title);

				break;
			   
		}
        
	});

}


/**********************************************/
     //ajax for delete link in table
/*********************************************/
function ajax_for_delete_link_in_table(person_id, person_row, main_title) {
    
    $.ajax({
        
        url: "delete-single-record.php",
        method: "POST",
        data:{id: person_id},
        dataType: "html",
        success: function(data, status, response){
						
            if((status == "success") && (response.readyState == 4) && (data == true)){
								
                person_row.css({"background-color":"red"});

                person_row.fadeOut(500);

				setTimeout(function(){

				person_row.remove();

				}, 1000);
                                
                table_row_click();
                                
                delete_link_in_table(main_title);
                
            }else if(data == 100){
                            
                location.reload(); 
							
            }else{
								
                ajax_success_error_message(data);
		
            }
							
        }
						
    });

}


/**********************************************/
     //validate schedule
/*********************************************/
function validate_schedule() {

    $("#get-current-date").click(function(){
        
       if($(this).is(":checked")){
           
           var date = new Date();
           
           var month = (Number(date.getMonth()+1) < 10) ? "0"+Number(date.getMonth()+1) : Number(date.getMonth()+1);
    
            var current_date = $.trim(date.getFullYear()+"-"+month+"-"+date.getDate());
           
           $("input[name='start_date']").val(current_date);
          
       }
        
    });
			
    $("input").focusin(function(){
        
        $("section input:focus").css({"background-color": "#ddeaff"});
            
    });
    
    $(".schedule-time-wrapper input").keyup(function(evt){
        
        var time = $(this).val();
		
		if(evt.keyCode != 8){

			if(time.length == 2){
			
				time += ":";
			
				$(this).val(time);
			}
		
		}
        
    });
    
    $("#mass-schedule-input input[type='text']").focusout(function(){
        
        $(this).css({"background-color":"#fff"});
        
        var time = $(this).val();
        
        if(time.length == 4){
            
            var hour = time[0] + time[1];
            
            var min = time[2] + time[3];
            
            var new_time = hour+":"+min;
            
            $(this).val(new_time);
           
        }
        
        var clockin = $("#mass-schedule-input .clockin").val();
        
        var clockout = $("#mass-schedule-input .clockout").val();
        
        $("#mass-schedule-input input[type='checkbox']").each(function(){
            
            var day = $(this).attr("class");
            
            if(clockin != "" && $(this).is(":checked")){
            
                $("#schedule-section-wrapper").find("."+day+" .clockin").val(clockin);
           
            }
        
            if(clockout != "" && $(this).is(":checked")){
            
                $("#schedule-section-wrapper").find("."+day+" .clockout").val(clockout);
               
            }
            
        });
        
        $("#schedule-section-wrapper input").focusout();
        
    });
    
    $("#mass-schedule-input input[type='checkbox']").click(function(){
        
        var day = $(this).attr("class");
        
        var clockin = $("#mass-schedule-input .clockin").val();
        
        var clockout = $("#mass-schedule-input .clockout").val();
      
        if((clockin != "") && ($(this).is(":checked"))){
            
            $("#schedule-section-wrapper").find("."+day+" .clockin").val(clockin);
           
        }
        
        if((clockout != "") && ($(this).is(":checked"))){
            
            $("#schedule-section-wrapper").find("."+day+" .clockout").val(clockout);
           
        }
        
        $("#schedule-section-wrapper input").focusout();
        
    });
    
    $("#schedule-section-wrapper input").focusout(function(){
        
        var mass_schedule_input_height = $("#mass-schedule-input").offset().top;
        
        var current_scrollTop_height = $(".modal-body").scrollTop();
        
        if(($(".modal-body").attr("id") == "show-schedule-modal-body") && (current_scrollTop_height < mass_schedule_input_height) && ($(".edit-wrapper input[type='checkbox']").is(":checked"))){
           
            $(".modal-body").scrollTop(mass_schedule_input_height - 60);
            
        }else if(($(".modal-body").attr("id") == "new-schedule-modal-body") && (current_scrollTop_height < mass_schedule_input_height)){
            
            $(".modal-body").scrollTop(mass_schedule_input_height - 60);
            
        }
        
        $("#schedule-section-wrapper input").removeClass("incorrect-border");
        
        $(this).css({"background-color":"#fff"});
        
        var time = $(this).val();
        
        if(time.length == 4){
            
            var hour = time[0] + time[1];
            
            var min = time[2] + time[3];
            
            var new_time = hour+":"+min;
            
            $(this).val(new_time);
           
        }
        
        var count = 0;
        Number(count);

        var incorrect_input = 0;
        Number(incorrect_input);
        
        var even_input;
        var odd_input;
        var error_msg = "make sure all times are in hhmm format";
        var input_counter = 1;
        var x = 0;
        
        
        
        $("#schedule-section-wrapper input").each(function(){
            
            var input_value = $(this).val();
            
            if((input_value.length != 5) && (input_value.length != 0)){
                
                incorrect_input++;
                $(this).addClass("incorrect-border");
                
            }
            
            for(var i = 0; i < 4; i++){
                
                input_value = input_value.replace(":", "");
                
                if(input_value > 2359){
                    
                    incorrect_input++;
                    $(this).addClass("incorrect-border");
                    
                }
                
                if((!$.isNumeric(input_value.charAt(i))) && (input_value.charAt(i) != "")){

                    incorrect_input++;
                    $(this).addClass("incorrect-border");

                }
                
                if((i == 2) && (input_value.charAt(i) > 5)){
                    
                    incorrect_input++;
                    $(this).addClass("incorrect-border");
                    
                }
                
            }
            
            if(x < 14){

                var section = document.getElementById("schedule-section-wrapper");

                var clockin = section.getElementsByTagName("input")[x].value.length;

                var clockout = section.getElementsByTagName("input")[x + 1].value.length;
                      
            }
 
            if((clockin < 5) && (clockout == 5) && (x < 14)){
                
                section.getElementsByTagName("input")[x].classList.add("incorrect-border");

                $(".total-weekly-hours p").html(error_msg);
                $(".total-weekly-hours p").css({"color":"red"});
                            
                incorrect_input++;
                
            }else if((clockout < 5) && (clockin == 5) && (x < 14)){
            
                section.getElementsByTagName("input")[x + 1].classList.add("incorrect-border");

                $(".total-weekly-hours p").html(error_msg);
                $(".total-weekly-hours p").css({"color":"red"});
                $(".hrs-for-day").html("");
                     
                incorrect_input++;
                
            }
            
            x = Number(x + 2);
            
        });
        
        switch(incorrect_input) {

                case 0:
             
                    var complete_hours = 0;
                            
                    $(".hrs-for-day").each(function(){
                                
                        $(this).html("");
                                
                        var clockin_value = $(this).closest(".schedule-time-wrapper").find(".clockin").val();
                                
                        var clockout_value = $(this).closest(".schedule-time-wrapper").find(".clockout").val();
                             
                        if((clockin_value != "") && (clockout_value != "")){
                                    
                            var total_hrs;
                            var time;
                            var count_whole;
                            var count_decimal;
                        
                            clockin_array = clockin_value.split(":");
                                    
                            clockout_array = clockout_value.split(":");
                            
                            var min = Number(clockout_array[1]) - Number(clockin_array[1]);
                          
                            min /= 60;
                            
                            var hour = Number(clockout_array[0]) - Number(clockin_array[0]);
                            
                            total_hrs = (clockin_value == clockout_value) ? 24 : Number(hour + min).toFixed(2);
                            
                            total_hrs = (total_hrs < 0) ? Number(24 - Math.abs(total_hrs)).toFixed(2) : total_hrs;
                            
                            if(total_hrs != 24){
                               
                                total_hrs_array  = String(total_hrs).split(".");

                                if(total_hrs_array[1][0] == "0" && total_hrs_array[1][1] == "0"){

                                    total_hrs_array[1] = "";

                                }

                                total_hrs = (total_hrs_array[1] == "") ? total_hrs_array[0] : (total_hrs_array[1][1] == "0") ? total_hrs_array[0]+"."+total_hrs_array[1][0] : total_hrs_array[0]+"."+total_hrs_array[1];
                                
                            }
                                    
                            $(this).html(total_hrs+" hrs");
                                    
                            complete_hours = Number(complete_hours) + Number(total_hrs);
                            
                            if(~String(complete_hours).indexOf(".")){
                            
                                complete_hours_array = String(complete_hours).split(".");
                               
                                complete_hours = (complete_hours_array[1].length > 2) ? Number(complete_hours).toFixed(2) : complete_hours;
                                
                            }
                                    
                        }else if(((clockin_value != "") && (clockout_value == "")) || ((clockin_value == "") && (clockout_value != ""))){
                            
                            $(".total-weekly-hours p").html(error_msg);
                            $(".total-weekly-hours p").css({"color":"red"});
                            $(".hrs-for-day").html(""); 
                            
                            incorrect_input ++;
                            
                            return false;
                            
                        }
                                
                    });
                
                    if(incorrect_input == 0){
                        
                        $(".total-weekly-hours p").css({"color":"green"});
                        $(".total-weekly-hours p").html(complete_hours+" hrs");
                       
                    }
                
                    break;
                    
                default:
            
                    $(".total-weekly-hours p").html(error_msg);
                    $(".total-weekly-hours p").css({"color":"red"});
					$(".hrs-for-day").html("");
                
                    break;
                    
            }
        
    });
	
}


/**********************************************/
     //filter form ajax
/*********************************************/
function filter_form_ajax(is_filter_on, main_title) {
    
   $("#filter form select").each(function(){
                    
        var current_input_name = "current_filter_"+$(this).attr("name");
                    
        var current_filter_value = $(this).val();
                    
        switch(is_filter_on){
                            
            case true:
                     
                if(current_filter_value != ""){
                                
                    $("#current-filters form input[name='"+current_input_name+"']").val(current_filter_value);
                               
                }
                            
                break;
                            
            default:
                            
                $("#current-filters form").append("<input name='"+current_input_name+"' value='"+current_filter_value+"'>");
                            
        }
                    
        if(($(this).hasClass("option-data-text")) && ($(this).val() != "")){
                        
            var option_text_different_from_value = $(this).find("option:selected").text();
                        
            $("#current-filters form input[name='"+current_input_name+"']").attr("data-option-text", option_text_different_from_value);
                        
        }
                    
    });
                
    if($("#filter input").length && is_filter_on == true){
                                
        $("#filter input").each(function(){
                                    
            var current_input_text_name = "current_filter_"+$(this).attr("name");
                    
            var current_filter_text_value = $(this).val();
                                    
            if(current_filter_text_value != ""){
                                
                $("#current-filters form input[name='"+current_input_text_name+"']").val(current_filter_text_value);
                               
            }
                                    
        });
                               
    }else if($("#filter input").length && is_filter_on != true){
                                
        $("#filter input").each(function(){
                                    
            var current_input_text_name = "current_filter_"+$(this).attr("name");
                                   
            var current_filter_text_value = $(this).val();
                                    
            $("#current-filters form").append("<input name='"+current_input_text_name+"' value='"+current_filter_text_value+"'>");
                                    
        });
                               
    }
       
    is_filter_on = true;
                
    var GET_variables = GET_variables_for_tables(is_sort_asc, column_name);
                
    ajax_for_filter_sort_search(GET_variables, is_filter_on, column_number, is_sort_asc, column_name, main_title);
    
    return is_filter_on;
    
}


/**********************************************/
     //phone number input
/*********************************************/
function phone_number_input() {

    $(".modal form input[name='phone_number']").on("keyup", function(evt){
		
		var phone_number = $(this).val();
		
		if(evt.keyCode != 8){

			if((phone_number.length == 3) || (phone_number.length == 7)){
			
				phone_number += "-";
			
				$(this).val(phone_number);
			}
		
		}
		
	});
    
}

/**********************************************/
     //check activity
/*********************************************/
function check_activity() {
    
    var activity = $(".modal-body form").attr("data-active");
                    
    if(activity == false){location.reload();}
    
}

/**********************************************/
     //check activity for filter
/*********************************************/
function check_activity_for_filter() {
    
    var activity = $("#filter form").attr("data-active");
                    
    if(activity == false){location.reload();}
    
}


/**********************************************/
     //check activity for show content
/*********************************************/
function check_activity_for_show_content() {
    
    var activity = $(".modal-body form .display-none").attr("data-active");
             
    if(activity == false){location.reload();}
    
}


/**********************************************/
     //check activity for mailing list
/*********************************************/
function check_activity_for_mailing_list() {
    
    var activity = $("#mailing-list-modal-body").attr("data-active");
             
    if(activity == false){location.reload();}
    
}

/**********************************************/
     //adjust columns for clients table
/*********************************************/
function adjust_columns_for_clients_table() {
  
    var checkbox = $("#clients-content .table-part-1 .checkbox-column").width();   
    $("#clients-content .table-part-2 .checkbox-column").width(checkbox);

    
    var evv_id = $("#clients-content .table-part-1 .evv-id-column").width();   
    $("#clients-content .table-part-2 .evv-id-column").css({"width":"'"+evv_id+"px'", "margin-left":"3px"});
    
    
    var name = $("#clients-content .table-part-1 .name-column").width();    
    $("#clients-content .table-part-2 .name-column").css({"width":"'"+name+"px'", "margin-left":"3px"});
    
    
    var amerigroup_id = $("#clients-content .table-part-1 .amerigroup-id-column").width();   
    $("#clients-content .table-part-2 .amerigroup-id-column").css({"width":"'"+amerigroup_id+"px'", "margin-left":"3px"});
    
    
    var medicaid_id = $("#clients-content .table-part-1 .medicaid-id-column").width();  
    $("#clients-content .table-part-2 .medicaid-id-column").css({"width":"'"+medicaid_id+"px'", "margin-left":"3px"});
    
    
    var phone_number = $("#clients-content .table-part-1 .phone-number-column").width(); 
    $("#clients-content .table-part-2 .phone-number-column").css({"width":"'"+phone_number+"px'", "margin-left":"3px"});
    
    var delete_column = $("#clients-content .table-part-1 .delete-column").width() * .60;
    
    $("#clients-content .table-part-2 .delete-column").css({"width":delete_column+"px", "margin-left":"3px"});
    
}

/**********************************************/
     //adjust columns for staff table
/*********************************************/
function adjust_columns_for_staff_table() {
    
    var checkbox = $("#staff-content .table-part-1 .checkbox-column").width(); 
    $("#staff-content .table-part-2 .checkbox-column").width(checkbox);

    
    var evv_id = $("#staff-content .table-part-1 .evv-id-column").width();   
    $("#staff-content .table-part-2 .evv-id-column").width(evv_id);
    $("#staff-content .table-part-2 .evv-id-column").css({"margin-left":"3px"});
    
    
    var name = $("#staff-content .table-part-1 .name-column").width();    
    $("#staff-content .table-part-2 .name-column").width(name);
    $("#staff-content .table-part-2 .name-column").css({"margin-left":"3px"});
    
    
    var mail = $("#staff-content .table-part-1 .mail-column").width();   
    $("#staff-content .table-part-2 .mail-column").width(mail);
    $("#staff-content .table-part-2 .mail-column").css({"margin-left":"3px"});
    
    
    var pay_rate = $("#staff-content .table-part-1 .pay-rate-column").width();
    $("#staff-content .table-part-2 .pay-rate-column").width(pay_rate);
    $("#staff-content .table-part-2 .pay-rate-column").css({"margin-left":"3px"});
    
    
    var phone_number = $("#staff-content .table-part-1 .phone-number-column").width(); 
    $("#staff-content .table-part-2 .phone-number-column").width(phone_number);
    $("#staff-content .table-part-2 .phone-number-column").css({"margin-left":"3px"});
    
    
    var delete_column = $("#staff-content .table-part-1 .delete-column").width() * .60;
    $("#staff-content .table-part-2 .delete-column").css({"margin-left":"3px"});
    $("#staff-content .table-part-2 .delete-column").width(delete_column);
    
}

/**********************************************/
     //adjust columns for schedules table
/*********************************************/
function adjust_columns_for_schedules_table() {
    
    var checkbox = $("#schedules-content .table-part-1 .checkbox-column").width(); 
    $("#schedules-content .table-part-2 .checkbox-column").width(checkbox);

    
    var id = $("#schedules-content .table-part-1 .id-column").width();   
    $("#schedules-content .table-part-2.table-part-2 .id-column").width(id);
    $("#schedules-content .table-part-2.table-part-2 .id-column").css({"margin-left":"3px"});
    
    
    var staff_name = $("#schedules-content .table-part-1 .staff-name-column").width();    
    $("#schedules-content .table-part-2 .staff-name-column").width(staff_name);
    $("#schedules-content .table-part-2 .staff-name-column").css({"margin-left":"3px"});
    
    
    var client_name = $("#schedules-content .table-part-1 .client-name-column").width();    
    $("#schedules-content .table-part-2 .client-name-column").width(client_name);
    $("#schedules-content .table-part-2 .client-name-column").css({"margin-left":"3px"});
    
    
    var sun = $("#schedules-content .table-part-1 .sun-column").width();   
    $("#schedules-content .table-part-2 .sun-column").width(sun);
    $("#schedules-content .table-part-2 .sun-column").css({"margin-left":"3px"});
    
    
    var mon = $("#schedules-content .table-part-1 .mon-column").width();   
    $("#schedules-content .table-part-2 .mon-column").width(mon);
    $("#schedules-content .table-part-2 .mon-column").css({"margin-left":"3px"});
    
    
    var tues = $("#schedules-content .table-part-1 .tues-column").width();   
    $("#schedules-content .table-part-2 .tues-column").width(tues);
    $("#schedules-content .table-part-2 .tues-column").css({"margin-left":"3px"});
    
    
    var wed = $("#schedules-content .table-part-1 .wed-column").width();   
    $("#schedules-content .table-part-2 .wed-column").width(wed);
    $("#schedules-content .table-part-2 .wed-column").css({"margin-left":"3px"});
    
    
    var thurs = $("#schedules-content .table-part-1 .thurs-column").width();   
    $("#schedules-content .table-part-2 .thurs-column").width(thurs);
    $("#schedules-content .table-part-2 .thurs-column").css({"margin-left":"3px"});
    
    
    var fri = $("#schedules-content .table-part-1 .fri-column").width();   
    $("#schedules-content .table-part-2 .fri-column").width(fri);
    $("#schedules-content .table-part-2 .fri-column").css({"margin-left":"3px"});
    
    
    var sat = $("#schedules-content .table-part-1 .sat-column").width();   
    $("#schedules-content .table-part-2 .sat-column").width(sat);
    $("#schedules-content .table-part-2 .sat-column").css({"margin-left":"3px"});
    
    
    var delete_column = $("#schedules-content .table-part-1 .delete-column").width() * .60;
    $("#schedules-content .table-part-2 .delete-column").css({"margin-left":"3px"});
    $("#schedules-content .table-part-2 .delete-column").width(delete_column);
    
}

/**********************************************/
     //adjusting table columns
/*********************************************/
function adjusting_table_columns(main_title) {
    
    if(main_title == "Clients"){
        
        adjust_columns_for_clients_table(); 
        
        return;
        
    }
    
    if(main_title == "Schedules"){
        
        adjust_columns_for_schedules_table(); 
        
        return;
    
    }
    
    if(main_title == "Staff"){
        
        adjust_columns_for_staff_table(); 
        
        return;
    
    }
    
}

/**********************************************/
     //close modal guide
/*********************************************/
function close_modal_guide(is_modal_read) {

    $("#modal-guide-bttn-wrapper #cancel-bttn").on("click", function(){
        
        if(is_modal_read !== undefined){
        
            sessionStorage.setItem(is_modal_read, "true");
        
        }
    
        $("#modal-guide").addClass("display-none"); 

    });

}


/**********************************************/
     //stop modal guide
/*********************************************/
function stop_modal_guide() {

    $("#modal-guide-bttn-wrapper #stop-guide-bttn").click(function(){
        
        sessionStorage.is_guide_on = "false";

        $("#modal-guide").addClass("display-none"); 

    });

}


/**********************************************/
     //adjust modal guide on resize
/*********************************************/
/*function adjust_modal_guide_on_resize() {
    
    $(window).resize(function(){
    
        var new_window_scroll_position_left = $(window).scrollLeft();
            
        var new_window_scroll_position_top = $(window).scrollTop();
        
        var modal_left_margin = $("#modal-guide").css("margin-left");
		
	    var modal_top_margin = $("#modal-guide").css("margin-top");
        
        var modal_left= parseInt(modal_left_margin) - new_window_scroll_position_left ;
        
        var modal_top = parseInt(modal_top_margin) - new_window_scroll_position_top;
        
        $("#modal-guide").css({"margin-left":modal_left+"px", "margin-top":modal_top+"px"});

    });
    
}*/


/**********************************************/
     //move modal guide
/*********************************************/
 function move_modal_guide() {
     
        var is_modal_clicked, current_modal_top, current_margin_right, current_mouse_positionX, current_mouse_positionY;
     
        $("#modal-guide").mousedown(function(evt){
            
            is_modal_clicked = true;
            
            evt.preventDefault();
           
            current_margin_top = parseInt($("#modal-guide").css("margin-top"));
            
            current_margin_right = parseInt($("#modal-guide").css("margin-right"));
            
            current_mouse_positionY = evt.pageY;
            
            current_mouse_positionX = evt.pageX;
            
        });
     
        $("#modal-guide-image-wrapper img").mousedown(function(evt){
            
            evt.preventDefault();
            
        });
     
        $(window).mouseup(function(){
            
            $("#modal-guide").removeClass("grabbing");
            
            is_modal_clicked = false;
           
        });
     
        $("#modal-guide").mousemove(function(){
           
            if(is_modal_clicked === true){
                
                $("#modal-guide").addClass("grabbing");
            
            }
            
        });
         
        $("body").mousemove(function(evt){
            
            if(is_modal_clicked === true){
                
                var new_mouse_positionY = evt.pageY;

                var new_mouse_positionX = evt.pageX;

                var mouse_top = current_mouse_positionY - new_mouse_positionY;
                
                var mouse_right = (current_margin_right == 0) ?current_mouse_positionX - new_mouse_positionX : ((current_margin_right > 0) ? new_mouse_positionX - current_mouse_positionX : new_mouse_positionX - current_mouse_positionX);
                
                var margin_top = current_margin_top - mouse_top;
                
                var margin_right = (current_margin_right == 0) ? mouse_right - current_margin_right : ((current_margin_right > 0) ? current_margin_right - mouse_right : current_margin_right - mouse_right);
                
                $("#modal-guide").css({"margin-top":margin_top+"px", "margin-right": margin_right+"px"});

            }

        });
        
    }


/**********************************************/
     //onready modal guide
/********************************************/
function onready_modal_guide(onready_session_variable) {

    initialize_modal_guide("onready-modal-guide.php", "onready-modal-guide-animation", onready_session_variable);

    var current_filters_showing;
    
    $("#current-filters").click(function(){

        current_filters_showing = true;

    });
    
    $("#current-filters-wrapper").click(function(){
        
        if((current_filters_showing == false) || (current_filters_showing == undefined)){
       
            initialize_modal_guide_on_event(onready_session_variable, "onready-modal-guide.php");
        
        }
        
        current_filters_showing = false;
        
    });
    
    if(typeof(Storage) !== undefined){
        
        if(sessionStorage.getItem(onready_session_variable) == null){
        
            sessionStorage.setItem(onready_session_variable, "false");
        
        }
    
        sessionStorage.name_of_onready_guide_session_variable = onready_session_variable;
        
    }

}


/**********************************************/
     //initialize modal guide
/********************************************/
function initialize_modal_guide(modal_guide_info, animation_class, is_modal_read) {

     if(typeof(Storage) !== undefined){
        
        if(sessionStorage.is_guide_on != "false" && sessionStorage.getItem(is_modal_read) != "true"){

            $("#modal-guide-body").load(modal_guide_info, function(){
              
                $("#modal-guide").addClass(animation_class);
                
                if($("#modal-guide").hasClass("display-none")){
        
                    $("#modal-guide").removeClass("display-none");
                
                }
                
                show_info_link();
                
                $("#modal-guide").css({"margin-top":"0", "margin-right":"0"});
                
                $("#modal-guide").scrollTop(0);

                //adjust_modal_guide_on_resize();

                move_modal_guide();
                
                $("#cancel-bttn").off();

                close_modal_guide(is_modal_read);

                stop_modal_guide();
                
            });

        }
       
    }else{
       
      no_storage_alert();
       
    }

}


/**********************************************/
     //change modal guide content
/********************************************/
function change_modal_guide_content(modal_guide_info, is_modal_read) {

    if(sessionStorage.is_guide_on != "false" && sessionStorage.getItem(is_modal_read) != "true"){
        
        if(!$("#modal-guide").hasClass("display-none")){
                   
            $("#modal-guide").addClass("display-none");
                   
        }

        $("#modal-guide-body").load(modal_guide_info, function(){
                
            if($("#modal-guide").hasClass("load-new-guide-content-animation")){

                $("#modal-guide").removeClass("load-new-guide-content-animation");
                
            }
            
            $("#modal-guide").addClass("load-new-guide-content-animation");
                
            $("#modal-guide").removeClass("onready-modal-guide-animation");
                
            if($("#modal-guide").hasClass("display-none")){
                   
                $("#modal-guide").removeClass("display-none");
                    
                $("#modal-guide").css({"margin-top":"0", "margin-right":"0"});
                    
                $("#modal-guide").scrollTop(0);
                   
            }
            
            show_info_link();
            
            $("#cancel-bttn").off();
                
            close_modal_guide(is_modal_read);
                
        });
        
    }

}


/**********************************************/
     //initialize modal guide on event
/********************************************/
function initialize_modal_guide_on_event(session_variable, modal_guide_info) {

     if(typeof(Storage) !== undefined){
         
         if(sessionStorage.getItem(session_variable) != "true"  && sessionStorage.getItem(session_variable) != "false"){
            
             sessionStorage.setItem(session_variable, "false");
             
         }
            
        if(sessionStorage.getItem(session_variable) != "true"){
            
            if($("#modal-guide").hasClass("display-none")){
                    
                initialize_modal_guide(modal_guide_info, "onready-modal-guide-animation", session_variable);
                   
            }else{
                    
                change_modal_guide_content(modal_guide_info, session_variable);
                   
            }
               
        }
               
    }

}

/**********************************************/
     //adjust_modal_guide_by_add_new_bttn
/********************************************/
function adjust_modal_guide_by_add_new_bttn() {

    if(typeof(Storage) !== undefined && $(".modal-body").attr("id") != "show-schedule-modal-body"){
                
        var modal_guide_top = $("#add-new-schedule").offset().top - 330;

        $("#modal-guide").css({"top":modal_guide_top+"px"});
            
    }

}


/**********************************************/
     //show info link
/********************************************/
function show_info_link() {

    $("#modal-guide .show-info-link").on("click", function(){
        
        $(this).closest(".info-container").find(".info-wrapper").toggleClass("display-none")
        
    });

}


/**********************************************/
     //no storage alert
/********************************************/
function no_storage_alert() {

    alert("Your browser’s storage is not up to date. I would recommend updating your current browser or trying another one for a better user experience.");

}

/**********************************************/
     //session expiration alert
/********************************************/
function session_expiration_alert() {

    alert("IMPORTANT INFO: \n \n Every time you login you get a brand new set of tables with fake information to play with, so feel free to delete, add, or modify anything you want.\n \n In order to conserve memory on the backend, I've set the session for these tables to last only an hour.\n \n After an hour, the tables delete and you're automatically logged out, but feel free to sign back in and tour the application as many times as you want. ENJOY!");

}
    