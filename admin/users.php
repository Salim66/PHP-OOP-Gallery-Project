<?php include("includes/header.php"); ?>

<?php
    // check whether the user is not login then , kikout the admin panel
    if(!$session->isSignedIn()){
        redirect("login.php");
    }
?>


<?php 
    // Get all data 
    $users = User::findAll();

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
                            Users
                            <small>Subheading</small>
                        </h1>
                        <div class="col-md-12">
                            <table class="table table-hover table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php  foreach($users as $user): ?>

                                        <tr>
                                            <td><?php echo $user->id ?></td>
                                            <td><img class="user_thumbnil user_image" src="<?php echo $user->imagePathAndPlaceholder(); ?>"></td>
                                            
                                            <td><?php echo $user->username ?>
                                                <div class="action_link">
                                                    <a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                                    <a href="edit_user.php?id=<?php echo $user->id ?>">Edit</a>
                                                    <a href="">View</a>
                                                </div>
                                            </td>
                                            <td><?php echo $user->first_name ?></td>
                                            <td><?php echo $user->last_name ?></td>
                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>