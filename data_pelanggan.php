<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php"; 

// Ambil data pelanggan
$query = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY npa ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Pelanggan</title>

<style>
*{
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    margin:0;
    background:#f4f7fa;
}

.sidebar{
    width:250px;
    height:100vh;
    background:#0d6efd;
    position:fixed;
    color:white;
}

.sidebar h3{
    text-align:center;
    padding:20px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:15px 20px;
}

.sidebar a:hover{
    background:#0b5ed7;
}

.content{
    margin-left:250px;
    padding:30px;
}

.card{
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

h2{
    color:#0d6efd;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#0d6efd;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f1f5ff;
}

.btn{
    display:inline-block;
    background:#0d6efd;
    color:white;
    padding:10px 15px;
    border-radius:7px;
    text-decoration:none;
    margin-bottom:20px;
}

.btn:hover{
    background:#0b5ed7;
}
</style>

</head>

<body>

<div class="sidebar">

<h3>ADMIN</h3>

<a href="dashboard.php">🏠 Dashboard</a>
<a href="data_pelanggan.php">👥 Data Umum</a>
<a href="#">📋 Status Pemasangan</a>
<a href="#">➕ Input</a>
<a href="../logout.php">🚪 Logout</a>

</div>

<div class="content">

<div class="card">

<h2>👥 Data Pelanggan</h2>

<a href="#" class="btn">+ Tambah Data Pelanggan</a>

<table>

<tr>
    <th>NPA</th>
    <th>Nama Pelanggan</th>
    <th>Alamat</th>
    <th>No. Telepon</th>
    <th>Jenis Pemasangan</th>
</tr>

<?php
while($data = mysqli_fetch_assoc($query)){
?>

<tr>
    <td><?php echo $data['npa']; ?></td>
    <td><?php echo $data['nama']; ?></td>
    <td><?php echo $data['alamat']; ?></td>
    <td><?php echo $data['no_telp']; ?></td>
    <td><?php echo $data['jenis_pemasangan']; ?></td>
</tr>

<?php
}
?>

</table>

</div>

</div>

</body>
</html>