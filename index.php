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
        <link rel = "icon" href = "assets/img/mca.png" type = "image/x-icon">

        <link href="DataTables/datatables.min.css" rel="stylesheet">
 
        <script src="DataTables/datatables.min.js"></script>
    </head>
<body class="sb-nav-fixed">
    <?php
    // Include navbar
    include 'topnav.php';
    ?>   
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Tabel Utama</li>
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
                        <table class="table table-striped table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
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
                                    <th>Total</th>
                                    <th>Real</th>
                                    <th>Cicilan</th>
                                    <th>Sisa</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                $retrieveDat = mysqli_query($conn, "select * from outstand WHERE status = FALSE");

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

                                $konsesir = $tagihan*$konsesi/100;

                                if($airlines == "Citilink Indonesia"){
                                    $pphr = ($tagihan + $konsesir) * $pph/100;
                                    $ppnr = $tagihan * $ppn/100;
                                    $total = $tagihan + $ppnr + $konsesir - $pphr;
                                }
                                elseif ($airlines == "Garuda Indonesia"){
                                    $pphr = ($tagihan + $konsesir) * $pph/100;
                                    $ppnr = ($tagihan + $konsesir) * $ppn/100;
                                    $total = $tagihan + $konsesir - $pphr;
                                }
                                else{
                                    $pphr = $tagihan * $pph/100;
                                    $ppnr = $tagihan * $ppn/100;
                                    $total = $tagihan + $ppnr + $konsesir - $pphr;
                                }
                            ?>
                                <tr>
                                    <td><?=$tanggal; ?></td>
                                    <td><?=$airlines; ?></td>
                                    <td><?=$pembukuan; ?></td>
                                    <td><?=$tipe; ?></td>
                                    <td><?=number_format($tagihan); ?></td>
                                    <td><?=number_format($ppnr);?></td>
                                    <td><?=number_format($konsesir); ?></td>
                                    <td><?=number_format($pphr);?></td>
                                    <td><?=number_format($total); ?></td>
                                    <td><?=number_format($tagihan - $pphr); ?></td>
                                    <td><?=number_format($cicilan);?></td>
                                    <td><?=number_format($total - $cicilan); ?></td>
                                </tr>
                                <?php
                                    };
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align:right">Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/scripts.js"></script>
</body>
    <?php
    include 'modal.php';
    ?>
</html>


