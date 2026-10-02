<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");

$data = mysqli_fetch_assoc($query);

if($data){

    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role'];

    if($data['role']=="admin"){
        header("Location: admin/dashboard.php");
    }elseif($data['role']=="teknisi"){
        header("Location: teknisi/dashboard.php");
    }elseif($data['role']=="pimpinan"){
        header("Location: pimpinan/dashboard.php");
    }

}else{
    echo "<script>
    alert('Username atau Password Salah');
    window.location='index.php';
    </script>";
}
?>