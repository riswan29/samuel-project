<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        echo "<script language='javascript'>document.location.href='login.php';</script>";
    } else {
    include 'config/db.php';
    include 'template/header.php';
	include 'template/sidebar.php';
?>

                    
					
					<div class="mb-4">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-home"></i> Dashboard</h1>
    </div>
                    
					<!-- Content Row -->
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Selamat datang <span class="text-uppercase"><b><?php echo $_SESSION['user']; ?>!</b></span> Anda dapat mengoperasikan sistem dengan wewenang sebagai <span class="text-uppercase"><b><?=$_SESSION['level']?></b></span>.
    </div>
	
                    <!-- Content Row -->
                    <div class="row">

                        <!-- sm Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <a href="suratmasuk.php"><div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Surat Masuk</div></a>
                                                <?php
                                                    $sqlsm = mysqli_query($conn, "SELECT * FROM tb_suratmasuk");
                                                    $ceksm = mysqli_num_rows($sqlsm);
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $ceksm ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-file fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <!-- sk Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <a href="suratkeluar.php"><div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Surat Keluar</div></a>
                                                <?php
                                                    $sqlsk = mysqli_query($conn, "SELECT * FROM tb_suratkeluar");
                                                    $ceksk = mysqli_num_rows($sqlsk);
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $ceksk ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-file fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- klasifikasi Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <a href="klasifikasi.php"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Klasifikasi Surat</div></a>
                                                <?php
                                                    $sqlk = mysqli_query($conn, "SELECT * FROM tb_klasifikasi");
                                                    $cekk = mysqli_num_rows($sqlk);
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $cekk ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-folder-open fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        
                        <!-- disposisi Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Data Disposisi</div>
                                                <?php
                                                    $sqld = mysqli_query($conn, "SELECT * FROM tb_disposisi");
                                                    $cekd = mysqli_num_rows($sqld);
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $cekd ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-archive fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- user Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Data Pengguna</div>
                                                <?php
                                                    $sqlu = mysqli_query($conn, "SELECT * FROM tb_user");
                                                    $ceku = mysqli_num_rows($sqlu);
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $ceku ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

						
						

                    </div>
					</div>


<?php 
    }
    include 'template/footer.php';
?>