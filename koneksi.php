<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_pemasangan_meter");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>