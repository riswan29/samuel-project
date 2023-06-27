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
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Pengguna</h1>
</div>

<div class="alert alert-info">Note !!! Setelah mengedit data, Anda akan otomatis keluar dan harus login kembali</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Edit Profile Pengguna</h6>
    </div>
    
	<form action="data/data_profil.php?act=edit" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-row">
                <?php 
					$ids=$_SESSION['id_user'];
					$sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = '$ids'");
					while($row = mysqli_fetch_assoc($sql)){
				?>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Nama Lengkap</label>
                    <input autocomplete="off" type="text" name="nama" required class="form-control" value="<?= $row['nama'] ?>" />
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Username</label>
                    <input autocomplete="off" type="text" name="username" required class="form-control" value="<?= $row['username'] ?>" />
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Password</label>
                    <input autocomplete="off" type="text" name="password" required class="form-control" value="<?= $row['password'] ?>" />
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Level</label>
                    <input autocomplete="off" type="text" name="" required class="form-control" value="<?= $row['level'] ?>" disabled />
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
            <button class="btn btn-success" type="submit" name="edit"><i class="fas fa-fw fa-save mr-1"></i> Simpan</button>
        </div>
    </form>
</div>

<?php 
        }
    include 'template/footer.php';
?>