<?php 

// include header
require_once('includes/header.php');

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

    if($username == "" || $password == ""){
        $the_message = "All field are required!";
    }else {

        $user_fount = User::verify_user($username, $password);


        if($user_fount){
            $session->login($user_fount);
            redirect("index.php");
        }else {
            $the_message = "Your username and password does not match!";
        }

    }
}else {
    $the_message = "";
    $username = "";
    $password = "";
}


?>


<div class="col-md-4 col-md-offset-3">

    <h4 class="text-center text-info text-uppercase">Login</h4>
    <h4 class="bg-danger"><?php echo $the_message; ?></h4>
        
    <form id="login-id" action="" method="post">
        
        <div class="form-group">
            <label for="username" style="color: #777;">Username</label>
            <input type="text" class="form-control" name="username" autocomplete="off" value="<?php echo htmlentities($username); ?>">

        </div>

        <div class="form-group">
            <label for="password" style="color: #777;">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
            
        </div>


        <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">

        </div>


    </form>


</div>

