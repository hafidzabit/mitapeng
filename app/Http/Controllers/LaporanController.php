<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $jumlah_guletin = DB::select(
            'SELECT COUNT(DISTINCT(no_box)) as jumlah_guletin
            FROM `sp2020_box` 
            WHERE time_guletin > CURRENT_DATE()-1 && time_guletin < CURRENT_DATE()+1
            '
        );

        $jumlah_scan = DB::select(
            'SELECT COUNT(DISTINCT(no_box)) as jumlah_scan
            FROM `sp2020_box` 
            WHERE time_scan > CURRENT_DATE()-1 && time_scan < CURRENT_DATE()+1'
        );

        $jumlah_validasi = DB::select(
            'SELECT COUNT(DISTINCT(no_box)) as jumlah_validasi
            FROM `sp2020_isi_box` 
            WHERE time_validasi > CURRENT_DATE()-1 && time_validasi < CURRENT_DATE()+1'
        );

        $jumlah_cek_wilayah = DB::select(
            'SELECT COUNT(DISTINCT(no_box)) as jumlah_cek_wilayah
            FROM `sp2020_isi_box` 
            WHERE time_cek_wilayah > CURRENT_DATE()-1 && time_cek_wilayah < CURRENT_DATE()+1'
        );
        
        $harian_guletin = DB::select(
            'SELECT COUNT(no_box) AS jumlah, DATE(time_guletin) as tanggal
            FROM `sp2020_box`
            WHERE time_guletin is not null
            GROUP BY DATE(time_guletin)'
        );

        $harian_scan = DB::select(
            'SELECT COUNT(no_box) AS jumlah, DATE(time_scan) as tanggal
            FROM `sp2020_box`
            WHERE time_scan is not null
            GROUP BY DATE(time_scan)'
        );

        $harian_validasi = DB::select(
            'SELECT SUM(jumlah_batch) as jumlah, DATE(timestamp) as tanggal
            FROM sp2020_batch_validasi
            GROUP BY DATE(timestamp)'
        );

        $harian_cek_wilayah = DB::select(
            'SELECT COUNT(no_box) AS jumlah, DATE(time_cek_wilayah) as tanggal
            FROM `sp2020_isi_box`
            WHERE time_cek_wilayah is not null
            GROUP BY DATE(time_cek_wilayah)'
        );

        $belumAbsen = DB::select(
            'SELECT * 
            FROM
            (SELECT s.username, u.nama_lengkap, s.shift_id, s.tanggal 
            FROM sp2020_shift_user s 
            JOIN sp2020_user u on u.username = s.username 
            WHERE s.tanggal = CURRENT_DATE()) b
            LEFT JOIN
            (SELECT a.username,a.waktu,a.timestamp
             FROM sp2020_absensi a
             WHERE DATE(a.timestamp) = CURRENT_DATE()) c
             ON (b.username=c.username)
             WHERE c.timestamp IS NULL
             ORDER BY b.nama_lengkap ASC'
        );

        $sudahAbsen = DB::select(
            'SELECT * 
            FROM
            (SELECT s.username, u.nama_lengkap, s.shift_id, s.tanggal 
            FROM sp2020_shift_user s 
            JOIN sp2020_user u on u.username = s.username 
            WHERE s.tanggal = CURRENT_DATE()) b
            LEFT JOIN
            (SELECT a.username,a.waktu,a.timestamp
             FROM sp2020_absensi a
             WHERE DATE(a.timestamp) = CURRENT_DATE()) c
             ON (b.username=c.username)
             WHERE c.timestamp IS NOT NULL
             ORDER BY c.timestamp DESC'
        );

        $jumlahBelum1 = DB::select(
            'SELECT COUNT(*) as jumlah, b.shift_id 
            FROM (SELECT s.username, s.shift_id, s.tanggal 
            FROM sp2020_shift_user s 
            JOIN sp2020_user u on u.username = s.username 
            WHERE s.tanggal = CURRENT_DATE()) b 
            LEFT JOIN (SELECT a.username,a.timestamp 
            FROM sp2020_absensi a 
            WHERE DATE(a.timestamp) = CURRENT_DATE()) c ON (b.username=c.username) WHERE c.timestamp IS NULL && b.shift_id=1 
            GROUP BY b.shift_id'
        );

        $jumlahBelum2 = DB::select(
            'SELECT COUNT(*) as jumlah, b.shift_id 
            FROM (SELECT s.username, s.shift_id, s.tanggal 
            FROM sp2020_shift_user s 
            JOIN sp2020_user u on u.username = s.username 
            WHERE s.tanggal = CURRENT_DATE()) b 
            LEFT JOIN (SELECT a.username,a.timestamp 
            FROM sp2020_absensi a 
            WHERE DATE(a.timestamp) = CURRENT_DATE()) c ON (b.username=c.username) WHERE c.timestamp IS NULL && b.shift_id=2 
            GROUP BY b.shift_id'
        );

        $jumlahBelum3 = DB::select(
            'SELECT COUNT(*) as jumlah, b.shift_id 
            FROM (SELECT s.username, s.shift_id, s.tanggal 
            FROM sp2020_shift_user s 
            JOIN sp2020_user u on u.username = s.username 
            WHERE s.tanggal = CURRENT_DATE()) b 
            LEFT JOIN (SELECT a.username,a.timestamp 
            FROM sp2020_absensi a 
            WHERE DATE(a.timestamp) = CURRENT_DATE()) c ON (b.username=c.username) WHERE c.timestamp IS NULL && b.shift_id=3 
            GROUP BY b.shift_id'
        );

        $jumlahTotal = DB::select(
            'SELECT COUNT(username) as jumlah, shift_id
            FROM sp2020_shift_user  
            WHERE tanggal = CURRENT_DATE()
            GROUP BY shift_id'
        );
        
        $totalGuletin = DB::select(
            'SELECT COUNT(DISTINCT(no_box)) as jumlah
            FROM sp2020_box
            WHERE guletin !=0'
        );
        
        $totalScan = DB::select(
            'SELECT COUNT(DISTINCT(no_box)) as jumlah
            FROM sp2020_box
            WHERE scan !=0'
        );
        
        
        $totalCorrection = DB::select(
            'SELECT SUM(jumlah_batch) as jumlah 
            FROM sp2020_batch_validasi'
        );
        
        $target = DB::select('
        SELECT SUM(guletin) AS target_guletin, SUM(scan) AS target_scan, SUM(completion)as target_correction 
        FROM sp2020_target_user 
        WHERE username != "user"'
        );
        
        $tim_guletin = DB::select('
        SELECT t.kode_tim, COUNT(DISTINCT(no_box)) as jumlah,COUNT(DISTINCT(no_box))/160*100 as persen 
        FROM sp2020_box b 
        LEFT JOIN sp2020_tim_aktif t on b.user_guletin=t.username 
        WHERE guletin= 1 && DATE(time_guletin) > "2021-07-25" && username != "user"
        GROUP BY t.kode_tim
        ORDER BY t.id 
        '
        );
        
        $tim_scan = DB::select('
        SELECT t.kode_tim, COUNT(DISTINCT(no_box)) as jumlah,COUNT(DISTINCT(no_box))/40*100 as persen
        FROM sp2020_box b 
        LEFT JOIN sp2020_tim_aktif t on b.user_scan=t.username 
        WHERE scan = 1 && DATE(time_scan) > "2021-07-25"
        GROUP BY t.kode_tim
        ORDER BY t.kode_tim'
        );
        
        $tim_validasi_pagi = DB::select('
        SELECT t.kode_tim, SUM(jumlah_batch) as jumlah, SUM(jumlah_batch)/(COUNT(DISTINCT(b.username))*6400)*100 as persen, COUNT(DISTINCT(b.username))*6400 AS target 
        FROM sp2020_batch_validasi b
        LEFT JOIN sp2020_tim_aktif t on b.username=t.username 
        WHERE tanggal > "2021-07-25" && b.username != "11triama" && b.username != "11trianamahayani" && b.username != "11sitihadaina"
        	&& (t.kode_tim="C2_1" || t.kode_tim="C2_2" || t.kode_tim="C2_3" || t.kode_tim="C2_4" || t.kode_tim="C2_5")
        GROUP BY t.kode_tim
        ORDER BY t.kode_tim ASC'
        );
        
        $tim_validasi_malam = DB::select('
        SELECT t.kode_tim, SUM(jumlah_batch) as jumlah, SUM(jumlah_batch)/(COUNT(DISTINCT(b.username))*5700)*100 as persen, COUNT(DISTINCT(b.username))*5700 AS target 
        FROM sp2020_batch_validasi b
        LEFT JOIN sp2020_tim_aktif t on b.username=t.username 
        WHERE tanggal > "2021-07-25" && b.username != "11triama" && b.username != "11trianamahayani" 
        	&& (t.kode_tim!="C2_1" && t.kode_tim!="C2_2" && t.kode_tim!="C2_3" && t.kode_tim!="C2_4" && t.kode_tim!="C2_5")
        GROUP BY t.kode_tim
        ORDER BY t.kode_tim ASC'
        );
        
        return view('index', compact([
            'jumlah_guletin',
            'jumlah_scan',
            'jumlah_validasi',
            'jumlah_cek_wilayah',
            'harian_guletin',
            'harian_scan',
            'harian_validasi',
            'harian_cek_wilayah',
            'belumAbsen',
            'sudahAbsen',
            'jumlahBelum1',
            'jumlahBelum2',
            'jumlahBelum3',
            'jumlahTotal',
            'totalGuletin',
            'totalScan',
            'totalCorrection',
            'target',
            'tim_guletin',
            'tim_scan',
            'tim_validasi_pagi',
            'tim_validasi_malam'
        ]));
    }
    
    public function progress()
    {
        $progress = DB::select(
            'SELECT a.anggota_tim, a.kode_tim, a.username, IFNULL(SUM(jumlah_batch),0) as jumlah_validasi, IFNULL(COUNT(DISTINCT(b.no_box)),0) as jumlah_guletin, IFNULL(COUNT(DISTINCT(s.no_box)),0) as jumlah_scan 
            FROM sp2020_anggota_tim a
            LEFT JOIN sp2020_batch_validasi v on a.username=v.username 
            LEFT JOIN sp2020_box b on a.username=b.user_guletin 
            LEFT JOIN sp2020_box s on a.username=s.user_scan
            GROUP BY a.username
            ORDER BY a.id'
        );

        return view('progress-mitra',compact([
            'progress'
        ])
        );
    }
    
    public function validasi()
    {
        // $validasi = DB::select(
        //     'SET @sql_dinamis = (
        //         SELECT
        //             GROUP_CONCAT( DISTINCT
        //                 CONCAT(SUM( IF(DAY(tanggal) = '.'
        //                     , DAY(tanggal)
        //                     ,'.',jumlah_batch, 0) ) AS tanggal_'.', DAY(tanggal)
        //                 )
        //             )
        //         FROM sp2020_batch_validasi
        //     );
        
        // SET @SQL = CONCAT('.'SELECT IFNULL(b.username, "TOTAL") AS username, u.nama_lengkap,  '.', 
        //               @sql_dinamis, '.', SUM(jumlah_batch) as TOTAL 
        //           FROM sp2020_batch_validasi b
        //           LEFT JOIN 
        //           sp2020_user u on b.username = u.username
        //           GROUP BY username WITH ROLLUP'.'
        //       );
        
        // PREPARE stmt FROM @sql;
        // EXECUTE stmt;
        // DEALLOCATE PREPARE stmt;'
        // );
        
        $validasi = DB::select(
            'SELECT * FROM sp2020_laporan_validasi');
            
        $tanggal = DB::select(
        ' SELECT DISTINCT(tanggal) FROM sp2020_batch_validasi'
        );

        return view('progress-validasi',compact([
            'validasi',
            'tanggal'
        ])
        );
    }
}
