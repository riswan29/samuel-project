<?php
    include '../config/db.php';
    session_start();
    $ids = $_SESSION['id_user'];
    if($_GET['act']== 'edit'){
        $nama = $_POST['nama'];
        $user = $_POST['username'];
        $pass = $_POST['password'];

        
        $edit = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', username='$user', password='$pass' WHERE id_user = '$ids'");
        if($edit){
        echo "<script language='javascript'>alert('Berhasil mengubah data'); document.location.href='../keluar.php';</script>";
        } else {
            echo "<script language='javascript'>alert('Gagal mengubah data');</script>";
        }
        
    }
?>