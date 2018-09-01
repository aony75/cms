$(function(){

     $(".add-new-bttn").click(function(evt){
        
		evt.preventDefault();
        
        $("#main-modal").load("new-client.php", function() {
            
            check_activity();
            
            $("#main-modal-content").css({"display":"block"});
			
			modal_height();
		
			$(".modal").attr("data-last-href", "new-client.php");
			
		});
        
    });
	
}());