@extends('layout/main')

@section('title','MitaPeng - Mitra Pengolahan')

@section('container')


<head>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
</head>
<h2 class="text-bold text-center">RINGKASAN LAPORAN PERORANGAN </h2>
<h5 class="text-center mb-4"> Pengolahan C1 Sensus Penduduk 2020</h5>


<body>
    <div class="card shadow" style="padding: 10pt;">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered table-sm" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th style="width: 30%;">Nama</th>
                        <th style="width: 14%;">Guletin</th>
                        <th style="width: 14%;">Scan </th>
                        <th style="width: 14%;">Correction</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($progress as $row) {
                    ?>
                        <tr>
                            <td style="width: 30%;"><p><?= $row['anggota_tim'] ?></p></td>
                            <td class="text-center" style="width: 14%;"><?= $row['jumlah_guletin'] ?></td>
                            <td class="text-center" style="width: 14%;"><?= $row['jumlah_scan'] ?></td>
                            <td class="text-center" style="width: 14%;"><?= $row['jumlah_validasi'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

</html>




<style>
    table {
        font-size: 1rem;
    }

    h2 {
        font-family: 'Enriqueta', arial, serif;
        line-height: 1.25;
        margin: 0 0 10px;
        font-size: 40px;
        font-weight: bold;
    }
</style>