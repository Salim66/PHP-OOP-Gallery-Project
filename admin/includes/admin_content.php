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

                    $user = new User();

                    $user->id         = $found_user['id'];
                    $user->username   = $found_user['username'];
                    $user->password   = $found_user['password'];
                    $user->first_name = $found_user['first_name'];
                    $user->last_name  = $found_user['last_name'];

                    echo $user->id;
                
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