<?php
require "functions/function.php";

if(isset($_POST["register"])) {
    if(register($_POST) > 0) {
        echo "
        <script>
        alert('User Baru telah di tambahkan!');
        document.location.href = 'login.php';
        </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="display:flex;justify-content:center;">
<form action="" method="post" enctype="multipart/form-data" class="shadow-sm p-3 mb-5 bg-body rounded" style="width:30%;display:flex;flex-direction:column;margin-top:30px;">

  <div class="mb-3">
    <h4>Register</h4><br>
    <label for="username" class="form-label">Username</label>
    <input type="text" name="username" class="form-control">
  </div>

  <div class="mb-3">
    <label for="namaL" class="form-label">Nama Lengkap</label>
    <input type="text" name="namaL" class="form-control" >
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" >
  </div>

  <div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <input type="alamat" name="alamat" class="form-control" >
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" >
  </div>
  <div class="mb-3">
    <label for="password2" class="form-label">Konfirmasi Password</label>
    <input type="password" name="password2" class="form-control" >
  </div>

  <div class="mb-3">
    <label for="lokasi_file" class="form-label">Upload Foto </label>
    <input type="file" name="lokasi_file" class="form-control" >
  </div>
<button type="submit" name="register" class="btn btn-primary">Register</button><br>
<a href="logout.php"  class="btn btn-primary">Log in</a>

</form>
   
</body>
</html>