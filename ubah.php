<?php
require 'functions/function.php';
$fotoGet = $_GET["foto"];
$userGet = $_GET["user"];

$sql = mysqli_query($conn, "SELECT * FROM foto WHERE foto_id = $fotoGet");
$foto = mysqli_fetch_array($sql);

if(isset($_POST["ubah"])) {
    if(ubah($_POST) > 0){
        echo "
        <script>
        alert('Berhasil di Ubah!');
        document.location.href = 'index.php?user_id=$userGet';
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
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="display:flex;justify-content:center;">
<form action="" method="post" enctype="multipart/form-data" class="shadow-sm p-3 mb-5 bg-body rounded" style="width:30%;display:flex;flex-direction:column;margin-top:150px;">
<input type="hidden" name="foto_id" value="<?= $foto[0]?>">
<input type="hidden" name="lokasi_fileLama" value="<?= $foto[4]?>">
  <div class="mb-3">
    <h4>Tambah Gambar</h4><br>
    <label for="judul_foto">Judul Foto :</label>
    <input type="text" name="judul_foto" id="" value="<?=$foto[1]?>" class="form-control"><br>
  </div>
  <div class="mb-3">
    <label for="deskripsi_foto" class="form-label">Deskripsi :</label>
    <input type="text" name="deskripsi_foto" id="" class="form-control" value="<?=$foto[2]?>"><br>
  </div>
  <div class="mb-3">
    <label for="lokasi_file" class="form-label">Gambar :</label>
    <input type="file" name="lokasi_file" id="" class="form-control"><br>
    <img src="img/<?= $foto[4]; ?>"  width="80"><br>
  </div>

<button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
</form>
</body>
</html>