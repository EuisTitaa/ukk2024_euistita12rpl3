<?php
require 'functions/function.php';
$user_id = $_GET["user_id"];
$user = $_GET["user"];

$akun = mysqli_query ($conn, "SELECT * FROM user WHERE user_id = $user");
$foto = mysqli_query ($conn, "SELECT * FROM foto WHERE user_id = $user");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?user_id=<?=$user_id?>">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        if($user_id === '32') { 
          ?>
          
        <?php
        } else {
        ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="galeri.php?user_id=<?=$user_id?>">Galeri Anda</a>
        </li>
        <?php
        }
        ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profilSaya.php?user_id=<?=$user_id?>" style="margin-right:5px;">profil Anda</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <?php
        if($user_id === '32') { 
          ?>
          <li class="nav-item">
          <a class="btn btn-success" aria-current="page" href="Registrasi.php">Registrasi</a>
        </li>
        <?php
        } else {
        ?>
        <li class="nav-item">
          <a class="btn btn-success" aria-current="page" href="tambah.php?user=<?=$user_id?>">Tambah Foto</a>
        <li class="nav-item">
          <a class="btn btn-outline-danger" style="margin-left:5px;" aria-current="page" href="logout.php">Log Out</a>
        </li>
        </li>
        <?php
        }
        ?>
      </ul>
      
    </div>
  </div>
</nav><br>
<center>

 <?php foreach ($akun as $row) : ?>
    <img src="img/<?=$row["foto_user"]?>" class="border border-primary" alt="" style="border-radius:100%; height:300px; width:300px;"><br><br>
    <h3><?=$row["username"]?></h3>
    <?php
    $likeArray = mysqli_query ($conn, "SELECT COUNT(folow_id) FROM folow WHERE user = '$user'");
    $like= mysqli_fetch_array($likeArray);
    $like = $like["COUNT(folow_id)"];
    ?>
    <br><a href="folow.php?user_id=<?=$user_id?>&user=<?=$user?>" style="width:20%; margin-bottom:10px;" class="btn btn-success">folow</a><br>
    <a style="color:gray;" href="userfolow.php?user_id=<?=$user_id?>&user=<?=$user?>">Folowers : <?=$like?></a><br><br>
    <?php
    $anonim = $row["user_id"];
 endforeach; ?>
    <?php
        if($user === '32') { 
          ?>
          <i style="color:gray;">*Akun ini Anonim, Akun Anonim adalah akun yang belum melakukan registrasi*</i>
        <?php
        } else {
        ?>
    <?php foreach ($akun as $row) : ?>
      <table class="table border" style="width:30%;align:center;">
      <tr>
          <td><h5>Nama Lengkap</h5></td>
          <td><h5><?=$row["nama_lengkap"]?></h5></td>
      </tr>
      <tr>
          <td><h5>Email</h5></td>
          <td><h5><?=$row["email"]?></h5></td>
      </tr>
      <tr>
          <td><h5>Alamat</h5></td>
          <td><h5><?=$row["alamat"]?></h5></td>
      </tr>
      </table>
      <br>
    
      <h3>Galeri Dari <u><?=$row["username"]?></u></h3><hr><br>
    

    <?php endforeach;?>


    <?php foreach($foto as $row) : ?>
      <?php 
        $user_row = $row["user_id"]; 
        $user = mysqli_query ($conn, "SELECT username FROM user WHERE user_id = '$user_row'");
        $username= mysqli_fetch_array($user);
        $username = $username[0];

      ?>

      <?php 
        $foto_id = $row["foto_id"]; 
        $likeArray = mysqli_query ($conn, "SELECT COUNT(like_id) FROM like_foto WHERE foto_id = '$foto_id'");
        $comArray = mysqli_query ($conn, "SELECT COUNT(komentar_id) FROM komentar_foto WHERE foto_id = '$foto_id'");
        $like= mysqli_fetch_array($likeArray);
        $com= mysqli_fetch_array($comArray);
        $akun = $row["user_id"];

      ?>

      <div class="d-flex flex-row" style="margin-left:90px; width:25%; float:left;">
        <a href="komen.php?foto=<?= $row["foto_id"]; ?>&user=<?=$user_id?>" class="" style="text-decoration:none; color:black;">
        <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="width:500px; height:470px;">
        <img src="img/<?= $row["lokasi_file"]; ?>" class="card-img-top" alt="..." style="height:270px;">
      <div class="card-body">
      <h5 class="card-title"><?= $row["judul_foto"]; ?></h5>

      <h6 class="card-title">User : 

      <?php
        if ($user_id === $akun){ 
        ?>
        <a href="profilSaya.php?user_id=<?=$user_id?>"><?=$username;?></a>
        <?php } else { ?>
        <a href="profil.php?user_id=<?=$user_id?>&user=<?=$akun?>"><?=$username;?></a>
      <?php }?>  

      </h6>

      <?= $row["tanggal_unggah"]; ?><br><br>


      <a href="like.php?foto=<?= $row["foto_id"]; ?>&user=<?=$user_id?>" class="btn btn-danger">❤ <?=$like[0]?></a>
      <a href="unlike.php?foto=<?= $row["foto_id"]; ?>&user=<?=$user_id?>" class="btn btn-outline-danger">💔 </a>
      <a href="komen.php?foto=<?= $row["foto_id"]; ?>&user=<?=$user_id?>" class="btn btn-outline-dark">komentar <?=$com[0]?></a>


      <?php
          if($row["user_id"] === $user_id){ ?>
              <a href="ubah.php?foto=<?= $row["foto_id"]; ?>&user=<?=$user_id?>" class="btn btn-outline-secondary">ubah</a>
      <?php    }
      ?>

      <?php
          if($row["user_id"] === $user_id){ ?>
              <a href="hapus.php?foto=<?= $row["foto_id"]; ?>&user=<?=$user_id?>" class="btn btn-outline-secondary" onclick="return confirm('Anda Yakin?');">hapus</a>
      <?php    }
      ?>
      </div>
      </div>
      </a>
      </div>

    <?php endforeach;?>
          </center> 
        <?php
        }
        ?>
</body>
</html>

