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
            <li class="breadcrumb-item active">Panduan Website</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Panduan <br> <br>
            </div>
            <div class="card-body">
                <b>Input Data baru:</b> <br>
                New Data <b>-></b> Isi <b>-></b> Submit <b>(Harus Klik Submit)</b> <br><br>
                <b>Edit dan Hapus:</b> <br>
                Klik Edit tabel <b>-></b> Edit/Hapus <b>-></b> Simpan <b>(Harus Klik Simpan)</b> <br><br>
                <b>Print:</b> <br>
                Print <b>-> Selalu Filter </b> di kolom search sebelum print <b>-></b> Klik Print, bisa pdf dan lain-lain sesuai kebutuhan <br><br>
                <b>Sortir:</b> <br>
                Sortir bisa menggunakan tabel, <b>klik judul</b> misal Airlines untuk sortir berdasarkan Airlines, <b>klik judul</b> Tanggal untuk sortir 
                Tanggal dan seterusnya. <br><br>
                <b>Cara Filter: </b><br>
                Gunakan search untuk memfilter. <br> Contoh: <b>Februari 2022</b> ketik <b>2022-02</b> di search. <br>
                Contoh 2: <b>Februari 2022 dan hanya citilink</b> ketik <b>2022-02 citilink</b> di search. Bisa dikombinasi sendiri.

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
