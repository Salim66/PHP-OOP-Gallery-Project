<?php include("includes/header.php"); ?>

<?php
    // check whether the user is not login then , kikout the admin panel
    if(!$session->isSignedIn()){
        redirect("login.php");
    }
?>

<?php 

    // Check whether the id has or not
    if(empty($_GET['id'])){
        redirect('users.php');
    }else {

        // find the specific user
        $user = User::findById($_GET['id']);

        // check form submit or not
        if(isset($_POST['update'])){
            
            if($user){
                $user->username   = $_POST['username'];
                $user->first_name = $_POST['first_name'];
                $user->last_name = $_POST['last_name'];
                $user->password   = $_POST['password'];
    
                $user->setFile($_FILES['user_image']);
    
                $user->saveUserAndImage();
            }
        }


    }
    


?>


        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            

            <?php include("includes/top_nav.php") ?>



            <?php include("includes/side_nav.php") ?>


        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            users
                            <small>Subheading</small>
                        </h1>   
                        
                            <div class="col-md-6">
                                <img src="<?php echo $user->imagePathAndPlaceholder() ?>" alt="">
                            </div>

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <input type="file" name="user_image" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $user->username ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update" class="btn btn-primary" value="Update">
                                </div>
                                
                            </div>
                        </form>
                    </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>