<?php
session_start();
include "../koneksi.php";

// Cek login teknisi
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'teknisi') {
    header("Location: ../index.php");
    exit;
}

// Ambil data dari form
$id_penugasan = $_POST['id_penugasan'];
$status = $_POST['status'];

// Update status
$query = mysqli_query($koneksi, "
    UPDATE penugasan 
    SET status = '$status'
    WHERE id_penugasan = '$id_penugasan'
");

// Kembali ke halaman status pemasangan
header("Location: status_pemasangan.php");




exit;
?>