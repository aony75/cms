<?php

    require_once("db_credentials.php");

    //used to open a connection to mysql
    function db_connect() {
        $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        //displays error if there is a connection error to mysql
        confirm_db_connect();
        
        return $connection;
    }
    
    //closes mysql connection if the $connection variable is set
    // we don't want try to close the connection if it is not set b/c that will cause errors
    function db_close($connection) {
        
        if(isset($connection)){
            mysqli_close($connection);
        }
    }
    
     // retuns error message if there is a problem with mysqli_connect()
    function confirm_db_connect() {
        
        //if there is a connection error an error, the website exits mysql with error message that we create
        //mysql_errno() retruns error number
        //mysql_error() returns string associated with error
        if(mysqli_connect_errno()){
            
            $msg = "Database connection failed: ";
            $msg .= mysqli_connect_error();
            $msg .= "(".mysqli_connect_errno().")";
            exit ($msg);
        }  
    }
    
    //exits from mysql if mysqli_query() fails to retun a result set
    function confirm_result_set($result_set){
        if(!$result_set){
            exit("database failed");
        }
    }

    //uses mysqli_error() to return last connection error and print error, closes database, and exits out of mysql and php
    function db_result_error($db){
        
        echo mysqli_errno($db);
        db_close($db);
        exit();
    }
?>