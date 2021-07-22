<?php include("includes/header.php"); ?>

<?php
    // check whether the user is not login then , kikout the admin panel
    if(!$session->isSignedIn()){
        redirect("login.php");
    }
?>


<?php 
    // Get all data 
    $photos = Photo::findAll();

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
                        <div class="col-md-12">
                            <table class="table table-hover table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Id</th>
                                        <th>File Nmae</th>
                                        <th>Title</th>
                                        <th>Size</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php  foreach($photos as $photo): ?>

                                        <tr>
                                            <td><img src="<?php echo $photo->picturePath(); ?>">
                                        
                                                <div class="picture_link">
                                                    <a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                                    <a href="">Edit</a>
                                                    <a href="">View</a>
                                                </div>
                                            
                                            </td>
                                            <td><?php echo $photo->id ?></td>
                                            <td><?php echo $photo->filename ?></td>
                                            <td><?php echo $photo->title ?></td>
                                            <td><?php echo $photo->size ?></td>
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