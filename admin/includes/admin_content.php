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

                    $user->username   = "shamimbattery.1&";
                    $user->password   = "shamim31";
                    $user->first_name = "Shamim&*";
                    $user->last_name  = "Hossain";

                    $user->save();


                    
                    // $user = User::findUserById(6);

                    // $user->username = "Jobayer66";
                    // $user->password = "123456";
                    // $user->first_name = "Jobayer";
                    // $user->last_name = "Mahbub";
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