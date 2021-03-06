<?php include("includes/header.php"); ?>

<?php
    // check whether the user is not login then , kikout the admin panel
    if(!$session->isSignedIn()){
        redirect("login.php");
    }
?>


<?php 
    // Get all data 
    // $photos = Photo::findAll();

    // find by specific user gallery
    $photos = User::findById($_SESSION['user_id'])->photos();

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
                            <small></small>
                        </h1>
                        <p class="bg-success p-5 fa-2x"><?php echo $message; ?></p>  
                        <div class="col-md-12">
                            <table class="table table-hover table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Id</th>
                                        <th>File Nmae</th>
                                        <th>Title</th>
                                        <th>Size</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php  foreach($photos as $photo): ?>

                                        <tr>
                                            <td><img class="photo_thumbnil" src="<?php echo $photo->picturePath(); ?>">
                                        
                                                <div class="picture_link">
                                                    <a class="delete_link" href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                                    <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                                    <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a>
                                                </div>
                                            
                                            </td>
                                            <td><?php echo $photo->id ?></td>
                                            <td><?php echo $photo->filename ?></td>
                                            <td><?php echo $photo->title ?></td>
                                            <td><?php echo $photo->size ?></td>
                                            <td>
                                                <?php $comments = Comment::findTheComment($photo->id); ?>
                                                <a href="comments_photo.php?id=<?php echo $photo->id; ?>"><?php echo count($comments) ?></a>
                                            </td>
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