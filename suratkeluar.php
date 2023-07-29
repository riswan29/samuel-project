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
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-file"></i> Data Produk Keluar</h1>


	<a href="#" data-toggle="modal" data-target="#tambahsk" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data Produk Keluar </a>

</div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Daftar Data Produk Keluar</h6>
						</div>
						<div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead class="bg-info text-white">
										<tr align="center">
											<th width="5%">No</th>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>

                                            <th>Jumlah Produk</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = mysqli_query($conn, "SELECT * FROM tb_suratkeluar");
                                            $no = 1;
                                            while($row=mysqli_fetch_assoc($sql)){
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $row['kode_klasifikasi'] ?></td>
                                            <td><?= $row['lampiran'] ?></td>

                                            <td><?= $row['tujuan_surat'] ?></td>

                                            <td class="text-center"><?php
                                                $newDate = date("d-m-Y", strtotime($row['tgl_keluar']));
                                                echo $newDate;
                                                ?>
                                            </td>
                                            <td class="text-center">
												<div class="btn-group" role="group">


													<a title="Edit" href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?php echo $row['id_suratkeluar']; ?>"><i class="fa fa-edit"></i></a>

													<a title="Hapus" href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $row['id_suratkeluar']; ?>"><i class="fa fa-trash"></i></a>

												</div>
                                            </td>
                                        </tr>




										<!-- hapus Modal-->
                                        <div class="modal fade" id="hapus<?php echo $row['id_suratkeluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin Mengahpus Data?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Pilih "Hapus" untuk menghapus data Produk <?= $row['no_suratkeluar'] ?>.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i> Batal</button>
                                                        <a href="data/data_sk.php?act=hapus&id=<?php echo $row['id_suratkeluar']; ?>" class="btn btn-danger"><i class="fas fa-fw fa-trash mr-1"></i> Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- editidk Modal-->
                                        <div class="modal fade bd-example-modal-lg" id="edit<?php echo $row['id_suratkeluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-edit mr-1"></i> Edit Data</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="data/data_sk.php?act=edit" method="POST" enctype="multipart/form-data">
													<div class="modal-body">
                                                        <?php
                                                            $id=$row['id_suratkeluar'];
                                                            $sqledit=mysqli_query($conn, "SELECT * FROM tb_suratkeluar WHERE id_suratkeluar='$id'");
                                                            while($rowe=mysqli_fetch_assoc($sqledit)){
                                                        ?>

                                                        <div class="row">
															<div class="col-md-6">
																<input type="hidden" name="id" value="<?= $rowe['id_suratkeluar'] ?>">
																<input type="hidden" name="filelama" value="<?= $rowe['file_suratkeluar'] ?>" id="">



																<div class="form-group">
																	<label class="font-weight-bold">Nama Produk</label>
																	<input autocomplete="off" type="text" name="lampiran" required class="form-control" value="<?= $rowe['lampiran'] ?>"/>
																</div>

																<div class="form-group">
																	<label class="font-weight-bold">Jumlah</label>
																	<input autocomplete="off" type="text" name="tujuan" required class="form-control" value="<?= $rowe['tujuan_surat'] ?>"/>
																</div>


                                                                <div class="form-group">
																	<label class="font-weight-bold">Kepada</label>
																	<textarea name="kepada" class="form-control" required><?= $rowe['kepada'] ?></textarea>
																</div>

																<div class="form-group">
																	<label class="font-weight-bold">Foto Produk</label>
																	<br />
																	<span class="text-danger">Format: jpg/jpeg/png/docx/pdf (2Mb)</span>

																	<div class="input-group mb-3">
																		<div class="custom-file">
																			<input type="file" name="filesk" class="custom-file-input" id="inputGroupFile01" />
																			<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
																		</div>
																	</div>
																	<?php
																		if($rowe['file_suratkeluar']=='TIDAK ADA FILE'){
																			echo "<b>Tidak Ada File</b>";
																		} else {
																			?>
																			<a href="fsk.php?id=<?= $rowe['id_suratkeluar'] ?>" class="btn btn-success btn-sm">Lihat Full</a>
																			<?php
																		}
																	?>
																</div>
															</div>



															<div class="col-md-6">
																<div class="form-group">
																	<label class="font-weight-bold">Kode Produk</label>
																	<select name="kla" class="form-control">
																	<option value="">--Pilih Ukuran--</option>
																	<?php
																	$tampil=mysqli_query($conn, "SELECT * FROM tb_klasifikasi");
																	while($row=mysqli_fetch_assoc($tampil))
																	{
																		if ($row['kode_klasifikasi']==$rowe['kode_klasifikasi']) {
																			echo "<option value='$row[kode_klasifikasi]' selected>$row[kode_klasifikasi] - $row[judul_klasifikasi]</option>";
																		} else {
																			echo "<option value='$row[kode_klasifikasi]'>$row[kode_klasifikasi] - $row[judul_klasifikasi]</option>";
																		}
																	}
																	?>
																	</select>
																</div>

																<div class="form-group">
																	<label class="font-weight-bold">Tanggal Keluar</label>
																	<input value="<?= $rowe['tgl_keluar'] ?>" type="date" name="tglk" required class="form-control" />
																</div>

																<div class="form-group">
																	<label class="font-weight-bold">Keterangan</label>
																	<textarea name="ket" class="form-control"><?= $rowe['ket_suratkeluar'] ?></textarea>
																</div>
															</div>
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


<!-- tambahsk Modal-->
<div class="modal fade bd-example-modal-lg" id="tambahsk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fw fa-plus mr-1"></i> Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="data/data_sk.php?act=tambah" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                                <label class="font-weight-bold">Kode Produk</label>
                                <select name="kla" class="form-control">
                                    <option value="">--Pilih Kode--</option>
                                    <?php
										$tampil=mysqli_query($conn, "SELECT * FROM tb_klasifikasi");
										while($row=mysqli_fetch_assoc($tampil))
										{
										?>
                                    <option value="<?=$row['kode_klasifikasi'] ?>">
                                        <?= $row['kode_klasifikasi'] ?>
                                        -
                                        <?= $row['judul_klasifikasi'] ?>
                                    </option>

                                    <?php
										}
										?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Produk</label>
                                <input autocomplete="off" type="text" name="lampiran" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Jumlah</label>
                                <input autocomplete="off" type="text" name="tujuan" required class="form-control" />
                            </div>




                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Keluar</label>
                                <input value="<?= date('Y-m-d') ?>" type="date" name="tglk" required class="form-control" />
                            </div>
                        </div>
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
