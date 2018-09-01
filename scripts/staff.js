$(function(){
    
     $(".mail-bttn").click(function(){
         
         var search = $(".search").val();
         
         var GET_variables = GET_variables_for_tables(is_sort_asc, column_name);
         
         GET_variables = $(".show-current-filters-bttn").hasClass("display-none") ? GET_variables.substr(2) : GET_variables.substr(1);
         
         var mailing_list_page = "mailing-list.php?"+GET_variables+"&search="+search; 
         
         $("#main-modal").load(mailing_list_page, function(){
             
             check_activity_for_mailing_list();
             
             $("#main-modal-content").css({"display":"block"});
             
         });
         
    });
    
    $(".add-new-bttn").click(function(evt){
		 
        evt.preventDefault();
        
        $("#main-modal").load("new-staff.php", function(){
            
            check_activity();
            
            $("#main-modal-content").css({"display":"block"});
			
			modal_height();
            
            $(".modal").attr("data-last-href", "new-staff.php");
			
		});
        
    });

}());