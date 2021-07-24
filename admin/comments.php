<?php include("includes/header.php"); ?>

<?php
    // check whether the user is not login then , kikout the admin panel
    if(!$session->isSignedIn()){
        redirect("login.php");
    }
?>


<?php 
    // Get all data 
    $comments = Comment::findAll();

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
                            Comments
                            <small></small>
                        </h1>
                        <p class="bg-success p-5 fa-2x"><?php echo $message; ?></p>
                        <div class="col-md-12">
                            <table class="table table-hover table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Body</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php  foreach($comments as $comment): ?>

                                        <tr>
                                            <td><?php echo $comment->id ?></td>
                                            
                                            <td><?php echo $comment->author ?>
                                                <div class="action_link">
                                                    <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                                </div>
                                            </td>
                                            <td><?php echo $comment->body ?></td>
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