<?php
    $id=$_GET['id'];
	include 'config/db.php';

    $query = mysqli_query($conn, "SELECT * FROM  tb_suratkeluar WHERE tb_suratkeluar.id_suratkeluar='$id' AND id_suratkeluar=tb_suratkeluar.id_suratkeluar");
    $query2 = mysqli_query($conn, "SELECT * FROM tb_instansi");
    $it = mysqli_fetch_array($query2);
    $row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Surat</title>
    <!-- <link href="assets/css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
    <div class="text-center">
        <center>
      <img src="assets/img/user.png" alt="" width="15%" height="130px">
      <div class="col-md-1">

      </div>

      <h2 class="text-center"><?=$it['institusi']?></h2>
      <h3 class="text-center"><?=$it['nama']?></h3>
      <h5 class="text-center"><?=$it['alamat']?><br>
    </div>
    </center>



    </div>
    <hr style="border:3px solid #000">
    <div class="wrapper">
      <div class="collumn">
        <div class="baris_form">
          <h4 id="nomor">Nomor :</h4>
          <label for="" class="pesan"> <?=$row['no_suratkeluar']?> </label>
        </div>
        <div class="baris_form">
          <h4 id="lamp">Lamp :</h4>
          <label for="" class="pesan"> <?=$row['lampiran']?> Lembar </label>
        </div>
        <div class="baris_form">
          <h4 id="perihal">Perihal :</h4>
          <label for="" class="pesan pesan_text">
          <?=$row['perihal']?>
          </label>
        </div>
      </div>
      <div class="collumn">
        <div class="baris_form">
          <h4><?=$row['tgl_surat']?></h4>
        </div>
        <div class="baris_form penerima">
          <h4>Kepada</h4>
          <br />
          <div id="penerima">
            <p>YTH.</p>
            <?php
            $kepada_values = explode(",", $row['kepada']);
            foreach ($kepada_values as $kepada) {

                echo $kepada . "<br>";
            }
            ?>
          </div>
          <div>di -</div>
          <div id="lokasi">Tempat</div>
        </div>
      </div>
    </div>
  </body>
</html>
