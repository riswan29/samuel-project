<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        echo "<script language='javascript'>document.location.href='login.php';</script>";
    } else {
        if($_SESSION['level']!=='Admin'){
            echo "<script language='javascript'>document.location.href='login.php';</script>";
        } else {
    include 'config/db.php';
    include 'template/header.php';
	include 'template/sidebar.php';
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-folder-open"></i> Data Produk</h1>

    <a href="#" data-toggle="modal" data-target="#tambahkla" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Daftar Produk Keluar</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-info text-white">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Kode Produk</th>
                        <th>Ukuran Produk</th>
                        <th>Nama Produk</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
						$sql = mysqli_query($conn, "SELECT * FROM tb_klasifikasi");
						$no = 1;
						while($row=mysqli_fetch_assoc($sql)){
					?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $row['kode_klasifikasi'] ?></td>
                        <td><?= $row['judul_klasifikasi'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a title="Edit" href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?php echo $row['id_klasifikasi']; ?>"><i class="fa fa-edit"></i></a>
                                <a title="Hapus" href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $row['id_klasifikasi']; ?>"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>

                    <!-- hapus Modal-->
                    <div class="modal fade" id="hapus<?php echo $row['id_klasifikasi']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin Mengahpus Data?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Pilih "Hapus" untuk menghapus data Produk
                                    <?= $row['judul_klasifikasi'] ?>.
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
                                    <a href="data/data_klasifikasi.php?act=hapus&id=<?php echo $row['id_klasifikasi']; ?>" class="btn btn-danger"><i class="fas fa-fw fa-check mr-1"></i> Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- editidk Modal-->
                    <div class="modal fade" id="edit<?php echo $row['id_klasifikasi']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-edit mr-1"></i> Edit Data</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="data/data_klasifikasi.php?act=edit" method="POST">
								<div class="modal-body">
                                    <?php
										$id=$row['id_klasifikasi'];
										$sqledit=mysqli_query($conn, "SELECT * FROM tb_klasifikasi WHERE id_klasifikasi='$id'");
										while($rowe=mysqli_fetch_assoc($sqledit)){
									?>
                                        <div class="form-group">
											<label class="font-weight-bold">Kode Produk</label>
											<input autocomplete="off" type="text" name="kode" required class="form-control" value="<?= $rowe['kode_klasifikasi'] ?>"/>
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Ukuran Produk</label>
											<input autocomplete="off" type="text" name="judul" required class="form-control" value="<?= $rowe['judul_klasifikasi'] ?>"/>
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Nama  Produk</label>
											<textarea name="keterangan" class="form-control"><?= $rowe['keterangan'] ?></textarea>
										</div>
                                        <input type="hidden" name="id" value="<?= $rowe['id_klasifikasi'] ?>" />
								</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
											<button class="btn btn-success" type="submit"><i class="fas fa-fw fa-save mr-1"></i> Update</button>
                                        </div>

                                    <?php } ?>

								</form>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- tambahkla Modal-->
    <div class="modal fade" id="tambahkla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-plus mr-1"></i> Tambah Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="data/data_klasifikasi.php?act=tambah" method="POST">
                        <div class="form-group">
							<label class="font-weight-bold">Kode Produk</label>
							<input autocomplete="off" type="text" name="kode" required class="form-control" />
						</div>

						<div class="form-group">
							<label class="font-weight-bold">Ukuran Produk</label>
							<input autocomplete="off" type="text" name="judul" required class="form-control" />
						</div>

						<div class="form-group">
							<label class="font-weight-bold">Nama Produk</label>
							<textarea name="keterangan" class="form-control"></textarea>
						</div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
                        <button class="btn btn-success" type="submit"><i class="fas fa-fw fa-save mr-1"></i> Simpan</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>

<?php }}
    include 'template/footer.php';
?>
