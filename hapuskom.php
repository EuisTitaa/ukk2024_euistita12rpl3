<?php
require 'functions/function.php';

$foto_id = $_GET["foto"];
$user_id = $_GET["user"];
$komentar_id = $_GET["komentar"];

if( hapuskom($komentar_id) > 0 ){
    echo "
        <script>
            alert('Data Berhasil di hapus !');
            document.location.href = 'komen.php?foto=$foto_id&user=$user_id';
        </script>
        ";
}else {
        echo "
        <script>
            alert('Data Gagal di hapus !');
            document.location.href = 'komen.php?foto=$foto_id&user=$user_id';
        </script>
        ";
}


?>