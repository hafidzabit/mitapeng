@extends('layout/main')

@section('title','MitaPeng - Mitra Pengolahan')

@section('container')

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="..\resources\css\index.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<?php

$tanggal =  date('d-m-Y', strtotime("today"));
$day = date('D', strtotime($tanggal));
$dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
);

$start1 = "00";
$end1 = "13";
$start2 = "13";
$end2 = "19";
$start3 = "19";
$end3 = "23";
$now = date('H');

$target_correction = 1000000;
$target_guletin = 900;
$target_scan = 900;

$target_tim_guletin = 160;
$target_tim_scan = 40;
$target_tim_validasi_pagi = 6400;
$target_tim_validasi_malam = 5700;



$persen_guletin = round($totalGuletin[0]->jumlah / $target_guletin * 100);
$persen_scan = round($totalScan[0]->jumlah / $target_scan * 100);
$persen_correction = round($totalCorrection[0]->jumlah / $target_correction * 100);
?>
<div class="container">
<div id="container">
</div>

    <body class="grey-bg">
        <h2 class="text-bold text-center">DASHBOARD PROGRESS PENGOLAHAN SP2020 </h2>
        <h5 class="text-center mb-4"> BADAN PUSAT STATISTIK PROVINSI ACEH</h5>



        <div class="card shadow rounded" style="padding: 15px;">
            <h3  class = "text-center font-weight-bold">Today's Report</h4>
            <div class="row" style="margin-top: 20pt;">
                <div class="col-md-4 col-xl">
                    <div class="card shadow " style="background-color: #fbfadb;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-cut" style="color: #efea89;"></i>
                            </div>
                            <h5 class="card-title font-weight-bold text-center" style="font-size :1.4rem">Guletin</h5>
                            <div class="row">
                                <div class="col">
                                    <div class=" display-4 font-weight-bold text-center"> <?= $persen_guletin. "%" ?></div>
                                    <p class="font-weight-bold text-center">dari Target Total</p>
                                </div>
                                <div class="col" >
                                    <table class="mt-3 font-weight-bold" style="font-size :1.1rem">
                                        <tr>
                                            <td>Progress</td>
                                            <td> :</td>
                                            <td>{{$totalGuletin[0]->jumlah}} Box</td>
                                        </tr>
                                        <tr>
                                            <td>Target</td>
                                            <td> :</td>
                                            <td>{{$target_guletin}} Box</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl">
                    <div class="card shadow " style="background-color: #d2f9e8;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-print" style="color: #69ebb4;"></i>
                            </div>
                            <h5 class="card-title font-weight-bold text-center" style="font-size :1.4rem">Scan</h5>
                            <div class="row">
                                <div class="col">
                                    <div class=" display-4 font-weight-bold text-center"> <?= $persen_scan. "%" ?></div>
                                    <p class="font-weight-bold text-center">dari Target Total</p>
                                </div>
                                <div class="col" >
                                    <table class="mt-3 font-weight-bold" style="font-size :1.1rem">
                                        <tr>
                                            <td>Progress</td>
                                            <td> :</td>
                                            <td>{{$totalScan[0]->jumlah}} Box</td>
                                        </tr>
                                        <tr>
                                            <td>Target</td>
                                            <td> :</td>
                                            <td>{{$target_scan}} Box</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl">
                    <div class="card shadow " style="background-color: #f8ead8;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-check-circle" style="color: #ebc08b;"></i>
                            </div>
                            <h5 class="card-title font-weight-bold text-center" style="font-size :1.4rem">Correction</h5>
                            <div class="row">
                                <div class="col">
                                    <div class=" display-4 font-weight-bold text-center"> <?=  $persen_correction. "%" ?></div>
                                    <p class="font-weight-bold text-center">dari Target Total</p>
                                </div>
                                <div class="col" >
                                    <table class="mt-3 font-weight-bold" style="font-size :0.1.1rem">
                                        <tr>
                                            <td>Progress</td>
                                            <td> :</td>
                                            <td>{{$totalCorrection[0]->jumlah}} RT</td>
                                        </tr>
                                        <tr>
                                            <td>Target</td>
                                            <td> :</td>
                                            <td>1000000 RT</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl">
                    <div class="card shadow " style="background-color: #daebdb;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-map" style="color: #acd2ae;"></i>
                            </div>
                            <h5 class="card-title font-weight-bold" style="font-size :1.4rem">Cek Id Wilayah</h5>
                            <div class="display-4 font-weight-bold">{{$jumlah_cek_wilayah[0]->jumlah_cek_wilayah}}</div>
                            <p class="card-text text-black mb-2"> Box</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow rounded" style="padding: 15px;">
            <h4 class = "text-center font-weight-bold">Capaian Tim</h4>
            
            <div class="row" style="margin-top: 20pt;">
            <?php foreach($tim_guletin as $row){ ?>
                <div class="col-md-4 col-xl">
                    <div class="card shadow " style="background-color: #fbfadb;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-cut" style="color: #efea89;"></i>
                            </div>
                            <h5 class="card-title font-weight-bold text-center" style="font-size :1.4rem"> <?php echo  "TIM ".$row->kode_tim ?></h5>
                            <div class="row">
                                <div class="col">
                                    <div class=" display-4 font-weight-bold text-center"> <?php echo round($row->persen)."%" ?></div>
                                    <p class="font-weight-bold text-center">dari Target Bulanan</p>
                                </div>
                                <div class="col" >
                                    <table class="mt-3 font-weight-bold" style="font-size :1.1rem">
                                        <tr>
                                            <td>Progress</td>
                                            <td> :</td>
                                            <td>{{$row->jumlah}} Box</td>
                                        </tr>
                                        <tr>
                                            <td>Target</td>
                                            <td> :</td>
                                            <td>{{$target_tim_guletin}} Box</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
            </div>
            <div class="row" style="margin-top: 20pt;">
            <?php foreach($tim_scan as $row){ ?>
                <div class="col-md-4 col-xl">
                    <div class="card shadow " style="background-color: #d2f9e8;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-print" style="color: #69ebb4;"></i>
                            </div>
                            <h5 class="card-title font-weight-bold text-center" style="font-size :1.4rem"> <?php echo  "TIM ".$row->kode_tim ?></h5>
                            <div class="row">
                                <div class="col">
                                    <div class=" display-4 font-weight-bold text-center"> <?php echo round($row->persen)."%" ?></div>
                                    <p class="font-weight-bold text-center">dari Target Bulanan</p>
                                </div>
                                <div class="col" >
                                    <table class="mt-3 font-weight-bold" style="font-size :1rem">
                                        <tr>
                                            <td>Progress</td>
                                            <td> :</td>
                                            <td>{{$row->jumlah}} Box</td>
                                        </tr>
                                        <tr>
                                            <td>Target</td>
                                            <td> :</td>
                                            <td>{{$target_tim_scan}} Box</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
            </div>
            
            <div class="row" style="margin-top: 20pt;">
            <?php foreach($tim_validasi_pagi as $row){ ?>
                <div class="col-md-4 col-xl">
                    <div class="card shadow " style="background-color: #f8ead8;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-check-circle" style="color: #ebc08b;"></i>
                            </div>
                            <h5 class="card-title font-weight-bold text-center" style="font-size :1.4rem"> <?php echo  "TIM ".$row->kode_tim ?></h5>
                            <div class="row">
                                <div class="col">
                                    <div class=" display-4 font-weight-bold text-center"> <?php echo round($row->persen)."%" ?></div>
                                    <p class="font-weight-bold text-center">dari Target Bulanan</p>
                                </div>
                                <div class="col" >
                                    <table class="mt-3 font-weight-bold" style="font-size :1.1rem">
                                        <tr>
                                            <td>Progress</td>
                                            <td> :</td>
                                            <td>{{$row->jumlah}} RT</td>
                                        </tr>
                                        <tr>
                                            <td>Target</td>
                                            <td> :</td>
                                            <td>{{$row->target}} RT</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
            </div>
            
             <div class="row" style="margin-top: 20pt;">
            <?php foreach($tim_validasi_malam as $row){ ?>
                <div class="col-md-4 col-xl">
                    <div class="card shadow " style="background-color: #f8ead8;">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-check-circle" style="color: #ebc08b;"></i>
                            </div>
                            <h5 class="card-title font-weight-bold text-center" style="font-size :1.4rem"> <?php echo  "TIM ".$row->kode_tim ?></h5>
                            <div class="row">
                                <div class="col">
                                    <div class=" display-4 font-weight-bold text-center"> <?php echo round($row->persen)."%" ?></div>
                                    <p class="font-weight-bold text-center">dari Target Bulanan</p>
                                </div>
                                <div class="col" >
                                    <table class="mt-3 font-weight-bold" style="font-size :1.1rem">
                                        <tr>
                                            <td>Progress</td>
                                            <td> :</td>
                                            <td>{{$row->jumlah}} RT</td>
                                        </tr>
                                        <tr>
                                            <td>Target</td>
                                            <td> :</td>
                                            <td>{{$row->target}} RT</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
            </div>
        </div>


        <div class="row">
            <div class="col" width="240px" height="180px">


                <div class="card shadow-lg mt-2" style="padding : 3%;background-color: #fffffd;">
                    <div class="card-header text-center mb-3" style="background-color: transparent; color :#757575">
                        <h4>Grafik Progess (Box) </h4>
                    </div>

                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-guletin-tab" data-toggle="tab" href="#nav-guletin" role="tab" aria-controls="nav-guletin" aria-selected="true">Guletin</a>
                                <a class="nav-item nav-link" id="nav-scan-tab" data-toggle="tab" href="#nav-scan" role="tab" aria-controls="nav-scan" aria-selected="false">Scan</a>
                                <a class="nav-item nav-link" id="nav-validasi-tab" data-toggle="tab" href="#nav-validasi" role="tab" aria-controls="nav-validasi" aria-selected="false">Correction</a>
                                <a class="nav-item nav-link" id="nav-cek-tab" data-toggle="tab" href="#nav-cek" role="tab" aria-controls="nav-cek" aria-selected="false">Cek Id Wilayah</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-guletin" role="tabpanel" aria-labelledby="nav-guletin-tab">
                                <div class="card">
                                    <canvas id="myProgressGuletin"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-scan" role="tabpanel" aria-labelledby="nav-scan-tab">
                                <div class="card">
                                    <canvas id="myProgressScan"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-validasi" role="tabpanel" aria-labelledby="nav-validasi-tab">
                                <div class="card">
                                    <canvas id="myProgressValidasi"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-cek" role="tabpanel" aria-labelledby="nav-cek-tab">
                                <div class="card">
                                    <canvas id="myProgressCek"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col">
                <div class="card shadow-lg mt-2" style="padding : 3%;background-color: #fbfffb;">
                    <div class="card-header text-center mb-3" style="background-color: transparent; color :#757575">
                        <h4>Absensi Kehadiran Mitra</h4>
                        <h5> <?= $tanggal ?></h5>
                    </div>

                    <div class="card-body" style="text-align: center;">

                        <div class="chart-container " style="position: relative; height:50%; width:50%; top:25%; left:25%;">
                            <canvas class="mb-4" id="chartAbsensi"></canvas>
                        </div>


                        <nav class="nav-justified">
                            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">Sudah</a>
                                <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false">Belum</a>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                                <div class="pt-3"></div>
                                <div class="text-center">
                                    <h4> </h4>

                                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                        <table class="table table-bordered table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">No</th>
                                                    <th style="width: 60%">Nama</th>
                                                    <th style="width: 30%">Jam Hadir</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $n = 1;



                                                foreach ($sudahAbsen as $data) {
                                                    if ($now >= $start1 && $now < $end1)
                                                        if ($data->shift_id === 1) {
                                                ?>
                                                        <tr id="check<?= $n ?>">
                                                            <td><?= $n ?></td>
                                                            <td class="text-left"> {{$data->nama_lengkap}}</td>
                                                            <td><?= $data->waktu ?></td>
                                                        </tr>

                                                    <?php
                                                            $n++;
                                                        }
                                                    elseif ($now >= $start2 && $now < $end2)
                                                        if ($data->shift_id === 2) {
                                                    ?>
                                                        <tr id="check<?= $n ?>">
                                                            <td><?= $n ?></td>
                                                            <td class="text-left">{{$data->nama_lengkap}}</td>
                                                            <td><?= $data->waktu ?></td>
                                                        </tr>

                                                    <?php
                                                            $n++;
                                                        }
                                                    elseif ($now >= $start3 && $now < $end3)
                                                        if ($data->shift_id === 3) {
                                                    ?>
                                                        <tr id="check<?= $n ?>">
                                                            <td><?= $n ?></td>
                                                            <td class="text-left">{{$data->nama_lengkap}}</td>
                                                            <td><?= $data->waktu ?></td>
                                                        </tr>

                                                <?php
                                                            $n++;
                                                        }
                                                }
                                                ?>
                                            </tbody>

                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- isian -->
                            </div>
                            <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                                <div class="pt-3"></div>
                                <div class="text-center">
                                    <h4> </h4>

                                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                        <table class="table table-bordered table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%;">No</th>
                                                    <th>Nama</th>
                                                </tr>

                                            </thead>
                                            <tbody>

                                                <?php
                                                $m = 1;

                                                foreach ($belumAbsen as $data) {
                                                    if ($now >= $start1 && $now <= $end1)
                                                        if ($data->shift_id == 1) {
                                                ?>
                                                        <tr id="check<?= $m ?>">
                                                            <td><?= $m
                                                                ?></td>
                                                            <td class="text-left">{{$data->nama_lengkap}}</td>
                                                        </tr>

                                                    <?php
                                                            $m++;
                                                        }
                                                    if ($now >= $start2 && $now <= $end2)
                                                        if ($data->shift_id == 2) {
                                                    ?>
                                                        <tr id="check<?= $m ?>">
                                                            <td><?= $m
                                                                ?></td>
                                                            <td class="text-left">{{$data->nama_lengkap}}</td>
                                                        </tr>

                                                    <?php
                                                            $m++;
                                                        }
                                                    if ($now >= $start3 && $now <= $end3)
                                                        if ($data->shift_id == 3) {
                                                    ?>
                                                        <tr id="check<?= $m ?>">
                                                            <td><?= $m
                                                                ?></td>
                                                            <td class="text-left">{{$data->nama_lengkap}}</td>
                                                        </tr>

                                                <?php
                                                            $m++;
                                                        }
                                                }
                                                ?>


                                            </tbody>

                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>


</div>


<!-- script untuk line chart progress harian -->
<script>
    var ctx = document.getElementById('myProgressGuletin');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php foreach ($harian_guletin as $row) {
                            echo '"' . $row->tanggal . '"' . ',';
                        } ?>],
            datasets: [{
                label: 'Guillotine',
                data: [<?php foreach ($harian_guletin as $row) {
                            echo $row->jumlah . ',';
                        } ?>],
                borderWidth: 3,
                borderColor: '#293B5F',
                yAxisID: 'y',
            }, ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        },
        stacked: false,

    });
</script>

<script>
    var ctx = document.getElementById('myProgressScan');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {


            labels: [<?php foreach ($harian_scan as $row) {
                            echo '"' . $row->tanggal . '"' . ',';
                        } ?>],
            datasets: [{
                label: 'Scan',
                data: [<?php foreach ($harian_scan as $row) {
                            echo $row->jumlah . ',';
                        } ?>],
                borderWidth: 3,
                borderColor: '#2F5D62',
                yAxisID: 'y',
            }, ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        },
        stacked: false,

    });
</script>

<script>
    var ctx = document.getElementById('myProgressValidasi');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php foreach ($harian_validasi as $row) {
                            echo '"' . $row->tanggal . '"' . ',';
                        } ?>],
            datasets: [{
                label: 'Correction',
                data: [<?php foreach ($harian_validasi as $row) {
                            echo $row->jumlah . ',';
                        } ?>],
                borderWidth: 3,
                borderColor: '#4F0E0E',
                yAxisID: 'y',
            }, ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        },
        stacked: false,

    });
</script>

<script>
    var ctx = document.getElementById('myProgressCek');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php foreach ($harian_cek_wilayah as $row) {
                            echo '"' . $row->tanggal . '"' . ',';
                        } ?>],
            datasets: [{
                label: 'Cek Id Wilayah',
                data: [<?php foreach ($harian_cek_wilayah as $row) {
                            echo $row->jumlah . ',';
                        } ?>],
                borderWidth: 3,
                borderColor: '#B30753',
                yAxisID: 'y',
            }, ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        },
        stacked: false,

    });
</script>

<!-- ini pie chartnya -->
<script>
    var ctx = document.getElementById('chartAbsensi').getContext('2d');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Sudah Absensi", "Belum Absensi"],
            datasets: [{
                data: [
                    <?php
                     $belum1 = 0;
                     $belum2 = 0;
                     $belum3 = 0;
                    //  $jumlahTotal = 1;
                     
                    // if (isset($jumlahBelum1[0]->jumlah))
                    // {
                    //  return $belum1 = $jumlahBelum1[0]->jumlah;
                    // }
                    
                    // if (isset($jumlahBelum2[0]->jumlah))
                    // {
                    //  return $belum2 = $jumlahBelum2[0]->jumlah;
                    // }
                    
                    // if (isset($jumlahBelum3[0]->jumlah))
                    // {
                    //  return $belum3 = $jumlahBelum3[0]->jumlah;
                    // }
                    
                    // if (isset($jumlahTotal[0]->jumlah))
                    // {
                    //  return $jumlahTotal = $jumlahTotal[0]->jumlah;
                    // }
                    
                    $sudah1 = 1; //$jumlahTotal - $jumlahBelum1[0]->jumlah -1;
                    $sudah2 = 1;//$jumlahTotal - $jumlahBelum2[0]->jumlah -1;
                    $sudah3 = 1;//$jumlahTotal - $jumlahBelum3[0]->jumlah -1;
                    
                    if ($now >= $start1 && $now <= $end1) {
                        echo $sudah1 . ',' . $belum1;
                    }
                    if ($now >= $start2 && $now <= $end2) {
                        echo $sudah2 . ',' .  $belum2;
                    }
                    if ($now >= $start3 && $now <= $end3) {
                        echo $sudah3 . ',' . $belum3;
                    }
                    ?>
                    ],
                backgroundColor: [
                    'rgba(75, 192, 83, 0.9)',
                    'rgba(255, 0, 0, 0.8)',


                ],
            }]
        },
    });
    // The data for our dataset
</script>

<!-- untuk tabel peserta checkin -->
<style>
    .table-fixed {
        width: 100%;
        background-color: #f3f3f3;
    }

    .table-fixed tbody {
        height: 300px;
        overflow-y: auto;
        width: 100%;
    }

    .table-fixed thead,
    .table-fixed tbody,
    .table-fixed tr,
    .table-fixed td,
    .table-fixed th {
        display: block;
    }

    .table-fixed tbody td {
        float: left;
    }

    .table-fixed thead tr th {
        float: left;
        background-color: #f39c12;
        border-color: #e67e22;

    }

    #check1 {
        animation: colorchange 7s;
        /* animation-name followed by duration in seconds*/
        /* you could also use milliseconds (ms) or something like 2.5s */
        -webkit-animation: colorchange 7s;
        /* Chrome and Safari */
    }

    @keyframes colorchange {
        0% {
            background: #c8ffc8;
        }

        100% {
            background: #f2fff2;
        }
    }

    @-webkit-keyframes colorchange

    /* Safari and Chrome - necessary duplicate */
        {
        0% {
            background: #c8ffc8;
        }


        100% {
            background: #ffffff;
        }
    }

    .my-custom-scrollbar {
        position: relative;
        height: 300px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .nav-item.nav-link {
        color: #caa87d;
    }

    .nav-tabs .nav-link.active {
        background-color: #caa87d;
        color: whitesmoke;
    }

    /* untuk floating button */
    .float {
        position: fixed;
        width: 40px;
        height: 40px;
        bottom: 9%;
        right: 3%;
        background-color: #17a2b8;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 20px;
        box-shadow: 2px 2px 3px #999;
        z-index: 100;
        opacity: 50%;
    }
</style>

<style>
    .order-card {
        color: #fff;
    }

    .bg-c-blue {
        background: linear-gradient(45deg, #4099ff, #73b4ff);
    }

    .bg-c-green {
        background: linear-gradient(45deg, #2ed8b6, #59e0c5);
    }

    .bg-c-yellow {
        background: linear-gradient(45deg, #FFB64D, #ffcb80);
    }

    .bg-c-pink {
        background: linear-gradient(45deg, #FF5370, #ff869a);
    }


    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .card .card-block {
        padding: 15px;
    }

    .order-card i {
        font-size: 26px;
    }

    .f-left {
        float: left;
    }

    .f-right {
        float: right;
    }

    .grey-bg {
        background-color: #F5F7FA;
    }
</style>



@endsection
