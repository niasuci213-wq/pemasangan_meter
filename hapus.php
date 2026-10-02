<?php
include "../koneksi.php";

if (!isset($_GET['id'])) {
    die("ID pelanggan tidak ditemukan.");
}

$id = intval($_GET['id']);

/* Hapus data penugasan terlebih dahulu */
$hapus_penugasan = mysqli_query(
    $koneksi,
    "DELETE FROM penugasan WHERE id_pelanggan = $id"
);

if (!$hapus_penugasan) {
    die("Gagal menghapus data penugasan: " . mysqli_error($koneksi));
}

/* Setelah penugasan dihapus, hapus data pelanggan */
$hapus_pelanggan = mysqli_query(
    $koneksi,
    "DELETE FROM pelanggan WHERE id_pelanggan = $id"
);

if ($hapus_pelanggan) {

    echo "<script>
        alert('Data pelanggan dan penugasan berhasil dihapus.');
        window.location='data_umum.php';
    </script>";

} else {

    echo "Gagal menghapus data pelanggan: " . mysqli_error($koneksi);

}
?>






