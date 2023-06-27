<?php
    $tglaw = $_GET['tglaw'];
    $tglak = $_GET['tglak'];
	include 'config/db.php';
    $query = mysqli_query($conn, "SELECT * FROM tb_suratkeluar WHERE tgl_keluar BETWEEN '$tglaw' AND '$tglak'");
    $query2 = mysqli_query($conn, "SELECT * FROM tb_instansi");
    $it = mysqli_fetch_array($query2);

?>
<!DOCTYPE html>
<html>
<head>
	<title>CETAK LAPORAN SURAT <?=$it['nama']?></title>
    <link rel="icon" type="image/x-icon" href="assets/img/pu.png">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        h1, h2, h5, p, table {
            color: black;
            font-family:'Times New Roman';
        }
        .table td, .table th {
            color: black;
            border: 1px solid black;
        }
        table, tr, th, td {
            color: black;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="text-center">
        <img src="assets/img/soppengg.png" alt="" width="15%" height="130px">
            <div class="col-md-1">

            </div>

                <h2 class="text-center"><?=$it['institusi']?></h2>
                <h3 class="text-center"><?=$it['nama']?></h3>
                <h5 class="text-center"><?=$it['alamat']?><br>



        </div>
			<div class="col-md-1"></div>
        </div>
        <hr style="border:3px solid #000">
        <h5 class="text-center font-weight-bold">LAPORAN PRODUK KELUAR</h5>
        <p class="text-center">Laporan Produk Keluar dari tanggal
        <?php
        $newDate3 = date("d-m-Y", strtotime($tglaw));
        echo $newDate3;
        ?> sampai dengan tanggal
        <?php
        $newDate3 = date("d-m-Y", strtotime($tglak));
        echo $newDate3;
        ?></p>
        <div class="row">
            <table class="table table-bordered text-dark" width="100%">
                <tr align="center">
                    <th>No</th>
                    <th>Jumlah Produk</th>
                    <th>Kode Klasifikasi</th>
                    <th>Nama Produk</th>
                    <th>Tanggal Keluar</th>
                </tr>
                <?php
                     $no = 1;
                    while($row=mysqli_fetch_assoc($query)){
                ?>
                <tr align="center">
                    <td><?=$no++?></td>
                    <td><?= $row['tujuan_surat'] ?></td>
                    <td><?= $row['kode_klasifikasi'] ?></td>
                    <td><?= $row['lampiran'] ?></td>
                    <td><?php
                            $newDate2 = date("d-m-Y", strtotime($row['tgl_keluar']));
                            echo $newDate2;
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
    <script>
		window.print();
	</script>
</html>
