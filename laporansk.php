<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        echo "<script language='javascript'>alert('Anda harus login terlebih dahulu!!!'); document.location.href='login.php';</script>";
    } else {
    include 'config/db.php';
    include 'template/header.php';
	include 'template/sidebar.php';
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-print"></i> Laporan Produk Keluar</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Pilih Tanggal Laporan Produk Keluar</h6>
    </div>

    <form action="" method="POST">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col md-6">
                    <label for="" class="col-form-label font-weight-bold">Tanggal Awal</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-1"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" name="tglaw" class="form-control" required />
                    </div>
                </div>
                <div class="col md-6">
                    <label for="" class="col-form-label font-weight-bold">Tanggal Akhir</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-1"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" name="tglak" class="form-control" required />
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <button name="lihat" class="btn btn-info" type="submit"><i class="fas fa-fw fa-check mr-1"></i> Pilih Tanggal</button>
        </div>
    </form>
</div>

<?php
	if(isset($_POST['lihat'])){
		$tglaw = $_POST['tglaw'];
		$tglak = $_POST['tglak'];

		if($tglaw=="" || $tglak==""){
			header("Location: laporansk.php");
			die();
		} else {
			$query = mysqli_query($conn, "SELECT * FROM tb_suratkeluar WHERE tgl_keluar BETWEEN '$tglaw' AND '$tglak'");
			?>
<div class="card shadow mb-4">
    <div class="card-header card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Data Laporan Surat Keluar <?=$tglaw?> s/d <?=$tglak?></h6>
    </div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th>Tujuan Surat</th>
						<th>Kode Klasifikasi</th>
						<th>Nama Produk</th>
						<th>Tanggal Keluar</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row=mysqli_fetch_assoc($query)){
					?>
					<tr align="center">
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
				</tbody>
			</table>
		</div>
	</div>

	<div class="card-footer text-right">
        <a class="btn btn-primary" target="_blank" href="cetaklpsk.php?tglaw=<?=$tglaw?>&tglak=<?=$tglak?>"><i class="fas fa-fw fa-print mr-1"></i> Cetak Laporan</a>
    </div>
</div>
<?php
		}
	}
 }
    include 'template/footer.php';
?>
