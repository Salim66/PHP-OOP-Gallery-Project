<?php include("includes/header.php"); ?>

<?php
    // check whether the user is not login then , kikout the admin panel
    if(!$session->isSignedIn()){
        redirect("login.php");
    }
?>

<?php
    // create message property
    $message = "";
    if(isset($_POST['submit'])){

        // instantiate a Photo class
        $photo = new Photo();
        $photo->title = $_POST['title'];
        $photo->setFile($_FILES['file_upload']);

        // save file and check
        if($photo->save()){
            $message = "Photo uploaded successfully";
        }else {
            $message = join("<br>", $photo->errors);
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
                            Upload
                            <small>Subheading</small>
                        </h1>
                        <?php echo $message; ?>
                        <br>
                       
                        <div class="col-md-6">
                            <form action="upload.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="file_upload" class="form-control-file">
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
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