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
    <link rel = "icon" href = "assets/img/icons-mca.png" type = "image/x-icon">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<?php
// Include the header
include 'topnav.php';
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit Tagihan</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                DataTable <br> <br>

                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    New Data
                </button>
                <a href="export.php" class="btn btn-info">Print</a>
                <a href="printall.php" target="_blank" class="btn btn-info">Print Semua</a>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Airlines</th>
                            <th>Pembukuan</th>
                            <th>Type</th>
                            <th>Tagihan</th>
                            <th>PPN</th>
                            <th>Konsesi</th>
                            <th>PPH</th>
                            <th>Cicilan</th>
                            <th>Edit</th>
                            <th>Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        $retrieveDat = mysqli_query($conn, "select * from outstand where status = false");

                        while ($data = mysqli_fetch_array($retrieveDat)){
                            //$i = 1;
                            $tanggal = $data['tanggal'];
                            $airlines = $data['airline'];
                            $pembukuan = $data['pembukuan'];
                            $tipe = $data['tipe'];
                            $tagihan = $data['tagihan'];
                            $ppn = $data['ppn'];
                            $konsesi = $data['konsesi'];
                            $pph = $data['pph'];
                            $cicilan = $data['cicilan'];
                            $idb = $data['idinput'];
                    ?>
                    <tr>
                        <td><?=$tanggal; ?></td>
                        <td><?=$airlines; ?></td>
                        <td><?=$pembukuan; ?></td>
                        <td><?=$tipe; ?></td>
                        <td><?=number_format($tagihan); ?></td>
                        <td><?=number_format($ppn,2); ?></td>
                        <td><?=number_format($konsesi,2); ?></td>
                        <td><?=number_format($pph,2); ?></td>
                        <td><?=number_format($cicilan); ?></td>
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>">
                                Edit
                            </button>
                            <input type="hidden" name="deleteitem" value="<?=$idb;?>">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">
                                Hapus
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#finish<?=$idb;?>">
                                Selesai
                            </button>
                            <input type="hidden" name="finishitem" value="<?=$idb;?>">
                        </td>
                    </tr>
                    <!-- Edit Modal -->                                           
                    <div class="modal fade" id="edit<?=$idb;?>">
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

                                        <input type="date" name="tanggal" value="<?=$tanggal; ?>" class="form-control" required> <br>

                                        <input type="text" name="airline" value="<?=$airlines;?>" class="form-control" required> <br>
                                        <input type="text" name="pembukuan" value="<?=$pembukuan;?>" class="form-control" required> <br>
                                        <input type="text" name="tipe" value="<?=$tipe;?>" class="form-control" required> <br>

                                        <input type="number" name="tagihan" value="<?=$tagihan;?>" placeholder="Tagihan" class="form-control" required> <br>
                                        <input type="number" step=".1" name="ppn" value="<?=$ppn;?>" placeholder="PPN (%)" class="form-control" required> <br>
                                        <input type="number" step=".1" name="konsesi" value="<?=$konsesi;?>" placeholder="Konsesi (%)" class="form-control" required> <br>
                                        <input type="number" step=".1" name="pph" value="<?=$pph;?>" placeholder="PPH (%)" class="form-control" required> <br>
                                        <input type="number" name="cicilan" value="<?=$cicilan;?>" placeholder="Cicilan" class="form-control" required> <br>

                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                        <button type="submit" class="btn btn-primary" name="updatedata">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->                                           
                    <div class="modal fade" id="delete<?=$idb;?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Menghapus Data</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                                </div>
                                <!-- Modal body -->
                                <form method="post">
                                    <div class="modal-body">

                                        Menghapus tagihan <?=$tanggal; ?> milik <?=$airlines;?> untuk pembukuan <?=$pembukuan;?>? <br> <br>

                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                        <button type="submit" class="btn btn-danger" name="deletedata">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Selesai Modal -->                                           
                    <div class="modal fade" id="finish<?=$idb;?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Selesaikan Data</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                                </div>
                                <!-- Modal body -->
                                <form method="post">
                                    <div class="modal-body">

                                        Menyelesaikan tagihan <?=$tanggal; ?> milik <?=$airlines;?> untuk pembukuan 
                                        <?=$pembukuan;?>? <br> <br>

                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                        <button type="submit" class="btn btn-danger" name="finishdata">Selesai</button>
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
