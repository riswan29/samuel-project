<?php 
    $id=$_GET['id'];
	include 'config/db.php';
    $query = mysqli_query($conn, "SELECT * FROM tb_disposisi, tb_suratmasuk WHERE tb_suratmasuk.id_suratmasuk='$id' AND tb_disposisi.id_suratmasuk=tb_suratmasuk.id_suratmasuk");
    $query2 = mysqli_query($conn, "SELECT * FROM tb_instansi");
    $it = mysqli_fetch_array($query2);
    $row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>CETAK DISPOSISI <?=$it['nama']?></title>
    <link rel="icon" type="image/x-icon" href="assets/img/user.png">
	<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        h1, h2, h5, p, table {
            color: black;
            font-family:'Times New Roman';
        }

        .table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .table td, .table th{
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-1">
                <img src="assets/img/user.png" alt="" width="170%" >
            </div>
            <div class="col-md-10">
                <h2 class="text-center"><?=$it['institusi']?></h2>
                <h3 class="text-center"><?=$it['nama']?></h3>
                <h5 class="text-center"><?=$it['alamat']?><br>
                
            </div>
			<div class="col-md-1"></div>
        </div>
        <hr style="border:3px solid #000">
        <h2 class="text-center font-weight-bold">LEMBAR DISPOSISI</h2><br/>
        <div class="row-mt-2">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td width="100px">Asal Surat</td>
                        <td>: <?=$row['asal_surat']?></td>
                        <td class="text-right">Diterima Tgl.</td>
                        <td>: <?php $n = date("d-m-Y", strtotime($row['tgl_diterima']));  
                            echo $n;?></td>
                    </tr>
                    <tr>
                        <td width="100px">No. Surat</td>
                        <td>:<?=$row['no_suratmasuk']?></td>
                        <td class="text-right">No Agenda.</td>
                        <td>: <?=$row['no_agenda']?></td>
                    </tr>
                    <tr>
                        <td width="100px">Tgl. Surat</td>
                        <td>: <?php 
							$newDate = date("d-m-Y", strtotime($row['tgl_surat']));  
							echo $newDate;
							?>
                        <td class="text-right">Kode</td>
                        <td>: <?=$row['kode_klasifikasi']?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Sifat</td>
                        <td>: <?=$row['sifat']?></td>
                    </tr>
                    <tr>
                        <td width="100px">Perihal</td>
                        <td colspan="3" style="height:100px">: <?=$row['isi_surat']?></td>
                    </tr>
                    <tr>
                        <td width="150px" class="font-weight-bold">Diteruskan Kepada</td>
                        <td>: <?=$row['tujuan']?></td>
                        <td class="text-right font-weight-bold">Isi Disposisi</td>
                        <td>: <?=$row['isi_disposisi']?></td>
                    </tr>
                    <tr>
                        <td width="100px" class="font-weight-bold">Catatan</td>
                        <td colspan="3" style="height:130px">: <?=$row['catatan']?></td>
                    </tr>
                </tbody>
            </table>
			
			
            
        </div>
    </div>
</body>
    <script>
		window.print();
	</script>
</html>