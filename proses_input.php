<?php
include "../koneksi.php";

$no_pelanggan = $_POST['no_pelanggan'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];

$query = mysqli_query($koneksi, "INSERT INTO pelanggan 
(no_pelanggan, nama_pelanggan, alamat, no_hp) 
VALUES 
('$no_pelanggan', '$nama_pelanggan', '$alamat', '$no_hp')");

if ($query) {
    echo "<script>
        alert('Data pelanggan berhasil disimpan');
        window.location='data_umum.php';
    </script>";
} else {
    echo "Data gagal disimpan: " . mysqli_error($koneksi);
}
?>