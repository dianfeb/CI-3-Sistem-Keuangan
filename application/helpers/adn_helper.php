<?php
defined('BASEPATH') or exit('No direct script access allowed');

function title()
{
    $ci = &get_instance();
    $title = $ci->db->query("SELECT nama_website FROM tbl_identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
    return $title['nama_website'];
}

function favicon()
{
    $ci = &get_instance();
    $fav = $ci->db->query("SELECT favicon FROM tbl_identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
    return $fav['favicon'];
}

function logo()
{
    $ci = &get_instance();
    $fav = $ci->db->query("SELECT logo FROM tbl_identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
    return $fav['logo'];
}

function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Jan";
            break;
        case 2:
            return "Feb";
            break;
        case 3:
            return "Mar";
            break;
        case 4:
            return "Apr";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Jun";
            break;
        case 7:
            return "Jul";
            break;
        case 8:
            return "Agu";
            break;
        case 9:
            return "Sep";
            break;
        case 10:
            return "Okt";
            break;
        case 11:
            return "Nov";
            break;
        case 12:
            return "Des";
            break;
    }
}

function getBln($bln)
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

function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function hari_indo($date)
{
    $namahari = array(
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    );
    $hari = date('l', strtotime($date));
    $hari_ini = $namahari[$hari];
    return $hari_ini;
}

function hari_tgl_indo($date)
{
    $hari = hari_indo($date);
    $tanggal = tgl_indo($date);

    return $hari.', '.$tanggal;
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
}
