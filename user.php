<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        echo "<script language='javascript'>alert('Anda harus login terlebih dahulu!!!'); document.location.href='login.php';</script>";
    } else {
        if($_SESSION['level']!=='Admin'){
            echo "<script language='javascript'>document.location.href='login.php';</script>";
        } else {
    include 'config/db.php';
    include 'template/header.php';
	include 'template/sidebar.php';
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Pengguna</h1>

    <a href="#" data-toggle="modal" data-target="#tambahuser" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Daftar Data Pengguna</h6>
    </div>
	<div class="card-body">
		<div class="table-responsive">
			 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Username</th>
						<th>Password</th>
						<th>Nama</th>
						<th>Level</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$sql = mysqli_query($conn, "SELECT * FROM tb_user");
					$no=1;
					while($row = mysqli_fetch_assoc($sql)){
				?>
					<tr align="center">
						<td><?= $no++ ?></td>
						<td><?= $row['username'] ?></td>
						<td><?= $row['password'] ?></td>
						<td><?= $row['nama'] ?></td>
						<td><?= $row['level'] ?></td>
						<td>
							<div class="btn-group" role="group">
                                <a title="Edit" href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?php echo $row['id_user']; ?>"><i class="fa fa-edit"></i></a>
                                <a title="Hapus" href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $row['id_user']; ?>"><i class="fa fa-trash"></i></a>
                            </div>
						</td>
					</tr>

					<!-- hapus Modal-->
					<div class="modal fade" id="hapus<?php echo $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Yakin ingin Mengahpus Data?</h5>
									<button class="close" type="button" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">Pilih "Hapus" untuk menghapus data user <?= $row['nama'] ?>.</div>
								<div class="modal-footer">
									<button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
									<a href="data/data_user.php?act=hapus&id=<?php echo $row['id_user']; ?>" class="btn btn-danger"><i class="fas fa-fw fa-trash mr-1"></i> Hapus</a>
								</div>
							</div>
						</div>
					</div>

					<!-- edit Modal-->
					<div class="modal fade" id="edit<?php echo $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-edit mr-1"></i> Edit Data</h5>
									<button class="close" type="button" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<form action="data/data_user.php?act=edit" method="POST">
									<div class="modal-body">
										<?php
											$id=$row['id_user'];
											$sqledit=mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user='$id'");
											while($rowe=mysqli_fetch_assoc($sqledit)){
										?>
										<input type="hidden" name="id" value="<?= $rowe['id_user'] ?>">
										<div class="form-group">
											<label class="font-weight-bold">Username</label>
											<input autocomplete="off" type="text" name="username" required class="form-control" value="<?= $rowe['username'] ?>"/>
										</div>

										<div class="form-group">
											<label class="font-weight-bold">Password</label>
											<input autocomplete="off" type="text" name="password" required class="form-control" value="<?= $rowe['password'] ?>"/>
										</div>

										<div class="form-group">
											<label class="font-weight-bold">Nama Lengkap</label>
											<input autocomplete="off" type="text" name="nama" required class="form-control" value="<?= $rowe['nama'] ?>"/>
										</div>

										<div class="form-group">
											<label class="font-weight-bold">Level</label>
											<select name="level" class="form-control" required>
												<option hidden value="<?= $rowe['level'] ?>"><?= $rowe['level'] ?></option>
												<option value="Staf">Staf</option>
												<option value="Admin">Admin</option>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
										<button class="btn btn-success" type="submit"><i class="fas fa-fw fa-save mr-1"></i> Update</button>
									</div>
								</form>
								<?php } ?>
							</div>
						</div>
					</div>

					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-plus mr-1"></i> Tambah Data</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form action="data/data_user.php?act=tambah" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label class="font-weight-bold">Username</label>
						<input autocomplete="off" type="text" name="username" required class="form-control"/>
					</div>

					<div class="form-group">
						<label class="font-weight-bold">Password</label>
						<input autocomplete="off" type="text" name="password" required class="form-control"/>
					</div>

					<div class="form-group">
						<label class="font-weight-bold">Nama Lengkap</label>
						<input autocomplete="off" type="text" name="nama" required class="form-control"/>
					</div>

					<div class="form-group">
						<label class="font-weight-bold">Level</label>
						<select name="level" class="form-control" required>
							<option value="">--Pilih Level--</option>
							<option value="Staf">Staf</option>
							<option value="Admin">Admin</option>
						</select>
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
