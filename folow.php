<?php
require 'functions/function.php';

// mengambil data dari url
$user_idGet = $_GET["user_id"];
$userGet = $_GET["user"];

$tanggallike=date("Y-m-d");

$sql = mysqli_query ($conn,"SELECT * FROM folow WHERE user_id ='$user_idGet' and user ='$userGet'");

        if(mysqli_num_rows($sql)==1){
            //User sudah pernah like foto ini
            echo "
            <script>
            alert('sudah folow !');
            document.location.href = 'index.php?user_id=$user_idGet';
            </script>
            ";
        }else{
            mysqli_query($conn,"INSERT INTO folow VALUES('','$user_idGet','$userGet')");
            echo "
            <script>
            alert('berhasil folow !');
            document.location.href = 'index.php?user_id=$user_idGet';
            </script>
            ";
        }


?>