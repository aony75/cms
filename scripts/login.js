$(function(){
    
    var incorrect_login = $(".container").attr("data-incorrect-login");
    
    if(incorrect_login == true){
        
        initialize_modal_guide("incorrect-login-modal-guide.php", "login-modal-guide-animation");
       
    }else{

        if(sessionStorage.login_guide_read != "true"){
            
            initialize_modal_guide("login-modal-guide.php", "login-modal-guide-animation", "login_guide_read");
    
        }
       
    } 
    
}());