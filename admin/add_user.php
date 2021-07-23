<?php include("includes/header.php"); ?>

<?php
    // check whether the user is not login then , kikout the admin panel
    if(!$session->isSignedIn()){
        redirect("login.php");
    }
?>

<?php 

    // // Check whether the id has or not
    // if(empty($_GET['id'])){
    //     redirect('photos.php');
    // }else {

    //     // find the specific gallery
    //     $photo = Photo::findById($_GET['id']);

    //     // check form submit or not
    //     if(isset($_POST['update'])){
            
    //         if($photo != null){
    //             // get all form data
    //             $photo->title          = $_POST['title'];
    //             $photo->caption        = $_POST['caption'];
    //             $photo->alternate_text = $_POST['alternate_text'];
    //             $photo->description    = $_POST['description'];
    //             $photo->save();
    //         }
    //     }


    // }

    


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
                            Photos
                            <small>Subheading</small>
                        </h1>                       
                        <form action="" method="POST">
                            <div class="col-md-8">
                                
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" name="password" class="form-control">
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