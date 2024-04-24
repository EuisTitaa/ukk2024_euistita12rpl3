<?php
require 'functions/function.php';
$fotoGet = $_GET["foto"];
$userGet = $_GET["user"];
$komGet = $_GET["komentar"];

$sql = mysqli_query($conn, "SELECT * FROM komentar_foto WHERE komentar_id = $komGet");

if(isset($_POST["ubah"])) {
    if(ubahkom($_POST) > 0){
        echo "
        <script>
        alert('Berhasil di Ubah!');
        document.location.href = 'komen.php?foto=$fotoGet&user=$userGet';
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
<body>
<a href="komen.php?foto=<?=$fotoGet?>&user=<?=$userGet?>" style="margin: 5px;" class="btn btn-outline-danger">back</a><br>
<center>
<form action="" method="post" enctype="multipart/form-data" class="shadow-sm p-3 mb-5 bg-body rounded" style="width:30%;display:flex;flex-direction:column;margin-top:150px;">
<?php foreach($sql as $row) : 
    $komentar = $row["isi_komentar"];
    $komentar_id = $row["komentar_id"];
    ?>
    <input type="hidden" name="komentar_id" value="<?=$komentar_id?>">
    
  <div class="mb-3">
    <h4>Edit Komentar</h4><br>
    <input type="text" name="isi_komentar" id="" value="<?=$komentar?>" class="form-control"><br>
  </div>

<button type="submit" name="ubah" class="btn btn-primary">Ubah Komentar</button>

<?php endforeach; ?>
</center>
</form>
</body>
</html>