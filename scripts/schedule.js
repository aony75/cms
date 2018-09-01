$(function(){
   
     $(".add-new-bttn").click(function(evt){
         
        $("#main-modal").load("new-schedule.php", function(){
            
            check_activity_for_show_content();
            
            $("#main-modal-content").css({"display":"block"});
            
            $("select[name='new_or_existing'] option[value='new schedule']").prop("selected", "true");
             
            $(".modal").attr("data-last-href", "new-schedule.php");
            
        });
        
    });

}());