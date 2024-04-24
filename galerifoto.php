<script>
    alert('Registrasi Terlebih Dahulu !'); 
 </script>
<?php
require "functions/function.php";

//ambil data dari url
$user_id = mysqli_query ($conn, "SELECT * FROM user  WHERE user_id =  32");
$user_id = mysqli_fetch_array($user_id);
$user_id= $user_id["user_id"];

$foto = mysqli_query ($conn, "SELECT * FROM foto ORDER BY foto_id DESC");
$sql = mysqli_query ($conn, "SELECT nama_Lengkap FROM user WHERE user_id = '$user_id'");
$nama = mysqli_fetch_array($sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
       
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profilSaya.php?user_id=<?=$user_id?>" style="margin-right:5px;">profil Anda</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <a href="registrasi.php" class="btn btn-success">Registrasi</a>
        </li>
      </li>
      </ul>
      
    </div>
  </div>
</nav>
<br>
<center>
<h4 style="margin-left:70px;">Selamat Datang, <a href="Registrasi.php" style="Text-decoration:None;">Registrasi</a> Terlebih dahulu untuk upload foto !</h4><br>
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
            $like = $like["COUNT(like_id)"];
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


            <a href="likeAnonymous.php?foto=<?= $row["foto_id"]; ?>&user=<?=$user_id?>" class="btn btn-danger">❤ <?=$like ?></a>
            <a href="komen.php?foto=<?= $row["foto_id"]; ?>&user=<?=$user_id?>" class="btn btn-outline-dark">komentar <?=$com[0]?></a>

        
            <?php
                if($row["user_id"] === $user_id){ ?>
                    <a href="ubah.php?foto=<?= $row["foto_id"]; ?>&user=<?=$user_id?>" class="btn btn-outline-success">ubah</a>
            <?php    }
            ?>
            
            <?php
                if($row["user_id"] === $user_id){ ?>
                    <a href="hapus.php?foto=<?= $row["foto_id"]; ?>&user=<?=$user_id?>" class="btn btn-outline-danger">hapus</a>
            <?php    }
            ?>
        </div>
    </div>
    </a>
</div>
        <?php endforeach;?>
        
        </center>

</body>
</html>         