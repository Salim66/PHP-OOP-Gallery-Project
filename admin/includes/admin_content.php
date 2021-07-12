<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
                <br>

                <?php
                
                    // $result_set = User::findAllUsers();

                    // while($row = mysqli_fetch_array($result_set)){
                    //     echo $row['username'] ."<br/>";
                    // }

                    $found_user = User::findUserById(2);

                    $user = User::instantiation($found_user);

                    echo $user->username;

                   
                
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