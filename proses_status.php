<?php
include "../koneksi.php";

$id = $_POST['id_pelanggan'];
$status = $_POST['status_pemasangan'];

$query = mysqli_query($koneksi, "UPDATE pelanggan 
SET status_pemasangan='$status'
WHERE id_pelanggan='$id'");

if ($query) {
    echo "<script>
        alert('Status pemasangan berhasil diperbarui');
        window.location='status_pemasangan.php';
    </script>";
} else {
    echo "Status gagal diperbarui: " . mysqli_error($koneksi);
}
?>