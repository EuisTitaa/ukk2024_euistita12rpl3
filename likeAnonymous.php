<?php
require 'functions/function.php';

// mengambil data dari url
$fotoGet = $_GET["foto"];
$userGet = $_GET["user"];

$tanggallike=date("Y-m-d");
$user_id = user();

$sql = mysqli_query($conn,"SELECT * FROM like_foto where foto_id='$fotoGet' and user_id='$userGet'");

        if(mysqli_num_rows($sql) === 0 ){
            mysqli_query($conn,"INSERT INTO like_foto VALUES('','$fotoGet','$userGet','$tanggallike')");
            echo "
            <script>
            alert('berhasil like !');
            document.location.href = 'galerifoto.php';
            </script>
            ";
        } else {
            mysqli_query($conn,"INSERT INTO like_foto VALUES('','$fotoGet','$userGet','$tanggallike')");
            echo "
            <script>
            alert('berhasil like !');
            document.location.href = 'galerifoto.php';
            </script>
            ";
        }


?>