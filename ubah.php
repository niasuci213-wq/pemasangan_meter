<?php
session_start();
include "../koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: data_umum.php");
    exit;
}

$id = $_GET['id'];

// Ambil data pelanggan
$query = mysqli_query($koneksi,
    "SELECT * FROM pelanggan WHERE id_pelanggan='$id'"
);

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data pelanggan tidak ditemukan.";
    exit;
}

// Jika tombol simpan ditekan
if (isset($_POST['simpan'])) {

    $no_pelanggan    = $_POST['no_pelanggan'];
    $nama_pelanggan  = $_POST['nama_pelanggan'];
    $alamat          = $_POST['alamat'];
    $no_hp            = $_POST['no_hp'];
    $kelurahan       = $_POST['Kelurahan'];
    $kondisi_meter   = $_POST['Kondisi_Meter'];
    $jenis_pelanggan = $_POST['Jenis_Pelanggan'];

    $update = mysqli_query($koneksi, "
        UPDATE pelanggan SET
            no_pelanggan='$no_pelanggan',
            nama_pelanggan='$nama_pelanggan',
            alamat='$alamat',
            no_hp='$no_hp',
            Kelurahan='$kelurahan',
            Kondisi_Meter='$kondisi_meter',
            Jenis_Pelanggan='$jenis_pelanggan'
        WHERE id_pelanggan='$id'
    ");

    if ($update) {
        header("Location: data_umum.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ubah Data Pelanggan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{
    margin:0;
    background:#f4f6f9;
    font-family:Arial, sans-serif;
}

.container{
    max-width:700px;
    margin:40px auto;
}

.card{
    border:none;
    border-radius:15px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
}

.card-header{
    background:#0d6efd;
    color:white;
    border-radius:15px 15px 0 0;
    padding:20px;
}

.form-label{
    font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

    <div class="card">

        <div class="card-header">
            <h4 class="mb-0">✏️ Ubah Data Pelanggan</h4>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">NPA</label>

                    <input type="text"
                           name="no_pelanggan"
                           class="form-control"
                           value="<?= htmlspecialchars($data['no_pelanggan']); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Pelanggan</label>

                    <input type="text"
                           name="nama_pelanggan"
                           class="form-control"
                           value="<?= htmlspecialchars($data['nama_pelanggan']); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>

                    <textarea name="alamat"
                              class="form-control"
                              required><?= htmlspecialchars($data['alamat']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">No HP</label>

                    <input type="text"
                           name="no_hp"
                           class="form-control"
                           value="<?= htmlspecialchars($data['no_hp']); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelurahan</label>

                    <input type="text"
                           name="Kelurahan"
                           class="form-control"
                           value="<?= htmlspecialchars($data['Kelurahan']); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kondisi Meter</label>

                    <select name="Kondisi_Meter"
                            class="form-control"
                            required>

                        <option value="">-- Pilih Kondisi Meter --</option>

                        <option value="Meter Hilang"
                            <?= ($data['Kondisi_Meter'] == 'Meter Hilang') ? 'selected' : ''; ?>>
                            Meter Hilang
                        </option>

                        <option value="Meter Pecah"
                            <?= ($data['Kondisi_Meter'] == 'Meter Pecah') ? 'selected' : ''; ?>>
                            Meter Pecah
                        </option>

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Pelanggan</label>

                    <select name="Jenis_Pelanggan"
                            class="form-control"
                            required>

                        <option value="">-- Pilih Jenis Pelanggan --</option>

                        <option value="Rumah Tangga"
                            <?= ($data['Jenis_Pelanggan'] == 'Rumah Tangga') ? 'selected' : ''; ?>>
                            Rumah Tangga
                        </option>

                        <option value="Sosial"
                            <?= ($data['Jenis_Pelanggan'] == 'Sosial') ? 'selected' : ''; ?>>
                            Sosial
                        </option>

                    </select>
                </div>

                <button type="submit"
                        name="simpan"
                        class="btn btn-primary">
                    💾 Simpan Perubahan
                </button>

                <a href="data_umum.php"
                   class="btn btn-secondary">
                    Batal
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>