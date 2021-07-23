<?php include("includes/init.php"); ?>

    <?php
    
        // check whether the comment is not login then , kikout the admin panel
        if(!$session->isSignedIn()){
            redirect("login.php");
        }

    ?>

    <?php
    
        // Get id
        if(empty($_GET['id'])){
            redirect('photos.php');
        }

        $comment = Comment::findById($_GET['id']);

        // chcek comment find or not
        if($comment != null){
            $comment->delete();
            redirect('comments.php');
        }else {
            redirect('comments.php');
        }
    
    ?>