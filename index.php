<?php
    
    session_start();
    
    $current_page = "home";

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("private/initialize.php"); 

    //page title in head.php
    $page_title = "login";

    //requires the inclusion of head of this page
    require(SHARED_PATH."/head.php"); 

    $display_none = "display-none";

    $params = session_get_cookie_params();

    setcookie(session_name(), "", time() + -1000000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    
    if(is_POST_request()){
        
        $username = h($_POST["username"]);
        
        $password = h($_POST["password"]);
        
        $salt = find_salt_for_user($username);
        
        $display_none = empty($salt) ? "" : "display-none";

        if(!empty($salt)){
            
            $hashed_password = hash("sha512", $salt.$password.$salt);
            
            if(validate_password($username, $password) == true){
                
                setcookie(session_name(), session_id(), time() + 3600, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
                
                $_SESSION["username"] = $username;
                
                $table_identifier = hash("md5", session_id());
                
                $_SESSION["table_indentifier"] = "_".$table_identifier;
                
                $session_table_identifier = $_SESSION["table_indentifier"];
                
                create_tables_for_user($session_table_identifier);
                
                redirect_to(url_for("/clients"));
                
            }else{
                
                $display_none = "";
                
            }
            
        }
      
    }

?>
    <body>
        <?php 
        
            require_once(SHARED_PATH."/modal-guide.php"); 
        
        ?>
        <div id="login_container" class="container" data-incorrect-login="<?php echo is_POST_request(); ?>">
            <h2>CMS LOGIN</h2>
            <?php
             if($browser_type -> isMobile()){
            ?>
            <p id="mobile-browser-message">
                Due to the high use of tables, a non-mobile browser will give you the best experience when viewing this web application. Please try another web browser to view this CMS application.
            </p>
            <?php 
                 }else{
            ?>
            <form id="login_form" action="" method="post">
                <dl>
                    <dt>
                        <p id="incorrect-login-statement" class="<?php echo $display_none; ?>">
                            Username and/or password is incorrect. Please try again.
                        </p>
                    </dt>
                </dl>
                <dl>
                    <dt><input name="username" placeholder="Username" type="text" required></dt>
                </dl>
                <dl>
                    <dt><input name="password" placeholder="Password" type="password" required></dt>
                </dl>
                <dl>
                    <dt><input id="login-bttn" type="submit" value="Submit"></dt>
                </dl>
                <dl>
                    <dt>
                        <p class="login-info">Username: guest</p>
                        <p class="login-info">Password: CmsProject01</p>
                    </dt>
                </dl>
            </form>
            <?php
                }
            ?>
            <div id="login-footer">
                <p>&copy;<?php echo date("Y"); ?> CMS<p>
            </div>
        </div>
    </body>
    <?php
        if(!$browser_type -> isMobile()){
    ?>
    <script type="text/javascript" src="scripts/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo url_for("/scripts/script-functions.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo url_for("/scripts/login.js"); ?>"async></script>
    <?php
        }
    ?>
</html>
<?php 

    drop_all_old_tables_on_login();

?>