<?php
function format($tanggal)
{
    $nama_bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    $tanggal_arr = explode('-', $tanggal);
    $tanggal_indonesia = intval($tanggal_arr[2]) . ' ' . $nama_bulan[intval($tanggal_arr[1])] . ' ' . $tanggal_arr[0];

    return $tanggal_indonesia;
}
function formatTanpaTahun($tanggal)
{
    $nama_bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    $tanggal_arr = explode('-', $tanggal);
    $tanggal_indonesia = intval($tanggal_arr[2]) . ' ' . $nama_bulan[intval($tanggal_arr[1])];

    return $tanggal_indonesia;
}
function formatTanggal($tanggal)
{
    $nama_bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    $tanggal_arr = explode('-', $tanggal);
    $tanggal_indonesia = intval($tanggal_arr[2]);

    return $tanggal_indonesia;
}