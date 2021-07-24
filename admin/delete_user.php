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
            $session->message("The {$user->username} has been deleted");
            redirect('users.php');
        }else {
            redirect('users.php');
            $session->message("The {$user->username} has been not deleted");
        }
    
    ?>