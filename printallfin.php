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
        <!-- <link rel="stylesheet" type="text/css" href="css/printstyles.css" media="print" /> -->
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    </head>
<body class="sb-nav-fixed">
    <main>
        <h1 style="text-align: center;">Outstanding MCA</h1> <br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm" id="" width="100%" cellspacing="0">
                <thead>
                    <tr>
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

                    $retrieveDat = mysqli_query($conn, "select *, DATE_FORMAT(tanggal, '%Y-%m') AS month from outstand where status = true
                    order by month ASC");

                    $current_month = null;

                    $tagtot = $ppntot = $kontot = $totot = $pphtot = $reatot = $cictot = $sistot = 0;
                    $grandtag = $grandppn = $grandkon = $grandtot = $grandpph = $grandrea = $grandcic = $grandsis =0;

                    while ($data = mysqli_fetch_array($retrieveDat)){
                    //$i = 1;
                    $tanggal = $data['month'];
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
                        $total =  $tagihan + $ppnr + $konsesir - $pphr;
                    }
                    elseif ($airlines == "Garuda Indonesia"){
                        $pphr = ($tagihan + $konsesir) * $pph/100;
                        $ppnr = ($tagihan + $konsesir) * $ppn/100;
                        $total =  $tagihan + $konsesir - $pphr;
                    }
                    else{
                        $pphr = $tagihan*$pph/100;
                        $ppnr = $tagihan * $ppn/100;
                        $total = $tagihan + $ppnr + $konsesir - $pphr;
                    }
                    $real = $tagihan - $pphr;
                    $sisa = $total - $cicilan;

                    if ($tanggal!=$current_month) {
                        if ($current_month!=null) {
                            $grandtag += $tagtot;
                            $grandppn += $ppntot;
                            $grandkon += $kontot;
                            $grandtot += $totot;
                            $grandpph += $pphtot;
                            $grandrea += $reatot;
                            $grandcic += $cictot;
                            $grandsis += $sistot;
                            include 'tabletot.php';
                            ?>
                            <tr><td colspan="12">-</td></tr>
                            <tr>
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
                            <?php
                            $tagtot = $ppntot = $kontot = $totot = $pphtot = $reatot = $cictot = $sistot = 0;
                        }
                        $current_month = $tanggal;
                        $tagtot = $tagihan;
                        $ppntot = $ppnr;
                        $kontot = $konsesir;
                        $pphtot = $pphr;
                        $totot = $total;
                        $reatot = $real;
                        $cictot = $cicilan;
                        $sistot = $sisa;

                        include 'tablestruc.php';
                        }else{
                            $tagtot += $tagihan;
                            $ppntot += $ppnr;
                            $kontot += $konsesir;
                            $pphtot += $pphr;
                            $totot += $total;
                            $reatot += $real;
                            $cictot += $cicilan;
                            $sistot += $sisa;
                            include 'tablestruc.php';
                        }
                    }
                    $grandtag += $tagtot;
                    $grandppn += $ppntot;
                    $grandkon += $kontot;
                    $grandtot += $totot;
                    $grandpph += $pphtot;
                    $grandrea += $reatot;
                    $grandcic += $cictot;
                    $grandsis += $sistot;
                    include 'tabletot.php';
                    ?>
                    
                    <tr><td colspan="12">-</td></tr>
                    <tr style="font-weight:bold">
                        <td colspan="3" style="text-align:right">Grand Total:</td>
                        <td><?= number_format($grandtag) ?></td>
                        <td><?= number_format($grandppn) ?></td>
                        <td><?= number_format($grandkon) ?></td>
                        <td><?= number_format($grandpph) ?></td>
                        <td><?= number_format($grandtot) ?></td>
                        <td><?= number_format($grandrea) ?></td>
                        <td><?= number_format($grandcic) ?></td>
                        <td><?= number_format($grandsis) ?></td>
                    </tr>
                    </tbody>
            </table>
            <script type="text/javascript">
                window.print();
                function printDiv() {
                    var divToPrint = document.getElementById('table');
                    var htmlToPrint = '' +
                        '<style type="text/css">' +
                        'table th, table td {' +
                        'border:1px solid #000;' +
                        'padding:0.5em;' +
                        '}' +
                        '</style>';
                    htmlToPrint += divToPrint.outerHTML;
                    newWin = window.open("");
                    newWin.document.write(htmlToPrint);
                    newWin.print();
                    newWin.close();
                }
            </script>
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


