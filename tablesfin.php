<?php

require 'function.php';
require 'cek.php';

// Include navbar
include 'topnav.php';
?>
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Tagihan Selesai</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    DataTable <br> <br>

                    <!-- Button to Open the Modal -->
                    <a href="exportfin.php" class="btn btn-info">Print</a>
                    <a href="printallfin.php" target="_blank" class="btn btn-info">Print Semua</a>
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
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                $retrieveDat = mysqli_query($conn, "select * from outstand WHERE status = true");

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
                                    <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#unfinish<?=$idb;?>">
                                            Belum Selesai
                                        </button>
                                        <input type="hidden" name="unfinishitem" value="<?=$idb;?>">
                                    </td>
                                </tr>
                                 <!-- Selesai Modal -->                                           
                                <div class="modal fade" id="unfinish<?=$idb;?>">
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

                                                    Kembalikan tagihan <?=$tanggal; ?> milik <?=$airlines;?> untuk pembukuan 
                                                    <?=$pembukuan;?> ke belum selesai? <br> <br>

                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                    <button type="submit" class="btn btn-danger" name="unfinishdata">Ya</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                    <th></th>
                                </tr>
                            </tfoot>
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


