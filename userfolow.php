<?php
require 'functions/function.php';

$userGet = $_GET["user"];
$user_idGet = $_GET["user_id"];

$like = mysqli_query($conn, "SELECT * FROM folow WHERE User = $userGet");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?user_id=<?=$user_idGet?>">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        if($userGet === '32') { 
          ?>
          
        <?php
        } else {
        ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="galeri.php?user_id=<?=$user_idGet?>">Galeri Anda</a>
        </li>
        <?php
        }
        ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profilSaya.php?user_id=<?=$user_idGet?>  " style="margin-right:5px;">profil Anda</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <?php
        if($userGet === '32') { 
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
<h3>User yang sudah folow :</h3><br><br>
    <?php foreach($like as $row) :
        $userrow = $row["User_id"];
        $usersql = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$userrow'");
        $userArray = mysqli_fetch_array($usersql);
        $user = $userArray["username"];
        $foto = $userArray["foto_user"];
        ?>
        <div class="" style="display:flex; justify-content:center;">
        <div class="border border-primary rounded" style="display:flex; justify-content: space-evenly; align-items: center; width:30%;margin-bottom:20px; padding:4px;">
        
        <img src="img/<?=$foto?>" alt="" class="border border-primary" style="width:70px; height:70px; border-radius:80px;">
            <?php
            if ($userGet === $userrow){ 
            ?>
            <a href="profilSaya.php?user_id=<?=$userGet?>"><?=$user;?></a>
            <?php } else { ?>
            <a href="profil.php?user_id=<?=$userGet?>&user=<?=$userrow?>"><?=$user;?></a>
            <?php }?> 
        
        </div>
        </div>
    <?php endforeach; ?>
    </center>
</body>
</html>