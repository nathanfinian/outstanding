<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Outstanding</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<?php
include 'topnav.php';
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Ganti Password dan Tambah Admin</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                DataTable <br> <br>

                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newAdmin">
                    Tambah Admin
                </button>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="userTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        $retrieveDat = mysqli_query($conn, "select * from login");
                        $i = 1;

                        while ($data = mysqli_fetch_array($retrieveDat)){

                            $idu = $data['iduser'];
                            $user = $data['userName'];
                            $pass = $data['password'];
                    ?>
                    <tr>
                        <td><?=$i++; ?></td>
                        <td><?=$user; ?></td>
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idu;?>">
                                Edit
                            </button>
                            <!-- <input type="hidden" name="deleteuser" value="<?=$idu;?>"> -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idu;?>">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <!-- Delete Modal -->                                           
                    <div class="modal fade" id="delete<?=$idu;?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Data</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                                </div>
                                <!-- Modal body -->
                                <form method="post">
                                    <div class="modal-body">

                                        Menghapus user <?=$user; ?>? <br> <br>

                                        <input type="hidden" name="idu" value="<?=$idu;?>">
                                        <button type="submit" class="btn btn-danger" name="deleteuser">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal -->                                           
                    <div class="modal fade" id="edit<?=$idu;?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Data</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                                </div>
                                <!-- Modal body -->
                                <form method="post">
                                    <div class="modal-body">

                                        <input type="text" name="newuser" value="<?=$user;?>" placeholder="Username" class="form-control" required> <br>
                                        <input type="password" name="newpass" value="<?=$pass;?>" placeholder="Password" class="form-control" required> <br>

                                        <input type="hidden" name="idu" value="<?=$idu;?>">
                                        <button type="submit" class="btn btn-primary" name="updateuser">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                        };
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</main>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<?php
include 'modal.php';
?>
</html>
