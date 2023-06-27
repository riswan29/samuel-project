<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        echo "<script language='javascript'>alert('Anda harus login terlebih dahulu!!!'); document.location.href='login.php';</script>";
    } else {
    include 'config/db.php';
    include 'template/header.php';
	include 'template/sidebar.php';
?>
                    <?php
                        $id = $_GET['id'];
                        $sqlsm = mysqli_query($conn, "SELECT * FROM tb_suratkeluar WHERE id_suratkeluar='$id'");
                        $t = mysqli_fetch_assoc($sqlsm);
                    ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-upload"></i> Data Surat Keluar</h1>

    <a href="suratkeluar.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Detail Surat Keluar #<?= $t['no_suratkeluar'] ?></h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="30%" class="bg-light">Nomor Surat Keluar</th>
                <td><?= $t['no_suratkeluar'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Lampiran</th>
                <td><?= $t['lampiran'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Tujuan Surat</th>
                <td><?= $t['tujuan_surat'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Perihal</th>
                <td><?= $t['perihal'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Isi surat</th>
                <td><?= $t['isi_surat'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Keterangan</th>
                <td><?= $t['ket_suratkeluar'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Klasifikasi Surat</th>
                <td><?= $t['kode_klasifikasi'] ?></td>
            </tr>


            <tr>
            <th class="bg-light">Kepada</th>
            <td>
                <?php
                $kepada_values = explode(",", $t['kepada']);
                foreach ($kepada_values as $kepada) {
                    echo "<ol>" . $kepada . "</ol>";
                }
                ?>
            <td>
            </tr>





            <tr>
                <th class="bg-light">Tanggal Surat</th>
                <td><?= $t['tgl_surat'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Tanggal Diterima</th>
                <td><?= $t['tgl_keluar'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">File Surat</th>
                <td>
					<?php
					if ($t['file_suratkeluar'] == 'TIDAK ADA FILE') {
						echo "<b>Tidak Ada FIle</b>";
					} else {
						 ?>
					<a href="fsk.php?id=<?= $t['id_suratkeluar'] ?>" ><img style="border:1px solid #ddd" src='file/suratkeluar/<?= $t['file_suratkeluar'] ?>' alt='<?= $t['file_suratkeluar'] ?>' width='30%'></a><br>
					<?php
					}
					?>
				</td>
            </tr>
        </table>
    </div>
</div>

<?php }
    include 'template/footer.php';
?>
