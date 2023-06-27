<?php
    include '../config/db.php';
    if($_GET['act']== 'tambah'){
        $no = $_POST['nosk'];
        $lampiran = $_POST['lampiran'];
        $tujuan = $_POST['tujuan'];
       
        $perihal = $_POST['perihal'];
        $isi = $_POST['isi_surat'];
        $tglsk = $_POST['tglsk'];
        $tglk = $_POST['tglk'];
     
        $kla = $_POST['kla'];
        $kepada = $_POST['kepada'];
        $ket = $_POST['ket'];
        
    
        if($_FILES['filesk']['name']==''){
            mysqli_query($conn, "INSERT INTO tb_suratkeluar VALUES (NULL, '$no', '$lampiran', '$tujuan', '$kla', '$kepada', '$perihal', '$isi', '$tglsk', '$tglk', 'TIDAK ADA FILE', '$ket')");
            echo nl2br($kepada);
                    echo "<script language='javascript'>alert('Berhasil menambah data'); document.location.href='../suratkeluar.php';</script>";
        } else {
            $rand = rand();
            $ekstensi =  array('png','jpg','jpeg','docx','pdf');
            $filename = $_FILES['filesk']['name'];
            $ukuran = $_FILES['filesk']['size'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if(!in_array($ext,$ekstensi) ) {
                echo "<script language='javascript'>alert('Ekstensi File tidak diperbolehkan');  document.location.href='../suratmasuk.php';</script>". mysqli_error($conn);
            }else{
                if($ukuran < 2044070){ //2Mb		
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filesk']['tmp_name'], '../file/suratkeluar/'.$rand.'_'.$filename);
                    mysqli_query($conn, "INSERT INTO tb_suratkeluar VALUES (NULL, '$no', '$lampiran', '$tujuan', '$kla', '$kepada',  '$perihal', '$isi', '$tglsk', '$tglk', '$xx', '$ket')");
                    echo nl2br($kepada);
                    echo "<script language='javascript'>alert('Berhasil Menambah data'); document.location.href='../suratkeluar.php';</script>";
                }else{
                    echo "<script language='javascript'>alert('Ukuran File terlalu besar'); document.location.href='../suratkeluar.php';</script>". mysqli_error($conn);
                }
            }
        }
    }
    elseif ($_GET['act'] == 'hapus'){
        $id = $_GET['id'];
        

        $sqlc = mysqli_query($conn, "SELECT * FROM tb_suratkeluar WHERE id_suratkeluar ='$id'");
        $b = mysqli_fetch_array($sqlc);
        if($b['file_suratkeluar']=="TIDAK ADA FILE"){
            $queryhapus = mysqli_query($conn, "DELETE FROM tb_suratkeluar WHERE id_suratkeluar = '$id'");
            echo "<script language='javascript'>alert('Berhasil Menghapus Data'); document.location.href='../suratkeluar.php'; </script>";
        } else {
            unlink("../file/suratkeluar/$b[file_suratkeluar]");
            //query hapus
            $queryhapus = mysqli_query($conn, "DELETE FROM tb_suratkeluar WHERE id_suratkeluar = '$id'");
    
        if ($queryhapus) {
            echo "<script language='javascript'>alert('Berhasil Menghapus Data'); document.location.href='../suratkeluar.php'; </script>";
        }
        else{
            echo "<script language='javascript'>alert('Gagal Menghapus Data');". mysqli_error($conn);
        }
        }
        mysqli_close($conn);
    }
    elseif($_GET['act']=='edit'){
        $id = $_POST['id'];
        $no = $_POST['nosk'];
        $lampiran = $_POST['lampiran'];
        $tujuan = $_POST['tujuan'];
        
        $perihal = $_POST['perihal'];
        $isi = $_POST['isi_surat'];
        $tglsk = $_POST['tglsk'];
        $tglk = $_POST['tglk'];
        
        $kla = $_POST['kla'];
        $kepada = $_POST['kepada'];
        $ket = $_POST['ket'];
        $filelama = $_POST['filelama'];
    
        if($_FILES['filesk']['name']==''){
            mysqli_query($conn, "UPDATE tb_suratkeluar SET no_suratkeluar='$no', lampiran='$lampiran', tujuan_surat='$tujuan', kode_klasifikasi='$kla', kepada='$kepada',  perihal='$perihal', isi_surat='$isi', tgl_surat='$tglsk', tgl_keluar='$tglk', ket_suratkeluar='$ket', file_suratkeluar='$filelama' WHERE id_suratkeluar='$id'");
            echo nl2br($kepada);
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../suratkeluar.php';</script>";
        } else {
            $rand = rand();
            $ekstensi =  array('png','jpg','jpeg');
            $filename = $_FILES['filesk']['name'];
            $ukuran = $_FILES['filesk']['size'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if(!in_array($ext,$ekstensi) ) {
                echo "<script language='javascript'>alert('Ekstensi File tidak diperbolehkan');  document.location.href='../suratkeluar.php';</script>". mysqli_error($conn);
            }else{
                if($ukuran < 2044070){ //2Mb	
                    $sqlc = mysqli_query($conn, "SELECT * FROM tb_suratkeluar WHERE id_suratkeluar ='$id'");
                    $b = mysqli_fetch_array($sqlc);	
                    if($b['file_suratkeluar']=='TIDAK ADA FILE'){
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filesk']['tmp_name'], '../file/suratkeluar/'.$rand.'_'.$filename);
                    mysqli_query($conn, "UPDATE tb_suratkeluar SET no_suratkeluar='$no', lampiran='$lampiran', tujuan_surat='$tujuan', kode_klasifikasi='$kla', kepada='$kepada',  perihal='$perihal', isi_surat='$isi', tgl_surat='$tglsk', tgl_keluar='$tglk', ket_suratkeluar='$ket', file_suratkeluar='$xx' WHERE id_suratkeluar='$id'");
                    echo nl2br($kepada);
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../suratkeluar.php';</script>";
                    } else {
                    unlink("../file/suratkeluar/$b[file_suratkeluar]");
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filesk']['tmp_name'], '../file/suratkeluar/'.$rand.'_'.$filename);
                    mysqli_query($conn, "UPDATE tb_suratkeluar SET no_suratkeluar='$no', lampiran='$lampiran', tujuan_surat='$tujuan',  kode_klasifikasi='$kla', kepada='$kepada', perihal='$perihal', isi_surat='$isi', tgl_surat='$tglsk', tgl_keluar='$tglk', ket_suratkeluar='$ket', file_suratkeluar='$xx' WHERE id_suratkeluar='$id'");
                    echo nl2br($kepada);
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../suratkeluar.php';</script>";
                    }
                }else{
                    echo "<script language='javascript'>alert('Ukuran File terlalu besar'); document.location.href='../suratkeluar.php';</script>". mysqli_error($conn);
                }
            }
        }
    }
?>