<?php
require 'functions/function.php';
$fotoGet = $_GET["foto"];
$userGet = $_GET["user"];

$kom = mysqli_query ($conn, "SELECT * FROM komentar_foto WHERE foto_id = '$fotoGet' ORDER BY foto_id DESC");
$foto = mysqli_query ($conn, "SELECT * FROM foto WHERE foto_id = '$fotoGet'");

if(isset($_POST["komentar"])) {

    if(kom($_POST) > 0){
        $user_id = user();
        $foto_id = foto();
        echo "
        <script>alert('berhasil !');
        document.location.href = 'komen.php?foto=$foto_id&user=$user_id';
        </script>
        ";
    }
}
 
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
    <a class="navbar-brand" href="index.php?user_id=<?=$userGet?>">Home</a>
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
          <a class="nav-link active" aria-current="page" href="galeri.php?user_id=<?=$userGet?>">Galeri Anda</a>
        </li>
        <?php
        }
        ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profilSaya.php?user_id=<?=$userGet?>" style="margin-right:5px;">profil Anda</a>
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
<?php foreach($foto as $row) : ?>
        <?php
        $img = $row["lokasi_file"];
        $judul = $row["judul_foto"];
        $deskripsi = $row["deskripsi_foto"];
        $tanggal = $row["tanggal_unggah"];
        $user_id = $row["user_id"]; 
            $userArray = mysqli_query ($conn, "SELECT username FROM user WHERE user_id = '$user_id'");
            $username= mysqli_fetch_array($userArray);
            $username = $username[0];
            $akun = $row["user_id"];
            $likeArray = mysqli_query ($conn, "SELECT COUNT(like_id) FROM like_foto WHERE foto_id = '$fotoGet'");
            $like= mysqli_fetch_array($likeArray);
            $like = $like["COUNT(like_id)"];
            ?>
        <br><h1><?= $judul ?></h1>
        <h3>user : <a href="profil.php?user_id=<?=$userGet?>&user=<?=$akun?>"><?=$username;?></a></h3><br>
        <i style="color:gray;">Tanggal Unggah : <?= $tanggal ?></i><br><br>
        <div style="width:50%;">
        <h5>"
        <?= $deskripsi ?>"
        </h5>
      </div><br><br>
        
        <img src="img/<?=$img?>" alt="" class="border border-primary" style="width:50%;border-radius:50px;"><br><br>

        <?php
        if($userGet === '32') {  ?>
          <a href="likeAnonymous.php?foto=<?= $row["foto_id"]; ?>&user=<?=$userGet?>" class="btn btn-danger">❤ <?=$like[0]?></a>
        <?php } else {   ?>
            <br>
            <a href="like.php?foto=<?= $row["foto_id"]; ?>&user=<?=$userGet?>" class="btn btn-danger">❤ <?=$like?></a>
            <a href="unlike.php?foto=<?= $row["foto_id"]; ?>&user=<?=$userGet?>" class="btn btn-outline-danger">💔 </a>
            <br>
            
            <?php
        } 
        ?>

    <?php endforeach;?>

    <form action="" method="post">
        <br>
        <a href="UserLike.php?foto=<?= $row["foto_id"]; ?>&user=<?=$userGet?>">Lihat User yang sudah like!</a><br><br>
        <h6 style="color:gray;">*Berkomentarlah dengan bahasa yang bijak!*</h6>
    <div class="input-group mb-3" style="width:50%;">
        <input type="text" class="form-control" placeholder="Masukan Komentar..." aria-label="Recipient's username" aria-describedby="button-addon2" name="isi_komentar">
    <button class="btn btn-primary" type="submit" id="button-addon2" name="komentar">Komen</button>
    </div>
    </form>

    
    <br>

    <?php foreach($kom as $row) : ?>
        <?php
            $user_id = $row["user_id"]; 
            $userArray = mysqli_query ($conn, "SELECT username FROM user WHERE user_id = '$user_id'");
            $fotoArray = mysqli_query ($conn, "SELECT foto_user FROM user WHERE user_id = '$user_id'");
            $foto=mysqli_fetch_array($fotoArray);
            $username= mysqli_fetch_array($userArray);
            $username = $username["username"];
        ?>
        <h5 class="shadow p-3 bg-body rounded" style="border:1px solid gray; border-radius:5px; width:50%;padding:7px;">

        <img src="img/<?=$foto[0]?>" class="border border-primary" alt="" style="width:30px; height:30px; margin: top 10px; border-radius:10px;">
        
        <?php
        if ($userGet === $user_id){ 
        ?>
        <a style="text-decoration:none; color:black;" href="profilSaya.php?user_id=<?=$userGet?>"><?=$username;?></a>
        <?php } else { ?>
        <a style="text-decoration:none; color:black;" href="profil.php?user_id=<?=$userGet?>&user=<?=$user_id?>"><?=$username;?></a>
         <?php } ?> 
        
        <i style="color:gray;"><span style="color:black;"> | </span><?= $row["tanggal_komentar"]?></i><hr>

        <?= $row["isi_komentar"];?><br>

        
        <?php
        if($userGet === '32' and $user_id === "32") { 
               echo "<br><i style='color:gray;'>*Register terlebih dahulu untuk mengubah dan menghapus Komentar*</i>";
        } else {
          if($userGet === $user_id) {  ?>
          <?php
            $komentar = $row["komentar_id"];
            ?>
            <br>
            <a href="hapuskom.php?foto=<?=$fotoGet?>&user=<?=$userGet?>&komentar=<?=$komentar?>" class="btn btn-outline-danger" onclick="return confirm('Yakin?');">hapus</a>
            <a href="ubahkom.php?foto=<?=$fotoGet?>&user=<?=$userGet?>&komentar=<?=$komentar?>" class="btn btn-outline-success">ubah</a>
            <?php
          }
        } 
        ?>
    </h5><br>
    <?php endforeach;?>
    
    </center>
</body>
</html>