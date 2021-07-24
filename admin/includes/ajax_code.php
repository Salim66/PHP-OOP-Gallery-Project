<?php require_once('init.php') ?>

<?php

   $user = new User();

   // check the ajax reuest
   if(isset($_POST['image_name'])){
      
      $user->ajaxSaveUserImage($_POST['user_id'], $_POST['image_name']);

   }



?>