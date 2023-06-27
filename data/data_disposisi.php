<?php
    include '../config/db.php';        

    if($_GET['act']== 'tambah'){
            $tujuan = $_POST['tujuan'];
            $isi = $_POST['isi'];
            $sifat = $_POST['sifat'];
            $catatan = $_POST['catatan'];
            $idsm = $_POST['idsm'];

        $sqlcek = mysqli_query($conn, "SELECT * FROM tb_disposisi, tb_suratmasuk WHERE tb_suratmasuk.id_suratmasuk='$idsm' AND tb_disposisi.id_suratmasuk=tb_suratmasuk.id_suratmasuk");
        $cek = mysqli_num_rows($sqlcek);
        
        if($cek>0){
            echo "<script language='javascript'>alert('Disposisi Sudah Ada !!!'); document.location.href='../disposisi.php?id=$idsm'; </script>";
        } else {
            //query tambah
            $querytambah =  mysqli_query($conn, "INSERT INTO tb_disposisi VALUES(NULL , '$tujuan' , '$isi' , '$sifat', '$catatan', '$idsm')");
        
            if ($querytambah) {
                echo "<script language='javascript'>alert('Berhasil Menambah Data'); document.location.href='../disposisi.php?id=$idsm'; </script>";
            }
            else{
                echo "<script language='javascript'>alert('Gagal Menambah Data'); </script>". mysqli_error($conn);
            }
        }      
        
    }
    elseif ($_GET['act'] == 'hapus'){
        $id = $_GET['id'];
        $sqlh = mysqli_query($conn, "SELECT * FROM tb_disposisi WHERE id_disposisi='$id'");
        $e = mysqli_fetch_array($sqlh);
        
        //query hapus
        $queryhapus = mysqli_query($conn, "DELETE FROM tb_disposisi WHERE id_disposisi = '$id'");
    
        if ($queryhapus) {
            echo "<script language='javascript'>alert('Berhasil Menghapus Data'); document.location.href='../disposisi.php?id=$e[id_suratmasuk]'; </script>";
        }
        else{
            echo "<script language='javascript'>alert('Gagal Menghapus Data');". mysqli_error($conn);
        }
    
        mysqli_close($koneksi);
    }
    elseif($_GET['act']=='edit'){
        $id = $_POST['id'];
        $tujuan = $_POST['tujuan'];
        $isi = $_POST['isi'];
        $sifat = $_POST['sifat'];
        $catatan = $_POST['catatan'];
        $idsm = $_POST['idsm'];

        //query edit
        $queryedit = mysqli_query($conn, "UPDATE tb_disposisi SET tujuan='$tujuan' , isi_disposisi='$isi' , sifat='$sifat', catatan='$catatan' WHERE id_disposisi='$id' ");
    
        if ($queryedit) {
            echo "<script language='javascript'>alert('Berhasil Mengedit Data'); document.location.href='../disposisi.php?id=$idsm';</script>";    
        }
        else{
            echo "<script language='javascript'>alert('Gagal Mengedit Data');". mysqli_error($conn);
        }
    }
?>