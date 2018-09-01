<?php
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("private/initialize.php");
    
    drop_all_current_tables_on_logout();

    $params = session_get_cookie_params();
    
    setcookie(session_name(), "", time() - 1000000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

    session_unset();

    session_destroy();

    redirect_to(url_for("/"));

?>