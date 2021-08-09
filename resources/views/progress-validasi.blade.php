@extends('layout/main')

@section('title','MitaPeng - Mitra Validasi')

@section('container')


<head>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js" defer></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel=" https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.min.css">
</head>
<h3 class="text-bold text-center mt-3">LAPORAN MITRA VALIDASI </h2>
<h5 class="text-center mb-4"> Pengolahan C1 Sensus Penduduk 2020</h5>

<div class="container">
<body>
    <div class="card shadow" style="padding: 10pt;">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered table-sm" style="width:100%">
                <thead>
                    <tr class="text-center">
                        
                        <th style="width: 30%;">Nama</th>
                        <?php
                  
                    foreach ($tanggal as $row) {
                    ?>
                         <th> {{$row->tanggal}}</th>
                    <?php
                    } ?>
                    <th>TOTAL</th>
                        

                    </tr>
                </thead>
                <tbody>
                    <?php
                  
                    foreach ($validasi as $row) {
                    ?>
                        <tr>
                            
                            <td style="width: 30%;"><p><?= $row->nama_lengkap ?></p></td>
                            <td class="text-center" style="width: 14%;"><?php echo $row->tanggal_16   ?></td>
                            <td class="text-center" style="width: 14%;"><?php echo $row->tanggal_17 ?></td>
                            <td class="text-center" style="width: 14%;"><?php echo $row->tanggal_23 ?></td>
                            <td class="text-center" style="width: 14%;"><?php echo $row->tanggal_27 ?></td>
                            <td class="text-center" style="width: 14%;"><?php echo $row->tanggal_28 ?></td>
                            <td class="text-center" style="width: 14%;"><?php echo $row->tanggal_29 ?></td>
                            <td class="text-center" style="width: 14%;"><?php echo $row->TOTAL ?></td>
                        </tr>
                    <?php
                   
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</div>
<script>
$(document).ready(function() {
// Setup - add a text input to each footer cell
    $('#example thead tr').clone(true).appendTo( '#example thead' );
    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    var table = $('#example').DataTable( {
        "pageLength": 20
    } );
} );
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

@endsection