<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
                <br>

                <?php

                    $user = new User();

                    $user->username   = "plabon";
                    $user->password   = "123456";
                    $user->first_name = "Play";
                    $user->last_name  = "Boy";

                    $user->save();


                    
                    // $user = User::findUserById(4);

                    // $user->last_name = "Uddin";
                    // $user->save();


                    // $user = User::findUserById(4);
                    // $user->delete();

                    
                
                ?>


            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->