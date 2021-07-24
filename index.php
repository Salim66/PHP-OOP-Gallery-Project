<?php include("includes/header.php"); ?>

<?php $photos = Photo::findAll(); ?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumbnail row">

                    <?php foreach($photos as $photo): ?>                        
                        <div class="col-xs-6 col-md-3">
                            <a href="" class="thumbnail">
                                <img src="admin/<?php echo $photo->picturePath(); ?>" alt="">
                            </a>
                        </div>                        
                    <?php endforeach; ?>

                </div>
            </div>




            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4"> -->

            
                 <?php //include("includes/sidebar.php"); ?>



        </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
