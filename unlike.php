<?php
require 'functions/function.php';

// mengambil data dari url
$fotoGet = $_GET["foto"];
$userGet = $_GET["user"];

$tanggallike=date("Y-m-d");
$user_id = user();

$sql = mysqli_query($conn,"SELECT * FROM like_foto where foto_id='$fotoGet' and user_id='$userGet'");

        if(mysqli_num_rows($sql) > 0){
            mysqli_query($conn,"DELETE FROM like_foto WHERE user_id = $userGet and foto_id = $fotoGet");
            echo "
            <script>
            alert('berhasil Unlike !');
            document.location.href = 'index.php?user_id=$user_id';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('belum like !');
            document.location.href = 'index.php?user_id=$user_id';
            </script>
            ";
           
        }

        // if(mysqli_num_rows($sql) > 0){
            
        // } else  {
        //     echo "
        //     <script>
        //     alert(Belum like !');
        //     document.location.href = 'index.php?user_id=$user_id';
        //     </script>";
        // }


?>