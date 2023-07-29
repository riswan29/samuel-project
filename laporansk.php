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
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Data Laporan Produk keluar <?=$tglaw?> s/d <?=$tglak?></h6>
    </div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th>Jumlah Produk</th>
						<th>Kode produk</th>
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
	<?php
	if (isset($_POST['lihat'])) {
        $tglaw = $_POST['tglaw'];
        $tglak = $_POST['tglak'];

        // ...

        // Query untuk mendapatkan data yang diperlukan untuk grafik
        $chartQuery = mysqli_query($conn, "SELECT tujuan_surat, COUNT(*) AS jumlah FROM tb_suratkeluar WHERE tgl_keluar BETWEEN '$tglaw' AND '$tglak' GROUP BY tujuan_surat ORDER BY tujuan_surat ASC");

        // Menyiapkan data untuk grafik
        $labels = []; // Menyimpan label tanggal
        $data = [];   // Menyimpan tujuan_surat surat keluar
        while ($chartRow = mysqli_fetch_assoc($chartQuery)) {
            $labels[] = $chartRow['tujuan_surat'];
            $data[] = $chartRow['tujuan_surat'];
        }
    }
	?>
	<!-- Tambahkan elemen div untuk menampilkan grafik -->
<div class="card shadow mb-4">
    <div class="card-body">
        <canvas id="myChart"></canvas>
    </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Menyiapkan data untuk grafik
    var labels = <?php echo json_encode($labels); ?>;
    var data = <?php echo json_encode($data); ?>;

    // Membuat grafik menggunakan Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Produk Keluar',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
	</script>
<?php
		}
	}
 }
    include 'template/footer.php';
?>
