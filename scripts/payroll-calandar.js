$(function(){
    
    onready_modal_guide("payroll_onready_guide_read");
    
    //displays drop down menu content on list hover
    dropdown_menu_content();
    
    var date = new Date();
    var year = date.getFullYear();
    
    $("#year").text(year);
    
    payroll_calandar(year);
    
    $("#previous-year").click(function(evt){
        
        evt.preventDefault();
        year--;
        
        $("#year").text(year);
        
        payroll_calandar(year);
        
    });
    
     $("#next-year").click(function(evt){
       
        evt.preventDefault();
        year++;
        
        $("#year").text(year);
       
        payroll_calandar(year);
         
    });
    
    load_print_window();
    

}());