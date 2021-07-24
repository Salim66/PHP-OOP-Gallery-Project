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

                if(empty($_FILES['user_image'])){
                    $user->save();
                }else {
                    $user->setFile($_FILES['user_image']);
                    $user->uploadPhoto();
                    $user->save();

                    redirect("edit_user.php?id=$user->id");
                }
    
            }
        }


    }
    


?>

<!-- Photo Library Modal -->
    <div class="modal fade" id="photo-Library">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Gallery System Library</h4>
        </div>
        <div class="modal-body">
            <div class="col-md-9">
                <div class="thumbnails row">
                
                    <!-- PHP LOOP HERE CODE HERE-->
                    
                <div class="col-xs-2">
                    <a role="checkbox" aria-checked="false" tabindex="0" id="" href="#" class="thumbnail">
                    <img class="modal_thumbnails img-responsive" src="<!-- PHP LOOP HERE CODE HERE-->" data="<!-- PHP LOOP HERE CODE HERE-->">
                    </a>
                    <div class="photo-id hidden"></div>
                </div>

                        <!-- PHP LOOP HERE CODE HERE-->

                </div>
            </div><!--col-md-9 -->

    <div class="col-md-3">
        <div id="modal_sidebar"></div>
    </div>

    </div><!--Modal Body-->
        <div class="modal-footer">
            <div class="row">
                <!--Closes Modal-->
                <button id="set_user_image" type="button" class="btn btn-primary" disabled="true" data-dismiss="modal">Apply Selection</button>
            </div>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- End Photo Library Modal -->




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
                                <a href="#" data-toggle="modal" data-target="#photo-Library"><img width="100%" src="<?php echo $user->imagePathAndPlaceholder() ?>" alt=""></a>
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
                                    <input type="password" name="password" class="form-control" value="<?php echo $user->password ?>">
                                </div>
                                <div class="form-group">
                                    <a class="btn btn-danger" href="delete_user.php?id=<?php echo $user->id ?>">Delete</a>
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