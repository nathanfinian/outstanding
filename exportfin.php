<?php
//import koneksi ke database
require 'function.php';
require 'cek.php';
?>
<html>
    <head>
        <title>Outstanding</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <link rel = "icon" href = "assets/img/mca.png" type = "image/x-icon">
        <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="m-4">
        <h2>Outstanding</h2>
        <a href="index.php" class="btn btn-primary">Back</a> <br> <br>
        <!-- <h4>(Inventory)</h4> -->
            <div class="data-tables datatable-dark table-responsive">
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
                            <th>Total</th>
                            <th>Real</th>
                            <th>Cicilan</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $retrieveDat = mysqli_query($conn, "select * from outstand where status = true");

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
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total:</th>
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
                    </tbody>
                </table>
               
            </div>
        </div>
            
        <script>
        $(document).ready(function() {
            $('#dataTable').DataTable( {
            pageLength: 50, // Set the default number of rows to 50
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();
    
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
    
                // Total over this page
                totaltag = api
                    .column(4, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                totalppn = api
                    .column(5, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                
                totalkon = api
                    .column(6, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                totalpph = api
                    .column(7, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                totalall = api
                    .column(8, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                totalreal = api
                    .column(9, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                totalcicil = api
                    .column(10, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                totalsis = api
                    .column(11, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                    
                // Update footer
                $(api.column(4).footer()).html(totaltag.toLocaleString());
                $(api.column(5).footer()).html(totalppn.toLocaleString());
                $(api.column(6).footer()).html(totalkon.toLocaleString());
                $(api.column(7).footer()).html(totalpph.toLocaleString());
                $(api.column(8).footer()).html(totalall.toLocaleString());
                $(api.column(9).footer()).html(totalreal.toLocaleString());
                $(api.column(10).footer()).html(totalcicil.toLocaleString());
                $(api.column(11).footer()).html(totalsis.toLocaleString());
            },
                dom: 'B<"clear">lfrtip',
                lengthMenu: [
                  [10, 25, 50, 100, 150],
                  ['10 Files', '25 Files', '50 Files', '100 Files']],
                buttons: [
                {extend: 'print', footer: true,
                    customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '13pt' );
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }},
                {extend: 'pdf', orientation: 'landscape', pageSize: 'LEGAL', footer: true },
                {extend: 'excel', footer: true }, 
                {extend: 'copy', footer: true }, 
                {extend: 'csv', footer: true }]
            } );
        } );
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    </body>
</html>