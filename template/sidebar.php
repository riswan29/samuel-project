<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->

    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon ">
          <img src="assets/img/user.png" width="50" height="50">
        </div>
        <div class="sidebar-brand-text mx-3">XXXXXXXXXXX</div>
      </a><br>

      <div class="sidebar-heading">
      <?= $_SESSION['level'] ?>
      </div>




      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>

	  <?php
	  if($_SESSION['level']=='Admin'){
	  ?>

	  <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        MASTER DATA
      </div>

	  <li class="nav-item">
        <a class="nav-link" href="klasifikasi.php">
        <i class="fa fa-folder-open" aria-hidden="true"></i>
          <span>Tambah Produk</span></a>
      </li>

	  <li class="nav-item">
        <a class="nav-link" href="instansi.php">
          <i class="fas fa-fw fa-university"></i>
          <span>Data Instansi</span></a>
      </li>

	  <li class="nav-item">
        <a class="nav-link" href="user.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Data Pengguna</span></a>
      </li>

	  <?php } ?>



	   <!-- USER -->

	  <!-- Divider -->
      <hr class="sidebar-divider">

<!-- Heading -->
      <div class="sidebar-heading">
        DATA SURAT
      </div>


	  <!-- <li class="nav-item">
        <a class="nav-link" href="suratmasuk.php">
        <i class="fas fa-fw fa-file"></i>
          <span>Surat Masuk</span></a>
      </li> -->

	  <li class="nav-item">
        <a class="nav-link" href="suratkeluar.php">
        <i class="fas fa-fw fa-file"></i>
          <span>Produk Keluar</span></a>
      </li>

<!-- Divider -->
<hr class="sidebar-divider">
	  <!-- Heading -->
      <div class="sidebar-heading">
        LAPORAN
      </div>
<!--
	  <li class="nav-item">
        <a class="nav-link" href="laporansm.php">
          <i class="fas fa-fw fa-print"></i>
          <span>Laporan Surat Masuk</span></a>
      </li> -->

	  <li class="nav-item">
        <a class="nav-link" href="laporansk.php">
          <i class="fas fa-fw fa-print"></i>
          <span>Laporan Produk Keluar</span></a>
      </li>







      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


		  <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn text-info d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">





            <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <?php
                                    $hariini = date('Y-m-d');
                                    $sqli = mysqli_query($conn, "SELECT * FROM tb_suratmasuk WHERE tgl_surat='$hariini'");
                                    $ceksqli = mysqli_num_rows($sqli);
                                ?>
                                <span class="badge badge-danger badge-counter"><?= $ceksqli ?></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header bg-info border border-info">
                                    Produk Masuk Hari Ini (<?= date('d-m-Y') ?>)
                                </h6>
                                <?php
                                    if($ceksqli>0){
                                    while($rowm = mysqli_fetch_array($sqli)){
                                ?>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="font-weight-bold">
                                        <div class="text-truncate"><?= $rowm['isi_surat'] ?></div>
                                        <div class="small text-gray-500"><?= $rowm['asal_surat'] ?> - <?= $rowm['no_suratmasuk'] ?></div>
                                    </div>
                                </a>
                                <?php }} else { ?>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="font-weight-bold text-center">
                                        <div class="text-truncate">Tidak Ada Surat</div>
                                    </div>
                                </a>
                                <?php } ?>
                                <a class="dropdown-item text-center small text-gray-500" href="suratmasuk.php">Lihat Semua Surat Masuk</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

			<!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="text-uppercase mr-2 d-none d-lg-inline text-gray-600 small">
					<?=$_SESSION['user']?>
				</span>
                <img class="img-profile rounded-circle" src="assets/img/pu.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
				<a class="dropdown-item" href="profil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

		<div class="container-fluid">
