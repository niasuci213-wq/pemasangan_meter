<?php
include "../koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Ubah Status Pemasangan</title>

<style>
body{
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}

.container{
    width:500px;
    margin:80px auto;
}

.card{
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}

select, button{
    width:100%;
    padding:12px;
    margin-top:10px;
    border-radius:7px;
}

select{
    border:1px solid #ccc;
}

button{
    background:#0d6efd;
    color:white;
    border:none;
    cursor:pointer;
}
</style>

</head>

<body>

<div class="container">

<div class="card">

<h2>Ubah Status Pemasangan</h2>

<p>
<b>NPA:</b> <?= $row['no_pelanggan']; ?>
</p>

<p>
<b>Nama:</b> <?= $row['nama_pelanggan']; ?>
</p>

<form action="proses_status.php" method="POST">

<input type="hidden" name="id_pelanggan"
value="<?= $row['id_pelanggan']; ?>">

<label>Status Pemasangan</label>

<select name="status_pemasangan" required>

<option value="Menunggu"
<?= $row['status_pemasangan']=="Menunggu" ? "selected" : ""; ?>>
Menunggu
</option>

<option value="Proses Pemasangan"
<?= $row['status_pemasangan']=="Proses Pemasangan" ? "selected" : ""; ?>>
Proses Pemasangan
</option>

<option value="Sudah Dipasang"
<?= $row['status_pemasangan']=="Sudah Dipasang" ? "selected" : ""; ?>>
Sudah Dipasang
</option>

</select>

<button type="submit">Simpan Status</button>

</form>

</div>

</div>

</body>
</html>