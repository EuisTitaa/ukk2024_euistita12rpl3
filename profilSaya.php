<?php
require 'functions/function.php';

$user_id = $_GET["user_id"];
$user = mysqli_query ($conn, "SELECT * FROM user WHERE user_id = $user_id");

// if (isset($_POST["ubahPassword"])){
//     $ubah = mysqli_query ($conn, "UPDATE user SET 
//     password = $result");
//     $passwordLama = htmlspecialchars($_POST["passwordLama"]);
//     $password = htmlspecialchars($_POST["password"]);
//     $row = mysqli_fetch_assoc($result);
    
// }

if(isset($_POST["ubahPassword"])) {
    if(ubahPass($_POST) > 0){
        echo "
        <script>
        alert('Berhasil di Ubah!');
        document.location.href = 'profilSaya.php?user_id=$user_id';
        </script>
        ";
    }else{
        echo "gagal";
    }
}

if(isset($_POST["ubahFoto"])) {
    if(ubahFoto($_POST) > 0){
        echo "
        <script>
        alert('Berhasil di Ubah!');
        document.location.href = 'profilSaya.php?user_id=$user_id';
        </script>
        ";
    }else{
        echo "gagal";
    }
}




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
        <li class="nav-item">
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
        </li>
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

 <?php foreach ($user as $row) : ?>
    <img src="img/<?=$row["foto_user"]?>" class="border border-primary" alt="" style="border-radius: 500px; width:300px; height:300px;"><br><br>
    <h3><?=$row["username"]?></h3>
    <?php
        if($user_id === '32') { 
          ?>
          <br><h5><i style="color:gray;">*Registrasi untuk mengubah Profil !*</i><br></h5>
          <br><a href="Register.php" class="btn btn-success">Registrasi</a>
        <?php
        } else {
        ?>
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="user_id" value="<?=$user_id?>">
          <input type="hidden" name="lokasi_fileLama" value="<?= $foto_user?>">
          <div class="input-group mb-3" style="width:20%;">
              <input type="file" class="form-control" name="lokasi_file">
              <button class="btn btn-primary" type="submit" id="button-addon2" name="ubahFoto">Ubah Foto</button>
          </div>
        </form><br>

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

    
    <form action="" method="post" enctype="multipart/form-data" class="shadow-sm p-3 mb-5 bg-body rounded border border-primary" style="width:30%;display:flex;flex-direction:column;margin-top:10px;">

        <input type="hidden" name="user_id" value="<?=$user_id?>">

        <div class="mb-3">
            <h4>Ubah pasword</h4><br>
        
        <input type="text" name="password" id="" class="form-control"><br>
        </div>

        <button type="submit" name="ubahPassword" class="btn btn-primary">Ubah Password</button>

    </form>
    <i style="color:red;">*Warning! akun dan data anda akan di hapus seluruhnya*</i><br><br>
    <a href="hapusAkun.php?user=<?=$user_id;?>" class="btn btn-danger" onclick="return confirm('Anda Yakin? Data akan di hapus seluruhnya');">Hapus Akun</a><br><br><br>

        <?php
        }
        ?>

    <?php endforeach;?>
    </center>   
</body>
</html>

