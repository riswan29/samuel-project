<?php
    include '../config/db.php';
    if($_GET['act']== 'tambah'){
        $no = $_POST['nosm'];
        $noag = $_POST['noag'];
        $asal = $_POST['asal'];
        $isi = $_POST['isi_surat'];
        $tglsm = $_POST['tglsm'];
        $tgld = $_POST['tglsmd'];
        $kla = $_POST['kla'];
        $ket = $_POST['ket'];
        
    
        if($_FILES['filesm']['name']==''){
            mysqli_query($conn, "INSERT INTO tb_suratmasuk VALUES (NULL, '$no', '$noag', '$asal', '$kla', '$isi', '$tglsm', '$tgld', 'TIDAK ADA FILE', '$ket')");
                    echo "<script language='javascript'>alert('Berhasil menambah data'); document.location.href='../suratmasuk.php';</script>";
        } else {
            $rand = rand();
            $ekstensi =  array('png','jpg','jpeg','docx','pdf');
            $filename = $_FILES['filesm']['name'];
            $ukuran = $_FILES['filesm']['size'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if(!in_array($ext,$ekstensi) ) {
                echo "<script language='javascript'>alert('Ekstensi File tidak diperbolehkan');  document.location.href='../suratmasuk.php';</script>". mysqli_error($conn);
            }else{
                if($ukuran < 2044070){ //2Mb		
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filesm']['tmp_name'], '../file/suratmasuk/'.$rand.'_'.$filename);
                    mysqli_query($conn, "INSERT INTO tb_suratmasuk VALUES (NULL, '$no', '$noag', '$asal', '$kla', '$isi', '$tglsm', '$tgld', '$xx', '$ket')");
                    echo "<script language='javascript'>alert('Berhasil Menambah data'); document.location.href='../suratmasuk.php';</script>";
                }else{
                    echo "<script language='javascript'>alert('Ukuran File terlalu besar'); document.location.href='../suratmasuk.php';</script>". mysqli_error($conn);
                }
            }
        }
    }
    elseif ($_GET['act'] == 'hapus'){
        $id = $_GET['id'];
        

        $sqlc = mysqli_query($conn, "SELECT * FROM tb_suratmasuk WHERE id_suratmasuk ='$id'");
        $b = mysqli_fetch_array($sqlc);
        if($b['file_suratmasuk']=="TIDAK ADA FILE"){
            $queryhapus = mysqli_query($conn, "DELETE FROM tb_suratmasuk WHERE id_suratmasuk = '$id'");
            echo "<script language='javascript'>alert('Berhasil Menghapus Data'); document.location.href='../suratmasuk.php'; </script>";
        } else {
            unlink("../file/suratmasuk/$b[file_suratmasuk]");
            //query hapus
            $queryhapus = mysqli_query($conn, "DELETE FROM tb_suratmasuk WHERE id_suratmasuk = '$id'");
    
        if ($queryhapus) {
            echo "<script language='javascript'>alert('Berhasil Menghapus Data'); document.location.href='../suratmasuk.php'; </script>";
        }
        else{
            echo "<script language='javascript'>alert('Gagal Menghapus Data');". mysqli_error($conn);
        }
        }
        mysqli_close($conn);
    }
    elseif($_GET['act']=='edit'){
        $id = $_POST['id'];
        $no = $_POST['nosm'];
        $noag = $_POST['noag'];
        $asal = $_POST['asal'];
        $isi = $_POST['isi_surat'];
        $tglsm = $_POST['tglsm'];
        $tgld = $_POST['tglsmd'];
        $kla = $_POST['kla'];
        $ket = $_POST['ket'];
        $filelama = $_POST['filelama'];
    
        if($_FILES['filesm']['name']==''){
            mysqli_query($conn, "UPDATE tb_suratmasuk SET no_suratmasuk='$no', no_agenda='$noag', asal_surat='$asal', kode_klasifikasi='$kla', isi_surat='$isi', tgl_surat='$tglsm', tgl_diterima='$tgld', ket_suratmasuk='$ket', file_suratmasuk='$filelama' WHERE id_suratmasuk='$id'");
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../suratmasuk.php';</script>";
        } else {
            $rand = rand();
            $ekstensi =  array('png','jpg','jpeg','docx','pdf');
            $filename = $_FILES['filesm']['name'];
            $ukuran = $_FILES['filesm']['size'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if(!in_array($ext,$ekstensi) ) {
                echo "<script language='javascript'>alert('Ekstensi File tidak diperbolehkan');  document.location.href='../suratmasuk.php';</script>". mysqli_error($conn);
            }else{
                if($ukuran < 2044070){ //2Mb	
                    $sqlc = mysqli_query($conn, "SELECT * FROM tb_suratmasuk WHERE id_suratmasuk ='$id'");
                    $b = mysqli_fetch_array($sqlc);	
                    if($b['file_suratmasuk']=='TIDAK ADA FILE'){
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filesm']['tmp_name'], '../file/suratmasuk/'.$rand.'_'.$filename);
                    mysqli_query($conn, "UPDATE tb_suratmasuk SET no_suratmasuk='$no', no_agenda='$noag', asal_surat='$asal', kode_klasifikasi='$kla', isi_surat='$isi', tgl_surat='$tglsm', tgl_diterima='$tgld', ket_suratmasuk='$ket', file_suratmasuk='$xx' WHERE id_suratmasuk='$id'");
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../suratmasuk.php';</script>";
                    } else {
                    unlink("../file/suratmasuk/$b[file_suratmasuk]");
                    $xx = $rand.'_'.$filename;
                    move_uploaded_file($_FILES['filesm']['tmp_name'], '../file/suratmasuk/'.$rand.'_'.$filename);
                    mysqli_query($conn, "UPDATE tb_suratmasuk SET no_suratmasuk='$no', no_agenda='$noag', asal_surat='$asal', kode_klasifikasi='$kla', isi_surat='$isi', tgl_surat='$tglsm', tgl_diterima='$tgld', ket_suratmasuk='$ket', file_suratmasuk='$xx' WHERE id_suratmasuk='$id'");
                    echo "<script language='javascript'>alert('Berhasil Mengedit data'); document.location.href='../suratmasuk.php';</script>";
                    }
                }else{
                    echo "<script language='javascript'>alert('Ukuran File terlalu besar'); document.location.href='../suratmasuk.php';</script>". mysqli_error($conn);
                }
            }
        }
    }
?>