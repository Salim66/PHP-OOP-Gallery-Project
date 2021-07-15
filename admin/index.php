<?php include("includes/header.php"); ?>

    <?php
    
        // check whether the user is not login then , kikout the admin panel
        if(!$session->isSignedIn()){
            redirect("login.php");
        }

    ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            

            <?php include("includes/top_nav.php") ?>



            <?php include("includes/side_nav.php") ?>


        </nav>

        <div id="page-wrapper">

            <?php include("includes/admin_content.php") ?>

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>