<?php include("includes/init.php"); ?>

    <?php
    
        // check whether the user is not login then , kikout the admin panel
        if(!$session->isSignedIn()){
            redirect("login.php");
        }

    ?>

    <?php
    
        
    
    
    ?>