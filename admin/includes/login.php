<?php 

// include init.php file because all the file include init.php file
require_once('init.php');

// check whether the user is login then redirect to admin dashboard
if($session->isSignedIn()){
    redirect("index.php");
}

// Login data check
if(isset($_POST['submit'])){
    // Get the value
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    // Method to check database user

    $user_fount = User::verify_user($username, $password);


    if($user_fount){
        $session->login($user_fount);
        redirect("index.php");
    }else {
        $the_message = "Your username and password does not match!";
    }
}else {
    $username = "";
    $password = "";
}



?>