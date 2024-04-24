<?php
require 'functions/function.php';

$userGet = $_GET["user"];
$user_id = user();

if(isset($_POST["tambah"])) {
    if(tambah($_POST) > 0) {
        echo "
        <script>
        alert('Berhasil');
        document.location.href = 'index.php?user_id=$user_id';
        </script>
        ";
    }else{
        echo "
        <script>
        alert('gagal');
        
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
    <title>Tambah Gambar</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="display:flex;justify-content:center;">

<form action="" method="post" enctype="multipart/form-data" class="shadow-sm p-3 mb-5 bg-body rounded" style="width:30%;display:flex;flex-direction:column;margin-top:150px;">
  <div class="mb-3">
    <h4>Tambah Gambar</h4><br>
    <label for="judul_foto">Judul Foto :</label>
    <input type="text" name="judul_foto" id="" class="form-control"><br>
  </div>
  <div class="mb-3">
    <label for="deskripsi_foto" class="form-label">Deskripsi :</label>
    <input type="text" name="deskripsi_foto" id="" class="form-control"><br>
  </div>
  <div class="mb-3">
    <label for="lokasi_file" class="form-label">Gambar :</label>
    <input type="file" name="lokasi_file" id="" class="form-control"><br>
  </div>

<button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
</form>
</body>
</html>