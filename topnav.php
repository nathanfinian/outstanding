<nav class="navbar navbar-expand-sm bg-dark sticky-top navbar-dark">
    <a class="navbar-brand" href="index.php">Outstanding MCA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Tabel Utama</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tablesfin.php">Tagihan Selesai</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tables.php">Edit Tagihan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="panduan.php">Panduan</a>
        </li>    
        </ul>
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        </form>
        <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="settings.php">Settings</a>
                <!-- <a class="dropdown-item" href="#">Activity Log</a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
    </div>  
</nav>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
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
        });
    });
</script>