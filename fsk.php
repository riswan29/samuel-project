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
$sqlf = mysqli_query($conn, "SELECT * FROM tb_suratkeluar WHERE id_suratkeluar='$id'");
$h = mysqli_fetch_assoc($sqlf);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-upload"></i> Data Surat Keluar</h1>

    <a href="detail_sk.php?id=<?= $h['id_suratkeluar'] ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Detail file Surat Keluar #<?= $h['no_suratkeluar'] ?></h6>
    </div>

    <div class="card-body text-center">
    <object data="file/suratkeluar/<?=$h['file_suratkeluar']?>" width="600" height="400"></object>

    </div>
</div>

<?php }
    include 'template/footer.php';
?>