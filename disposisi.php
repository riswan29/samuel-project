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
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-file"></i> Data Surat Masuk</h1>

    <div>
	<a href="#" data-toggle="modal" data-target="#tambahdisposisi" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
	
	<a href="suratmasuk.php" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
	</div>
</div>
					
					<div class="card shadow mb-4">						
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Disposisi Surat Masuk #<?= $t['no_suratmasuk'] ?></h6>
						</div>

						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead class="bg-info text-white">
										<tr align="center">
											<th width="5%">No</th>
                                            <th>Tujuan</th>
                                            <th>Isi</th>
                                            <th>Sifat</th>
                                            <th>Catatan</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = mysqli_query($conn, "SELECT * FROM tb_disposisi, tb_suratmasuk WHERE tb_suratmasuk.id_suratmasuk='$id' AND tb_disposisi.id_suratmasuk=tb_suratmasuk.id_suratmasuk");
                                            $no = 1;
                                            while($row=mysqli_fetch_assoc($sql)){
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $row['tujuan'] ?></td>
                                            <td><?= $row['isi_disposisi'] ?></td>
                                            <td class="text-center"><?= $row['sifat'] ?></td>
                                            <td><?= $row['catatan'] ?></td>
                                            <td class="text-center">												
												<div class="btn-group" role="group">
                                                    <a title="Print" href="cetakdisp.php?id=<?= $row['id_suratmasuk'] ?>" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-print"></i></a>
													<a title="Edit" href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?php echo $row['id_disposisi']; ?>"><i class="fa fa-edit"></i></a>
													<a title="Hapus" href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $row['id_disposisi']; ?>"><i class="fa fa-trash"></i></a>
												</div>
                                            </td>
                                        </tr>
										
										
                                        <!-- hapus Modal-->
                                        <div class="modal fade" id="hapus<?php echo $row['id_disposisi']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin Mengahpus Data?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Pilih "Hapus" untuk menghapus data Disposisi <?= $row['isi_disposisi'] ?>.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
                                                        <a href="data/data_disposisi.php?act=hapus&id=<?php echo $row['id_disposisi']; ?>" class="btn btn-danger"><i class="fas fa-fw fa-trash mr-1"></i> Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- editidk Modal-->
                                        <div class="modal fade" id="edit<?php echo $row['id_disposisi']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-edit mr-1"></i> Edit Data</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="data/data_disposisi.php?act=edit" method="POST">
														<div class="modal-body">
															<?php
																$id=$row['id_disposisi'];
																$sqledit=mysqli_query($conn, "SELECT * FROM tb_disposisi WHERE id_disposisi='$id'");
																while($rowe=mysqli_fetch_assoc($sqledit)){
															?>
															<input type="hidden" name="idsm" value="<?= $rowe['id_suratmasuk'] ?>">
															<input type="hidden" name="id" value="<?= $rowe['id_disposisi'] ?>">
															
															<div class="form-group">
																<label class="font-weight-bold">Tujuan Disposisi</label>
																<input autocomplete="off" type="text" name="tujuan" required class="form-control" value="<?= $rowe['tujuan'] ?>"/>
															</div>
															
															<div class="form-group">
																<label class="font-weight-bold">Isi Disposisi</label>
																<input autocomplete="off" type="text" name="isi" required class="form-control" value="<?= $rowe['isi_disposisi'] ?>"/>
															</div>
															
															<div class="form-group">
																<label class="font-weight-bold">Sifat Disposisi</label>
																<select name="sifat" id="" class="form-control">
																	<option hidden value="<?= $rowe['sifat'] ?>"><?= $rowe['sifat'] ?></option>
																	<option value="-">--Pilih Sifat Disposisi--</option>
                                                                    <option value="Biasa">Biasa</option>
																	<option value="Segera">Segera</option>
																	<option value="Sangat Segera">Sangat Segera</option>
																	<option value="Rahasia">Rahasia</option>
																</select>
															</div>
															
															<div class="form-group">
																<label class="font-weight-bold">Catatan Disposisi</label>
																<textarea name="catatan" class="form-control"><?= $rowe['catatan'] ?></textarea> 
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
					
					<!-- tambahdisposisi Modal-->
                    <div class="modal fade" id="tambahdisposisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-plus mr-1"></i> Tambah Data</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="data/data_disposisi.php?act=tambah" method="POST">
									<div class="modal-body">
										<input type="hidden" name="idsm" value="<?= $t['id_suratmasuk'] ?>">
										<div class="form-group">
											<label class="font-weight-bold">Tujuan Disposisi</label>
											<input autocomplete="off" type="text" name="tujuan" required class="form-control" />
										</div>
										
										<div class="form-group">
											<label class="font-weight-bold">Isi Disposisi</label>
											<input autocomplete="off" type="text" name="isi" required class="form-control" />
										</div>
										
										<div class="form-group">
											<label class="font-weight-bold">Sifat Disposisi</label>
											<select name="sifat" id="" class="form-control">
												<option value="-">--Pilih Sifat Disposisi--</option>
                                                <option value="Biasa">Biasa</option>
												<option value="Segera">Segera</option>
												<option value="Sangat Segera">Sangat Segera</option>
												<option value="Rahasia">Rahasia</option>
                                                
											</select>
										</div>
										
										<div class="form-group">
											<label class="font-weight-bold">Catatan Disposisi</label>
											<textarea name="catatan" class="form-control"></textarea> 
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
<?php }
    include 'template/footer.php';
?>