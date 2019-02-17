<?php 
    session_start();
    
    unset($_SESSION["user_id"]); //this would just unset the variable
    session_unset();        
    session_destroy();
    echo "Logging out.....";
    
    //header("Location: index.php");
    //Page redirect after certain time
    header("Refresh:1; url=login.php");
    
    
    exit();
?>