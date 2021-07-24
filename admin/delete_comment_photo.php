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
            $session->message("The comment with id {$comment->id} has been deleted");
            redirect("comments_photo.php?id={$comment->photo_id}");
        }else {
            redirect("comments_photo.php?id={$comment->photo_id}");
        }
    
    ?>