<?php include("includes/init.php"); ?>

    <?php
    
        // check whether the user is not login then , kikout the admin panel
        if(!$session->isSignedIn()){
            redirect("login.php");
        }

    ?>

    <?php
    
        // Get id
        if(empty($_GET['id'])){
            redirect('photos.php');
        }

        $user = User::findById($_GET['id']);

        // chcek user find or not
        if($user != null){
            $user->deleteUser();
            redirect('users.php');
        }else {
            return false;
        }
    
    ?>