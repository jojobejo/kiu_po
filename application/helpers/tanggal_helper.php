<?php
defined('BASEPATH') or exit('No direct script access allowed');

function format_indo($date)
{
    date_default_timezone_set('Asia/Jakarta');

    /** array hari dan bulan */
    $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    /** pemisahan tahun, bulan, hari, dan waktu */
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $waktu = substr($date, 11, 5);
    $hari = date("w", strtotime($date));
    $result = $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

    return $result;
}


function format_tgl($date)
{
    date_default_timezone_set('Asia/Jakarta');

    /** array hari dan bulan */
    $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    /** pemisahan tahun, bulan, hari, dan waktu */
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $result = $tgl . "-" . $bulan . "-" . $tahun;

    return $result;
}
function format_tgl_lahir($date)
{
    date_default_timezone_set('Asia/Jakarta');

    /** array hari dan bulan */
    $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    /** pemisahan tahun, bulan, hari, dan waktu */
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $waktu = substr($date, 11, 5);
    $hari = date("w", strtotime($date));
    $result = $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun;

    return $result;
}
function formatglindo($date)
{
    date_default_timezone_set('Asia/Jakarta');

    /** array hari dan bulan */
    $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    /** pemisahan tahun, bulan, hari, dan waktu */
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $waktu = substr($date, 11, 5);
    $hari = date("w", strtotime($date));
    $result = $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

    return $result;
}
function format_bulan($date)
{
    date_default_timezone_set('Asia/Jakarta');

    /** array hari dan bulan */
    $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    /** pemisahan tahun, bulan, hari, dan waktu */
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $waktu = substr($date, 11, 5);
    $hari = date("w", strtotime($date));
    $result = $Bulan[(int)$bulan - 1];

    return $result;
}

function short_bulan($bln)
{
    switch ($bln) {
        case 1:
            return "01";
            break;
        case 2:
            return "02";
            break;
        case 3:
            return "03";
            break;
        case 4:
            return "04";
            break;
        case 5:
            return "05";
            break;
        case 6:
            return "06";
            break;
        case 7:
            return "07";
            break;
        case 8:
            return "08";
            break;
        case 9:
            return "09";
            break;
        case 10:
            return "10";
            break;
        case 11:
            return "11";
            break;
        case 12:
            return "12";
            break;
    }
}

function bulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function shortdate_indo($tgl)
{
    $ubah = gmdate($tgl, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = short_bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal . '/' . $bulan . '/' . $tahun;
}

function date_indo($tgl)
{
    $ubah = gmdate($tgl, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal . '-' . $bulan . '-' . $tahun;
}

// if (!function_exists('bulan')) {
// }

// //Format Shortdate
// if (!function_exists('shortdate_indo')) {
// }

// if (!function_exists('short_bulan')) {
// }

// //Format Medium date
// if (!function_exists('mediumdate_indo')) {
//     function mediumdate_indo($tgl)
//     {
//         $ubah = gmdate($tgl, time() + 60 * 60 * 8);
//         $pecah = explode("-", $ubah);
//         $tanggal = $pecah[2];
//         $bulan = medium_bulan($pecah[1]);
//         $tahun = $pecah[0];
//         return $tanggal . '-' . $bulan . '-' . $tahun;
//     }
// }

// if (!function_exists('medium_bulan')) {
//     function medium_bulan($bln)
//     {
//         switch ($bln) {
//             case 1:
//                 return "Jan";
//                 break;
//             case 2:
//                 return "Feb";
//                 break;
//             case 3:
//                 return "Mar";
//                 break;
//             case 4:
//                 return "Apr";
//                 break;
//             case 5:
//                 return "Mei";
//                 break;
//             case 6:
//                 return "Jun";
//                 break;
//             case 7:
//                 return "Jul";
//                 break;
//             case 8:
//                 return "Ags";
//                 break;
//             case 9:
//                 return "Sep";
//                 break;
//             case 10:
//                 return "Okt";
//                 break;
//             case 11:
//                 return "Nov";
//                 break;
//             case 12:
//                 return "Des";
//                 break;
//         }
//     }
// }

// //Long date indo Format
// if (!function_exists('longdate_indo')) {
//     function longdate_indo($tanggal)
//     {
//         $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
//         $pecah = explode("-", $ubah);
//         $tgl = $pecah[2];
//         $bln = $pecah[1];
//         $thn = $pecah[0];
//         $bulan = bulan($pecah[1]);

//         $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
//         $nama_hari = "";
//         if ($nama == "Sunday") {
//             $nama_hari = "Minggu";
//         } else if ($nama == "Monday") {
//             $nama_hari = "Senin";
//         } else if ($nama == "Tuesday") {
//             $nama_hari = "Selasa";
//         } else if ($nama == "Wednesday") {
//             $nama_hari = "Rabu";
//         } else if ($nama == "Thursday") {
//             $nama_hari = "Kamis";
//         } else if ($nama == "Friday") {
//             $nama_hari = "Jumat";
//         } else if ($nama == "Saturday") {
//             $nama_hari = "Sabtu";
//         }
//         return $nama_hari . ',' . $tgl . ' ' . $bulan . ' ' . $thn;
//     }
// }
