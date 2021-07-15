<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
                <br>

                <?php

                    // $user = new User();

                    // $user->username   = "rabbi55";
                    // $user->password   = "123456";
                    // $user->first_name = "Fajlay";
                    // $user->last_name  = "Rabbi";

                    // $user->create();


                    
                    // $user = User::findUserById(3);

                    // $user->last_name = "Mahbub";
                    // $user->update();


                    $user = User::findUserById(2);
                    $user->delete();

                    
                
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