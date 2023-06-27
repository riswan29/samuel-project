<?php
    include '../config/db.php';
    if($_GET['act']== 'tambah'){
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $nama = $_POST['nama'];
        $level = $_POST['level'];
    
        //query tambah
        $querytambah =  mysqli_query($conn, "INSERT INTO tb_user VALUES(NULL , '$user' , '$pass' , '$nama', '$level')");
    
        if ($querytambah) {
            echo "<script language='javascript'>alert('Berhasil Menambah Data'); document.location.href='../user.php'; </script>";
        }
        else{
            echo "<script language='javascript'>alert('Gagal Menambah Data'); </script><a href='../index.php'>KLIK DISINI UNTUK KEMBALI KE MENU UTAMA</a>". mysqli_error($conn);
        }
    }
    elseif ($_GET['act'] == 'hapus'){
        $id = $_GET['id'];
    
        //query hapus
        $queryhapus = mysqli_query($conn, "DELETE FROM tb_user WHERE id_user = '$id'");
    
        if ($queryhapus) {
            echo "<script language='javascript'>alert('Berhasil Menghapus Data'); document.location.href='../user.php'; </script>";
        }
        else{
            echo "<script language='javascript'>alert('Gagal Menghapus Data');". mysqli_error($conn);
        }
    
        mysqli_close($koneksi);
    }
    elseif($_GET['act']=='edit'){
        $id = $_POST['id'];
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $nama = $_POST['nama'];
        $level = $_POST['level'];


        //query edit
        $queryedit = mysqli_query($conn, "UPDATE tb_user SET username='$user' , password='$pass' , nama='$nama' , level='$level' WHERE id_user='$id' ");
    
        if ($queryedit) {
            echo "<script language='javascript'>alert('Berhasil Mengedit Data'); document.location.href='../user.php';</script>";    
        }
        else{
            echo "<script language='javascript'>alert('Gagal Mengedit Data');". mysqli_error($conn);
        }
    }
?>