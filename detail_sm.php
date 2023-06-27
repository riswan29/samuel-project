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
                        $sqlsm = mysqli_query($conn, "SELECT * FROM tb_suratmasuk WHERE id_suratmasuk='$id'");
                        $t = mysqli_fetch_assoc($sqlsm);
                    ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-download"></i> Data Surat Masuk</h1>

    <a href="suratmasuk.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Detail Surat Masuk #<?= $t['no_suratmasuk'] ?></h6>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="30%" class="bg-light">Nomor Surat Masuk</th>
                <td><?= $t['no_suratmasuk'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Nomor Agenda Surat Masuk</th>
                <td><?= $t['no_agenda'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Asal Surat</th>
                <td><?= $t['asal_surat'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Perihal</th>
                <td><?= $t['isi_surat'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Keterangan</th>
                <td><?= $t['ket_suratmasuk'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Klasifikasi Surat</th>
                <td><?= $t['kode_klasifikasi'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Tanggal Surat</th>
                <td><?= $t['tgl_surat'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">Tanggal Diterima</th>
                <td><?= $t['tgl_diterima'] ?></td>
            </tr>

            <tr>
                <th class="bg-light">File Surat</th>
                <td>
					<?php
					if ($t['file_suratmasuk'] == 'TIDAK ADA FILE') {
						echo "<b>Tidak Ada File</b>";
					} else {
						 ?>
					<a href="fsm.php?id=<?= $t['id_suratmasuk'] ?>" ><img style="border:1px solid #ddd" src='file/suratmasuk/<?= $t['file_suratmasuk'] ?>' alt='<?= $t['file_suratmasuk'] ?>' width='30%'></a><br>
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